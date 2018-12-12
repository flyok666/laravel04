<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index()
    {
        //获取数据表（students）中的所有数据
        //$students = Student::all();

        //分页显示列表
        $students = Student::paginate(5);//每页显示5条


        //将students变量传递到视图
        return view('student.index',['students'=>$students]);
    }

    //显示添加表单
    public function add()
    {
        return view('student.add');
    }
    //接收并处理表单提交的数据
    public function save(Request $request)
    {
        //表单验证    required：必填
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required|integer',
        ],[//定义错误信息
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是整数',
        ]);
        //验证不通过，会跳回表单
        //验证通过，继续往下执行


        //接收并处理表单提交的数据
        //$name = $request->name;//$name = $_POST['name'];
        //dd($request->name);
        //调用模型来保存数据
        $student = new Student();
        $student->name = $request->name;
        $student->age = $request->age;
        $student->save();
        //echo '添加成功';
        //跳转回学生列表页
        return redirect('/student/index')->with('success','添加成功');
    }

    //修改学生信息
    public function edit($id)
    {
        //dd($id);
        //通过id获取对应的学生信息
        $student = Student::find($id);

        //return view('student.edit',['student'=>$student]);
        return view('student.edit',compact('student'));
    }

    public function update(Request $request,$id)
    {
//表单验证    required：必填
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required|integer',
        ],[//定义错误信息
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是整数',
        ]);
        //验证不通过，会跳回表单
        //验证通过，继续往下执行


        //接收并处理表单提交的数据
        //$name = $request->name;//$name = $_POST['name'];
        //dd($request->name);
        //调用模型来保存数据
        //$student = new Student();
        $student = Student::find($id);
        $student->name = $request->name;
        $student->age = $request->age;
        $student->save();
        //echo '添加成功';
        //跳转回学生列表页
        return redirect('/student/index')->with('success','修改成功');
    }

    //删除学生
    public function delete($id)
    {
        Student::destroy($id);
        return redirect('/student/index')->with('success','删除成功');
    }
}
