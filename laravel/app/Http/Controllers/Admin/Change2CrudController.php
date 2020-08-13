<?php

namespace Framework\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Framework\Http\Requests\ChangeRequest;
use Framework\Models\Change;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $change = new Change;
        $fields = [
            // 'id',
            'factory',
            'unit',
            'system',
            'title',
            'description',
            'justification',
        ];

        // retrieve id
        $id = $request->input('id');
        if (! empty($id)) {
            // find change
            $change = $change->find($id);
        }

        // assign value
        foreach ($fields as $field) {
            $change->{$field} = $request->input($field);
        }

        // save to db
        $result = $change->save();

        return response()->json(compact('result'));
    }

    public function viewChange(string $id)
    {
        $model = new Change;
        $data = $model->where('id', intval($id))->first()->toArray();
        return response()->json([
            'data' => $data
        ]);
    }
}
