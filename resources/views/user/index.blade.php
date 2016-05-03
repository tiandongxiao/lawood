@extends('tpl.admin.app')
@section('content')
    <div class="box-header with-border">
        <h3>用户管理</h3>
    </div><!-- /.box-header -->
    @if($users)
        <div class="box-body">
            <table class="table table-bordered text-center">
                <thead>
                <tr class="header-row">
                    <th>用户名</th>
                    <th>电话</th>
                    <th>email</th>
                    <th>Union ID</th>
                    <th>Open ID</th>
                </tr>
                <tr class="search-row">
                    <form class="search-form">
                        <td><input type="text"  name="name" value="{{Request::input("name")}}"></td>
                        <td><input type="text"  name="phone" value="{{Request::input("phone")}}"></td>
                        <td><input type="text"  name="email" value="{{Request::input("email")}}"></td>
                        <td><input type="text"  name="union_id" value="{{Request::input("union_id")}}"></td>
                        <td><input type="text"  name="open_id" value="{{Request::input("open_id")}}"></td>
                        <td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
                    </form>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->union_id}}</td>
                        <td>{{$user->open_id}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    @endif
@endsection