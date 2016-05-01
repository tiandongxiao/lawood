@extends('tpl.admin.app')
@section('content')
    <div class="box">
        <div class="box-body">
            <h4>角色权限</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
                    <th>权限名称</th>
                    <th>机读名称</th>
                    <th>权限描述</th>
                </tr>
                @foreach($role_perms as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>

            <h4>专属权限</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
                    <th>权限名称</th>
                    <th>权限机械码</th>
                    <th>权限描述</th>
                </tr>
                @foreach($user_perms as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
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