@extends('layout.default')

@section('content')
    <h1>添加账号</h1>
    @include('layout._error')
    <form method="post" action="/admin/store">
        <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" >
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}">
        </div>

        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    @stop