@extends('layout.default')

@section('content')
    <h1>修改学生</h1>
    @include('layout._error')
    <form method="post" action="/student/update/{{ $student->id }}">
        <div class="form-group">
            <label>姓名</label>
            <input type="text" class="form-control" name="name" value="{{ $student->name }}" >
        </div>
        <div class="form-group">
            <label>年龄</label>
            <input type="text" class="form-control" name="age" value="{{ $student->age }}">
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop