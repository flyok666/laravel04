@extends('layout.default')

@section('content')

<h1>学生列表</h1>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>头像</th>
        <th>年龄</th>
        <th>学校</th>
        <th>操作</th>
    </tr>
    @foreach ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td><img src="{{ $student->head }}" /></td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->school_id?$student->school->name:'' }}</td>
            <td>
                <a href="/student/edit/{{ $student->id }}" >编辑 </a>
                <a href="/student/delete/{{ $student->id }}" >删除</a>
                查看</td>
        </tr>
    @endforeach
    {{--<tr>
        <td>1</td>
        <td>张三</td>
        <td>18</td>
        <td>编辑 删除 查看</td>
    </tr>
    <tr>
        <td>2</td>
        <td>李四</td>
        <td>20</td>
        <td>编辑 删除 查看</td>
    </tr>--}}
</table>
{{ $students->links() }}
@stop