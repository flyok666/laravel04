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

//处理about请求  将about请求交给SiteController控制器的about方法来处理
Route::get('/about','SiteController@about');
Route::get('/info','SiteController@info');


Route::get('/student/index','StudentController@index');//学生列表
Route::get('/student/add','StudentController@add');//添加学生表单
//保存学生信息
Route::post('/student/save','StudentController@save');
//修改学生信息
Route::get('/student/edit/{id}','StudentController@edit');
Route::post('/student/update/{id}','StudentController@update');
//删除学生
Route::get('/student/delete/{id}','StudentController@delete');


//账号列表
Route::get('/admin/index','AdminController@index');
//添加账号
Route::get('/admin/create','AdminController@create');
Route::post('/admin/store','AdminController@store');
//修改账号
Route::get('/admin/edit/{id}','AdminController@edit');
Route::post('/admin/update/{id}','AdminController@update');
//shanchu 删除账号
Route::get('/admin/delete/{id}','AdminController@delete');
//登录
Route::get('/login','UserController@login')->name('login');
Route::post('/store','UserController@store');
//退出
Route::get('/logout','UserController@logout');

//学校列表
Route::get('/school/index','SchoolController@index');