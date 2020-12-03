<?php

namespace Framework\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Framework\Http\Requests\ChangeRequest;
use Framework\Libraries\Camunda;
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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        $user = Session::get('user');
        $data = Change::query()
            ->select([
                'changes.*',
                'change_id as name',
                'color'
            ])
//            ->leftJoin('')
            ->where('status_id', $user->status_id)
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

    public function getChangeId(Request $request)
    {
        $factory = Arr::get($request, 'factory');
        $unit = Arr::get($request, 'unit');
        $system = Arr::get($request, 'system');

        if(empty($factory) || empty($unit) || empty($system) || $system == 'undefined'){
            return response()->json([
                'data' => null
            ]);
        }

        return response()->json([
            'data' => $this->generalChangeId($factory, $unit, $system)
        ]);
    }

    private function generalChangeId($factory, $unit, $system)
    {
        $current_month = date('m');
        $current_year = date('y');

        $fac_short_name = Factory::query()->where('id', $factory)->first();
        $unit_short_name = Unit::query()->where('id', $unit)->first();
        $system_short_name = System::query()->where('id', $system)->first();

        if(!empty($fac_short_name)){
            $fac_short_name = $fac_short_name->short_name;
        }
        if(!empty($unit_short_name)){
            $unit_short_name = $unit_short_name->short_name;
        }
        if(!empty($system_short_name)){
            $system_short_name = $system_short_name->short_name;
        }

        $latestChangeId = Change::query()
            ->where('change_id', 'LIKE', $fac_short_name.'-'.$unit_short_name.'-'.$system_short_name.'-'.$current_year.$current_month.'%')
            ->orderBy('id', 'DESC')
            ->first(['change_id']);

        if(empty($latestChangeId)){
            $changeId = $fac_short_name.'-'.$unit_short_name.'-'.$system_short_name.'-'.$current_year.$current_month.'-001';
        }else{
            $arr_tmp = explode('-', $latestChangeId->change_id);
            $arr_tmp[4] = str_pad($arr_tmp[4] + 1, 3, 0, STR_PAD_LEFT);
            $changeId = implode('-', $arr_tmp);
        }

        return $changeId;
    }

    public function saveChange(Request $request)
    {
        try{
//            return DB::transaction(function() use($request){
                $change = new Change;

                $id = $request->input('id');
                if (! empty($id)) {
                    $change = Change::query()->find($id);
                }

                $factory = $request->input('factory');
                $unit = $request->input('unit');
                $system = $request->input('system');
                $color = $request->input('color');

                if(empty($id)){
                    $change->change_id = $this->generalChangeId($factory, $unit, $system);
                }

                $change->factory = $factory;
                $change->unit = $unit;
                $change->system = $system;
                $change->title = $request->input('title');
                $change->justification = $request->input('justification');
                $change->description = $request->input('description');

                if(!empty($color)){
                    $change->color = $color ?? Change::COLOR_DEFAULT;
                }else{
                    $change->color = $color;
                }


                /*if ($nextStatus = $request->input('assigned_status')) {
                    if (! is_numeric($nextStatus)) { // this is status name
                        $nextStatus = (new ChangeStatus)->where('name', $nextStatus)->first()->id;
                    }

                    $change->status_id = $nextStatus;
                }*/

            $user = backpack_user();
            $nextStatus = Arr::get($request, 'statusNext');

            if($change->status_id){
                if($nextStatus){
                    $statusSendEmail = $nextStatus;
                }else{
                    $statusSendEmail = $change->status_id + 1;
                }

                $email = User::query()
                    ->where('status_id', $statusSendEmail)
                    ->value('email');

                if(empty($email)){
                    $emailOWner = User::query()
                        ->where('status_id', $change->created_by_id)
                        ->value('email');
                }

                if(!empty($email)){
                    $created_email = User::query()->where('id', $change->created_by_id)->value('email');
                    Mail::send(
                        'assignee-mail',
                        [
                            'change_id' => $change->change_id,
                            'id'        => $change->id
                        ],
                        function ($message) use($change, $email, $created_email) {

                            $message->to($email)
                                ->subject("[Change #{$change->change_id}] " . ('Change Notification'));
                        }
                    );
                }

                if(!empty($emailOWner)){
                    Mail::send(
                        'send-email-owner',
                        [
                            'change_id' => $change->change_id,
                            'id'        => $change->id
                        ],
                        function ($message) use($change, $emailOWner) {

                            $message->to($emailOWner)
                                ->subject("[Change #{$change->change_id}] " . ('Change Notification'));
                        }
                    );
                }
            }

            if (empty($id)) {
                $change->status_id = 1; // Draft
                $change->color = Change::COLOR_DEFAULT;
                $change->created_by_id = backpack_user()->id;
            }

            if($change->status_id == 2){
                $change->color = $color;
            }

            if(empty($id) || $user->status_id == $change->status_id){
                if($nextStatus){
                    $change->status_id = $nextStatus;
                }else{
                    if(!empty($id)){
                        $change->status_id = $change->status_id + 1;
                    }
                }

                // save to db
                $result = $change->save();
            }else{
                $result = false;
            }

            $inputComment = Arr::get($request, 'commentText');
            $comment = new Comment();
            $comment->change_id = $change->id;
            $comment->user_id = $user->id;
            $comment->content = $inputComment;
            $comment->save();


                /*if(empty($id)){
                    $this->createdWithCamunda($change);
                }else{
                    $this->updatedWithCamunda($change);
                }*/

                return response()->json(compact('result') + ['id' => $change->id]);
//            });
        }catch (\Exception $e){
//            return $e->getMessage().'-'.$e->getFile().'-'.$e->getLine();
            Log::error($e->getMessage());
//            return $e->getMessage();
        }
    }

    public function viewChange($id)
    {
        try{
            if(empty($id)){
                return null;
            }
            $model = new Change;
            $data = $model->where('id', (int)$id)->first();

            if(!empty($data)){
                $data = $data->toArray();
            }

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
//            $assigned_to = $users[$data['assignee_id']]['email'] ?? null;

            $assigned_to = User::query()
                ->where('status_id', $data['status_id']+1)
                ->value('email');


            $status = (new ChangeStatus)->find($data['status_id'] ?? 1)->name;

            return response()->json([
                'data' => $data + compact('files', 'comments', 'created_by', 'assigned_to', 'status')
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function report(Request $request)
    {
        $statuses = (new ChangeStatus)->get()->toArray();

        $fac_id = $factory = (int)$request->input('factory');
        $where = ['factory'];

        $unit_id = $unit = (int)$request->input('unit');
        if ($unit) $where[] = 'unit';

        $system_id = $system = (int)$request->input('system');
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
            'Initial' => [
                'Initial',
            ],
            'Screening' => [
                'Screening',
            ],
            'Design' => [
                'Design'
            ],
            'Design Review/Approve' => [
                'Design Review/Approve'
            ],
            'Implement' => [
                'Implement'
            ],
            'Implement Review/Approve' => [
                'Implement Review/Approve',
            ],
            'Closeout' => [
                'Closeout',
            ],
            'Closeout Review/Approve' => [
                'Closeout Review/Approve',
            ],
            'Closed/Cancelled' => [
                'Closed/Cancelled'
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
                'color' => $total ? 'blue' : 'blue-grey',
                'factory'   => $fac_id,
                'unit'      => $unit_id,
                'system'     => $system_id,
                'status_id' => $filter
            ];
        }

        // sort
        /*usort($finalResult, function ($a, $b) {
            if ($a['total'] == $b['total']) return 0;
            return ($a['total'] > $b['total']) ? -1 : 1;
        });*/

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

    public function viewDetailReport(Request $request)
    {

    }

    public function createdWithCamunda(Change $change)
    {
        $data = $change->toArray();
        $data['status_id'] = isset($data['status_id']) ? intval($data['status_id']) : null;
        $data['assignee_id'] = isset($data['assignee_id']) ? intval($data['assignee_id']) : null;

        $data = $this->mapData($data);

        $camunda = Camunda::startProcess($data);
        $task = Camunda::getTask($camunda['id']);

        (new Change())->where('id', $data['id'])
            ->update([
                'wf_instance_id' => $camunda['id'],
                'wf_task_id' => Arr::get($task, '0.id', null)
            ]);

        Log::channel('camunda')->info('change created', [$data, $camunda, $task]);

        return true;
    }

    /**
     * Listen to the Change deleting event.
     *
     * @param  Change  $change
     * @return void
     */
    public function deleting(Change $change)
    {
        Log::channel('camunda')->info('change deleting', [$change]);
    }

    public function updatedWithCamunda(Change $change)
    {
//        if (! $change->isDirty('status_id')) return;

        $data = $change->toArray();
        $data = $this->mapData($data);

        Camunda::completeTask($data);
        $task = Camunda::getTask($data['wf_instance_id']);


        Log::info('change updated -- task', [$task, $data]);

        // task ended
        if (empty($task)) return;


        $variables = Camunda::getTaskVariables($taskId = $task[0]['id']);
        $decisionValue = Arr::get($variables, 'decision.value');

        Log::info('change updated -- vars', [$variables, $decisionValue]);


        // variables don't need to be updated
        if (empty($decisionValue)) return;

        $update = [];
        $update['flow'] = json_encode($decisionValue);

        if (!empty($decisionValue['next_assignee'])) {
            $update['assignee_id'] = (new User())->where('email', $decisionValue['next_assignee'])->first()->id;
        } else {
            $update['assignee_id'] = $data['created_by_id'];
        }

        if (!empty($decisionValue['next_status'])) {
            $update['status_id'] = (new ChangeStatus())->where('name', $decisionValue['next_status'])->first()->id;

            /*Mail::send(
                'assignee-mail',
                ['change_id' => $data['id']],
                function ($message) use ($update, $data, $decisionValue) {
                    $assigneeId = $update['assignee_id'] ?? $data['assignee_id'];

                    $mailAction = $decisionValue['next_action'] ?? '';

                    $actionMaps = [
                        'send_mail_screening_progress' => 'Screening Process',
                        'send_mail_cancel_progress' => 'Cancel Process',
                        'send_mail_technical_reviewal_progress' => 'Technical Reviewal Process',
                        'send_mail_manager_approval_progress' => 'Manager Approval Process',
                        'send_mail_close_out_progress' => 'Close Out Process'
                    ];

                    $message->to(array_values(array_unique([
                        (new User())->where('id', $assigneeId)->first()->email,
                        (new User())->where('id', $data['created_by_id'])->first()->email
                    ])))
                        ->subject("[Change #{$data['id']}] " . ($actionMaps[$mailAction] ?? 'Change Notifcation'));
                }
            );*/
        }

        $update['wf_task_id'] = $taskId;
        Change::query()->where('id', $data['id'])
            ->update($update);

        Log::info('change updated', [$data, $update]);

        return true;
    }

    protected function mapData($data)
    {
        if ($data['status_id']) {
            $data['status'] = (new ChangeStatus())->where('id', $data['status_id'])->first()->name;
        } else {
            $data['status'] = '';
        }

        if ($data['assignee_id']) {
            $data['assignee'] = (new User())->where('id', $data['assignee_id'])->first()->email;
        } else {
            $data['assignee'] = '';
        }

        return $data;
    }
}
