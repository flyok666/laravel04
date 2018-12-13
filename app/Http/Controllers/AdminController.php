<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //账号列表
    public function index()
    {
        //获取所有账号信息
        //$admins = Admin::all();
        //获取当前页的账号信息
        $admins = Admin::paginate(5);

        //调用视图文件来显示
        return view('admin.index',['admins'=>$admins]);
    }
    //添加账号
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        //表单验证
        $this->validate($request,
            [
                'username'=>'required',
                'password'=>'required',
            ],
            [
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
            ]);

        //保存数据
        $admin = new Admin();
        $admin->username = $request->username;

        $admin->password = Hash::make($request->password);//密码需要加密
        $admin->remember_token = str_random();//登录功能需要

        $admin->save();

        //跳转到列表页
        return redirect('/admin/index')->with('success','账号添加成功');
    }
    //修改账号
    public function edit($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit',['admin'=>$admin]);
    }

    public function update(Request $request,$id)
    {
        //表单验证
        $this->validate($request,
            [
                'username'=>'required',
                //'password'=>'required',
            ],
            [
                'username.required'=>'用户名不能为空',
                //'password.required'=>'密码不能为空',
            ]);

        $admin = Admin::find($id);
        $admin->username = $request->username;
        $admin->save();
        return redirect('/admin/index')->with('success','账号修改成功');
    }

    //定义删除方法
    public function delete($id)
    {
        Admin::destroy($id);
        return redirect('/admin/index')->with('success','账号删除成功');
    }
}
