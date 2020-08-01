<?php

namespace Framework\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Framework\Http\Requests\ChangeRequest;

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
}
