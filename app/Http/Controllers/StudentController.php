<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(Request $request)
    {
        //获取数据表（students）中的所有数据
        //$students = Student::all();

        //判断搜索关键字name
        $name = $request->name;
        //dd($name);
        if($name){
            //有搜索关键字      sql: SELECT * FROM students WHERE name like "%赵云%"
            $students = Student::where('name','like','%'.$name.'%')->paginate(2);
        }else{
            //分页显示列表
            $students = Student::paginate(2);//每页显示5条
        }
        //dd($students);






        //将students变量传递到视图
        return view('student.index',['students'=>$students,'name'=>$name]);
    }

    //显示添加表单
    public function add()
    {
        //获取所有学校数据
        $schools = School::all();
        return view('student.add',['schools'=>$schools]);
    }
    //接收并处理表单提交的数据
    public function save(Request $request)
    {
        //表单验证    required：必填
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required|integer',
            'sex' => 'required',
            'city' => 'required',
            'school_id' => 'required',
            'description' => 'required',
            'head'=>'required|image'
        ],[//定义错误信息
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须是整数',
            'sex.required'=>'性别不能为空',
            'city.required'=>'城市不能为空',
            'school_id.required'=>'学校不能为空',
            'description.required'=>'个人简介不能为空',
            'head.required'=>'必须上传头像',
            'head.image'=>'上传头像必须是图片',
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
        $student->sex = $request->sex;
        $student->city = $request->city;
        $student->school_id = $request->school_id;
        $student->description = $request->description;
        //在学习信息保存前处理上传图片
        $path = $request->file('head')->store('public');
        $url = Storage::url($path);
        $student->head = $url;

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
