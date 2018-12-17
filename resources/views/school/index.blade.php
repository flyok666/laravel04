@extends('layout.default')

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>名称</th>
        </tr>
        @foreach($schools as $school)
            <tr>
                <td>{{ $school->id }}</td>
                <td>{{ $school->name }}</td>
            </tr>
            @endforeach
    </table>
    @stop