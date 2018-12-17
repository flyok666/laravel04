<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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


    //修改密码
    public function password()
    {
        return view('user.password');
    }

    public function updatePw(Request $request)
    {
        $this->validate($request,
            [
                'password'=>'required',
                'newpassword'=>'required|confirmed',
                'newpassword_confirmation'=>'required',
            ],
            [
                'password.required'=>'旧密码不能为空',
                'newpassword.required'=>'新密码不能为空',
                'newpassword_confirmation.required'=>'确认新密码不能为空',
                'newpassword.confirmed'=>'两次密码不一致',

            ]
        );

        //获取当前登录用户信息
        $admin = auth()->user();
        //验证旧密码是否正确
        if (!Hash::check($request->password, $admin->password)) {
            // 密码不正确
            return back()->with('danger','旧密码不正确');
        }
        //密码正确 继续更新密码
        $admin->password = Hash::make($request->newpassword);
        $admin->save();
        Auth::logout();
        return redirect('/login')->with('success','密码修改成功，请重新登录');
    }
}
