@extends('tpl.admin.app')
@section('content')
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <img class="img-circle" src="/images/user1-128x128.jpg" alt="user image">
                <span class="username"><a href="#">{{$role->slug}}</a></span>
                <span class="description">{{$role->description}}</span>
            </div><!-- /.user-block -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <h4>角色权限</h4>
            <table class="table table-bordered text-center">
                <tbody>
                <tr>
                    <th>权限名称</th>
                    <th>机读名称</th>
                    <th>权限描述</th>
                </tr>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br/><br/>
            <h4>角色用户</h4>
            <table class="table table-bordered text-center">
                <tbody>
                <tr>
                    <th>用户名称</th>
                    <th>手机号码</th>
                    <th>电子邮件</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>
@stop
@section('script')
    <script src="/js/app.min.js"></script>
@stop