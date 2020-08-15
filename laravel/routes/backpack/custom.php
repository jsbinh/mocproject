<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'Framework\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::group(['prefix' => 'web'], function() {
        Route::group(['prefix' => 'change'], function() {
            Route::get('/select-items/{item}', 'Change2CrudController@getSelectItems');
            Route::get('/tree', 'Change2CrudController@getTreeOfChanges');
            Route::get('/report', 'Change2CrudController@report');
            Route::post('/', 'Change2CrudController@saveChange');
            // Route::put('/{id}', 'Change2CrudController@updateChange');
            Route::get('/{id}', 'Change2CrudController@viewChange');
        });
        Route::group(['prefix' => 'attachment'], function() {
            Route::post('/', 'Attachment2CrudController@upload');
            Route::get('/{id?}', 'Attachment2CrudController@download');
            Route::delete('/{id}', 'Attachment2CrudController@remove');
        });
        Route::group(['prefix' => 'comment'], function() {
            Route::post('/', 'Comment2CrudController@post');
        });
    });

    Route::crud('tag', 'TagCrudController');
    Route::crud('slug', 'SlugCrudController');
    Route::crud('change-status', 'ChangeStatusCrudController');
    Route::crud('change', 'ChangeCrudController');
    Route::crud('change2', 'Change2CrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('factory', 'FactoryCrudController');
    Route::crud('unit', 'UnitCrudController');
    Route::crud('system', 'SystemCrudController');
    Route::crud('attachment', 'AttachmentCrudController');
    Route::crud('comment', 'CommentCrudController');
}); // this should be the absolute last line of this file
