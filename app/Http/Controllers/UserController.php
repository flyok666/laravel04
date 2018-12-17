<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //登录功能
    public function login()
    {
        //展示登录表单
        return view('user.login');
    }

    public function store(Request $request)
    {
        //表单验证
        $this->validate($request,
            [
                'username'=>'required',
                'password'=>'required',
                'captcha' => 'required|captcha',
            ],
            [
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'captcha.required' => '验证码不能为空',
                'captcha.captcha' => '请输入正确的验证码',

            ]);

        //验证用户的账号密码，以及实现登录
        if(Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password,
        ])){//验证通过
            return redirect('/student/index')->with('success','
            登录成功');
        }//验证不通过，说明用户名密码不正确
            return redirect('/login')->with('danger','用户名或密码错误');
    }

    //退出登录
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success','您已安全退出');
    }
}
