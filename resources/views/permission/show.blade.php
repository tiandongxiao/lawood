@extends('tpl.admin.app')
@section('content')
    <div class="box box-widget">
        <div class="box-header with-border">
            <table class="table table-bordered text-center">
                <tbody><tr>
                    <th>权限名称</th>
                    <th>机读名称</th>
                    <th>权限描述</th>
                </tr>

                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{$permission->slug}}</td>
                    <td>{{$permission->description}}</td>

                </tr>
                </tbody>
            </table>
        </div><!-- /.box-header -->
        <br/><br/>
        <div class="box-body">
            <h4>所属角色</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
                    <th>角色名称</th>
                    <th>机读名称</th>
                    <th>角色描述</th>
                </tr>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{$role->slug}}</td>
                    <td>{{$role->description}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <br/><br/>
            <h4>所属用户</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
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