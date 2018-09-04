<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test','admin\TestsController@index');

Route::get('admin/login','admin\LoginsController@index')->name('admin.login');
Route::post('admin/login','admin\LoginsController@login')->name('admin.login');

/*后台路由信息*/
Route::group(['prefix'=>'admin','middleware'=>'auth.admin'],function(){
    //登出Route
    Route::delete('logout','admin\LoginsController@destroy')->name('admin.logout');
    //主面Route
    Route::get('main','admin\MainsController@index')->name('admin.main');
    Route::get('welcome','admin\MainsController@welcome')->name('admin.welcome');
    //管理员管理Route
    Route::resource('admins','admin\AdminsController');
    Route::post('/admins/status','admin\AdminsController@status')->name('admins.status');
    //角色管理Route
    Route::resource('roles','admin\RolesController');
    //权限管理Route
    Route::resource('permissions','admin\PermissionsController',['except'=>['show']]);
});


Auth::routes();

Route::get('/homes', 'HomeController@index')->name('home');
