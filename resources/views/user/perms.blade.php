@extends('tpl.admin.app')
@section('content')
    <div class="box">
        <div class="box-body">
            <h4>角色权限</h4>
            <table class="table table-bordered text-center">
                <tbody>
                <tr>
                    <th>权限名称</th>
                    <th>机读名称</th>
                    <th>权限描述</th>
                    <th>详情</th>
                </tr>
                @foreach($role_perms as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
                        <td><a href="{{url('site/permission/'.$permission->id)}}">查看</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>

            <h4>专属权限</h4>
            <table class="table table-bordered text-center">
                <tbody>
                <tr>
                    <th>权限名称</th>
                    <th>机读名称</th>
                    <th>权限描述</th>
                    <th>解权</th>
                </tr>
                @foreach($user_perms as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
                        <td><a href="{{url('site/perms/detach/'.$id.'/'.$permission)}}">解除</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h4>未获得权限</h4>
            <table class="table table-bordered text-center">
                <tbody><tr>
                    <th>权限名称</th>
                    <th>机读名称</th>
                    <th>权限描述</th>
                    <th>授权</th>
                </tr>
                @foreach($x_perms as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
                        <td><a href="{{url('site/perms/attach/'.$id.'/'.$permission->id)}}">授权</a></td>
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