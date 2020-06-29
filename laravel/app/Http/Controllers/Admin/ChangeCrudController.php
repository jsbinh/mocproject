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
class ChangeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\Framework\Models\Change::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/change');
        CRUD::setEntityNameStrings('change', 'changes');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        CRUD::addColumns(['id', 'title']); // add multiple columns, at the end of the stack

        CRUD::addColumn([
            'label'          => 'Status', // Table column heading
            'type'           => 'select',
            'name'           => 'status_id', // the column that contains the ID of that connected entity;
            'entity'         => 'change_status', // the method that defines the relationship in your Model
            'attribute'      => 'name', // foreign key attribute that is shown to user
            'visibleInTable' => true,
            'visibleInModal' => false,
        ]);

        CRUD::addColumn([
            'label'          => 'Approver', // Table column heading
            'type'           => 'select',
            'name'           => 'approver_id', // the column that contains the ID of that connected entity;
            'entity'         => 'approver', // the method that defines the relationship in your Model
            'attribute'      => 'email', // foreign key attribute that is shown to user
            'visibleInTable' => true,
            'visibleInModal' => false,
        ]);

        CRUD::addColumn([
            'label'          => 'Assignee', // Table column heading
            'type'           => 'select',
            'name'           => 'assignee_id', // the column that contains the ID of that connected entity;
            'entity'         => 'assignee', // the method that defines the relationship in your Model
            'attribute'      => 'email', // foreign key attribute that is shown to user
            'visibleInTable' => true,
            'visibleInModal' => false,
        ]);

        CRUD::addColumns(['created_at']); // add multiple columns, at the end of the stack

        $this->crud->enableExportButtons();
        $this->addCustomCrudFilters();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ChangeRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */

        CRUD::addField([ // Text
            'name'  => 'title',
            'label' => 'Title',
            'type'  => 'text',
        ]);
        CRUD::addField([   // Textarea
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea',
        ]);
        CRUD::addField([  // Select2
            'label'     => 'Status',
            'type'      => 'select2',
            // 'type'      => 'relationship',
            // 'placeholder' => 'Select a status', // placeholder for the select
            // 'minimum_input_length' => 2,
            // 'ajax'      => true,
            // 'data_source' => backpack_url('change-status/fetch/name'),
            // 'data_source'          => url('api/change-status'), // url to controller search function (with /{id} should return model)
            'name'      => 'status_id', // the db column for the foreign key
            'entity'    => 'change_status', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            // 'wrapperAttributes' => [
            //     'class' => 'form-group col-md-6'
            //   ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            // 'tab' => 'Basic Info',
        ]);

        CRUD::addField([  // Select2
            'label'     => 'Approver',
            'type'      => 'select2',
            // 'type'      => 'relationship',
            // 'placeholder' => 'Select an approver', // placeholder for the select
            // 'minimum_input_length' => 2,
            // 'ajax'      => true,
            // 'data_source' => backpack_url('change/fetch/email'),
            'name'      => 'approver_id', // the db column for the foreign key
            'entity'    => 'approver', // the method that defines the relationship in your Model
            'attribute' => 'email', // foreign key attribute that is shown to user
            // 'wrapperAttributes' => [
            //     'class' => 'form-group col-md-6'
            //   ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            // 'tab' => 'Basic Info',
            //'readonly'=>'readonly',
        ]);

        CRUD::addField([  // Select2
            'label'     => 'Assignee',
            'type'      => 'select2',
            // 'type'      => 'relationship',
            // 'placeholder' => 'Select an assignee', // placeholder for the select
            // 'minimum_input_length' => 2,
            // 'ajax'      => true,
            // 'data_source' => backpack_url('change/fetch/email'),
            'name'      => 'assignee_id', // the db column for the foreign key
            'entity'    => 'assignee', // the method that defines the relationship in your Model
            'attribute' => 'email', // foreign key attribute that is shown to user
            // 'wrapperAttributes' => [
            //     'class' => 'form-group col-md-6'
            //   ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            // 'tab' => 'Basic Info',
            //'readonly'=>'readonly',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function addCustomCrudFilters()
    {
        $this->crud->addFilter(
            [ // daterange filter
                'type' => 'date_range',
                'name' => 'date_range',
                'label'=> 'Date range',
                // 'date_range_options' => [
                // 'format' => 'YYYY/MM/DD',
                // 'locale' => ['format' => 'YYYY/MM/DD'],
                // 'showDropdowns' => true,
                // 'showWeekNumbers' => true
                // ]
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'created_at', '>=', $dates->from);
                $this->crud->addClause('where', 'created_at', '<=', $dates->to);
            }
        );

        $this->crud->addFilter([ // select2 filter
            'name' => 'status',
            'type' => 'select2',
            'label'=> 'Status',
        ], function () {
            return \Framework\Models\ChangeStatus::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'status_id', $value);
        });

    }
}
