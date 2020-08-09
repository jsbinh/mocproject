<?php

namespace Framework\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Change extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'changes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    // protected $fillable = ['title', 'description', 'status_id', 'approver_id', 'assignee_id'];
    // protected $hidden = [];
    // protected $dates = [];

    public function getTreeOfChanges()
    {
        $modelFactory = new Factory;
        $modelUnit = new Unit;
        $modelSystem = new System;

        $factories = $modelFactory->get()->toArray();
        $units = $modelUnit->get()->toArray();
        $systems = $modelSystem->get()->toArray();

        $factories = array_key_by($factories, 'id');
        $units = array_key_by($units, 'id');
        $systems = array_key_by($systems, 'id');

        $changes = $this->get(['id', 'title', 'factory', 'unit', 'system'])->toArray();

        $tree = [];

        // push data to tree
        foreach ($changes as $change) {
            $factory = $change['factory'];
            $unit = $change['unit'];
            $system = $change['system'];

            if (empty($factory) || empty($unit) || empty($system)) continue;

            $tree[$factory]['id'] = $factory;
            $tree[$factory]['name'] = $factories[$factory]['name'];
            $tree[$factory]['level'] = 0;
            $tree[$factory]['children'][$unit]['id'] = $unit;
            $tree[$factory]['children'][$unit]['name'] = $units[$unit]['name'];
            $tree[$factory]['children'][$unit]['level'] = 1;
            $tree[$factory]['children'][$unit]['children'][$system]['id'] = $system;
            $tree[$factory]['children'][$unit]['children'][$system]['name'] = $systems[$system]['name'];
            $tree[$factory]['children'][$unit]['children'][$system]['level'] = 2;
            $tree[$factory]['children'][$unit]['children'][$system]['children'][] = $change + ['level' => 3, 'name' => $change['title'], 'children' => []];
        }

        // default data for empty data of factory
        // factories
        foreach ($factories as $factory) {
            if (! Arr::has($tree, $factory['id'])) {
                $tree[$factory['id']]['id'] = $factory['id'];
                $tree[$factory['id']]['name'] = $factory['name'];
                $tree[$factory['id']]['level'] = 0;
                $tree[$factory['id']]['children'] = [];

                // units
                foreach ($units as $unit) {
                    $tree[$factory['id']]['children'][$unit['id']]['id'] = $unit['id'];
                    $tree[$factory['id']]['children'][$unit['id']]['name'] = $unit['name'];
                    $tree[$factory['id']]['children'][$unit['id']]['level'] = 1;
                    $tree[$factory['id']]['children'][$unit['id']]['children'] = [];

                    // systems
                    foreach ($systems as $system) {
                        $tree[$factory['id']]['children'][$unit['id']]['children'][$system['id']]['id'] = $system['id'];
                        $tree[$factory['id']]['children'][$unit['id']]['children'][$system['id']]['name'] = $system['name'];
                        $tree[$factory['id']]['children'][$unit['id']]['children'][$system['id']]['level'] = 2;
                        $tree[$factory['id']]['children'][$unit['id']]['children'][$system['id']]['children'] = [];
                    }
                }
            }
        }

        // sort
        ksort($tree);
        $tree = array_values($tree);

        // sort and convert to natural array
        foreach ($tree as $index => $item) {
            ksort($tree[$index]['children']);
            $tree[$index]['children'] = array_values($tree[$index]['children']);

            foreach ($tree[$index]['children'] as $_index => $_item) {
                ksort($tree[$index]['children'][$_index]['children']);
                $tree[$index]['children'][$_index]['children'] = array_values($tree[$index]['children'][$_index]['children']);

                foreach ($tree[$index]['children'][$_index]['children'] as $__index => $__item) {
                    ksort($tree[$index]['children'][$_index]['children'][$__index]['children']);
                    $tree[$index]['children'][$_index]['children'][$__index]['children'] = array_values($tree[$index]['children'][$_index]['children'][$__index]['children']);
                }
            }
        }

        return $tree;
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function change_status()
    {
        return $this->belongsTo('Framework\Models\ChangeStatus', 'status_id');
    }

    public function approver()
    {
        return $this->belongsTo('Framework\User', 'approver_id');
    }

    public function assignee()
    {
        return $this->belongsTo('Framework\User', 'assignee_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
