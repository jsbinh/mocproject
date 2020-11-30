<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect(config('backpack.base.route_prefix'));
});

Route::get('/get-change-id', [\App\Http\Controller\Admin\AdminController::class, 'getChangeID'])->name('getChangeId');

Route::get('/test', function() {
    \Log::info('Hello', ['world']);
    throw new \Exception('my error', 400);
    $result = DB::table('config')->where('name', 'default_filter')->first();
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
