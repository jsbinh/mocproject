<?php

namespace Framework\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Framework\Http\Requests\ChangeRequest;
use Framework\Models\Attachment;
use Framework\Models\Change;
use Framework\Models\ChangeStatus;
use Framework\Models\Comment;
use Framework\Models\Factory;
use Framework\Models\System;
use Framework\Models\Unit;
use Framework\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ChangeCrudController
 * @package Framework\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Change2CrudController extends ChangeCrudController
{
    public function index()
    {
        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = ucfirst($this->crud->entity_name_plural);

        // get all entries if AJAX is not enabled
        // if (! $this->data['crud']->ajaxTable()) {
        //     $this->data['entries'] = $this->data['crud']->getEntries();
        // }

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        // $this->crud->getListView() returns 'list' by default, or 'list_ajax' if ajax was enabled
        return view('modules.change.change', $this->data);
    }

    public function getTreeOfChanges()
    {
        $model = new Change;
        $data = $model->getTreeOfChanges();
        return response()->json([
            'data' => $data
        ]);
    }

    public function getMyTask()
    {
        $status_id = Auth::user()->status_id;
        $data = Change::query()
            ->where('status_id', $status_id)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getSelectItems(string $item)
    {
        $model = '\\Framework\\Models\\' . ucfirst($item);
        $data = (new $model())->get()->toArray();
        return response()->json([
            'data' => $data
        ]);
    }

    public function saveChange(Request $request)
    {
        try{
            return DB::transaction(function() use($request){
                $change = new Change;
                $fields = [
                    // 'id',
                    'change_id',
                    'factory',
                    'unit',
                    'system',
                    'title',
                    'description',
                    'justification',
                    'comment'
                ];

                // retrieve id
                $id = $request->input('id');
                if (! empty($id)) {
                    // find change
                    $change = $change->find($id);
                }

                // assign value
                /*foreach ($fields as $field) {
                    $change->{$field} = $request->input($field);
                }*/

                $factory = $request->input('factory');
                $unit = $request->input('unit');
                $system = $request->input('system');

                $fac_short_name = Factory::query()->where('id', $factory)->first()->short_name;
                $unit_short_name = Unit::query()->where('short_name', $unit)->first()->short_name;
                $system_short_name = System::query()->where('short_name', $system)->first()->short_name;

                $current_month = date('m');
                $current_year = date('y');

                $latestChangeId = Change::query()
                    ->where('change_id', 'LIKE', $fac_short_name.'-'.$unit_short_name.'-'.$system_short_name.'-'.$current_year.$current_month.'%')
                    ->orderBy('id', 'DESC')
                    ->first(['change_id']);

                if(empty($latestChangeId)){
                    $changeId = $fac_short_name.'-'.$unit_short_name.'-'.$system_short_name.'-'.$current_year.$current_month.'-001';
                }else{
                    $arr_tmp = explode('-', $latestChangeId->change_id);
                    $arr_tmp[4] = str_pad($arr_tmp[4] + 1, 3, 0, STR_PAD_LEFT);
                    $changeId = implode($arr_tmp, '-');
                }

                $change->change_id = $changeId;
                $change->factory = $factory;
                $change->unit = $unit;
                $change->system = $system;
                $change->title = $request->input('title');
                $change->description = $request->input('description');
                $change->justification = $request->input('justification');
//        $change->comment = $request->input('comment');


                if (empty($id)) {
                    $change->status_id = 1; // Draft
                    $change->created_by_id = backpack_user()->id;
                }

                if ($nextStatus = $request->input('assigned_status')) {
                    if (! is_numeric($nextStatus)) { // this is status name
                        $nextStatus = (new ChangeStatus)->where('name', $nextStatus)->first()->id;
                    }

                    $change->status_id = $nextStatus;
                }

                // save to db
                $result = $change->save();

                return response()->json(compact('result') + ['id' => $change->id]);
            });
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function viewChange(string $id)
    {
        $model = new Change;
        $data = $model->where('id', intval($id))->first()->toArray();

        $attachment = new Attachment;
        $files = $attachment->where('change_id', $id)->get()->toArray();

        $users = array_key_by((new User)->get()->toArray(), 'id');
        $files = array_map(function($file) use ($users) {
            return $file + ['user' => $users[$file['user_id']]];
        }, $files);

        $comments = (new Comment)->where('change_id', $id)->get()->toArray();
        $comments = array_map(function($comment) use ($users) {
            return $comment + ['user' => $users[$comment['user_id']]];
        }, $comments);

        $created_by = $users[$data['created_by_id']]['email'] ?? null;
        $assigned_to = $users[$data['assignee_id']]['email'] ?? null;
        $status = (new ChangeStatus)->find($data['status_id'] ?? 1)->name;

        return response()->json([
            'data' => $data + compact('files', 'comments', 'created_by', 'assigned_to', 'status')
        ]);
    }

    public function report(Request $request)
    {
        $statuses = (new ChangeStatus)->get()->toArray();

        $factory = intval($request->input('factory'));
        $where = ['factory'];

        $unit = intval($request->input('unit'));
        if ($unit) $where[] = 'unit';

        $system = intval($request->input('system'));
        if ($system) $where[] = 'system';

        $where = compact(...$where);

        $changes = (new Change)->where($where)
                               ->get()
                               ->toArray();

        $factory = (new Factory)->find($factory);
        $unit = (new Unit)->find($unit);
        $system = (new System)->find($system);

        $result = [];

        foreach ($statuses as $status) {
            $total = count(array_filter($changes, function($item) use ($status) {
                return $item['status_id'] === $status['id'];
            }));

            $result[] = [
                'id' => $status['id'],
                'title' => $status['name'],
                'total' => $total,
            ];
        }

        $groupMaps = [
            'Initiated' => [
                'Draft',
                'Open'
            ],
            'Screeening' => [
                'Screening progress',
                'Screening approved',
                'Screening not approved'
            ],
            'Design' => [
                'Design progress'
            ],
            'Design Review/Approve' => [
                'Waiting for technical reviewal',
                'Technical reviewal progress',
                'Technical reviewed ok',
                'Technical reviewed not ok'
            ],
            'Implement' => [
                'Implementation progress'
            ],
            'Implement Review/Approve' => [
                'Waiting for manager approval',
                'Manager approval progress',
                'Manager approved',
                'Manager not approved'
            ],
            'Closeout' => [
                'Update documents progress',
                'Close out',
                'Close out progress',
            ],
            'Closeout Review/Approve' => [
                'Close out not approved',
                'Close out approved',
            ],
            'Closed/Cancelled' => [
                'Cancel progress',
                'Cancelled',
                'Closed'
            ]
        ];

        $finalResult = [];

        foreach ($groupMaps as $group => $statuses) {
            $filter = array_filter($result, function($item) use ($statuses) {
                return in_array($item['title'], $statuses, true);
            });

            $total = array_sum(array_column($filter, 'total'));

            $finalResult[] = [
                'id' => $group,
                'title' => $group,
                'total' => $total,
                'color' => $total ? 'blue' : 'blue-grey'
            ];
        }

        // sort
        usort($finalResult, function ($a, $b) {
            if ($a['total'] == $b['total']) return 0;
            return ($a['total'] > $b['total']) ? -1 : 1;
        });

        // navigation
        $navigation = [
            ['text' => $factory->name ?? null]
        ];
        if ($unit) $navigation[] = ['text' => $unit->name];
        if ($system) $navigation[] = ['text' => $system->name];

        return response()->json([
            'data' => $finalResult,
            'navigation' => $navigation
        ]);
    }
}
