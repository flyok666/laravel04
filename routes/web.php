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
