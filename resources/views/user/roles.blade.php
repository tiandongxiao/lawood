@extends('tpl.admin.app')
@section('content')
    <div class="box">
        <div class="box-body">
            <h4>已授权角色</h4>
            <table class="table table-bordered text-center">
                <tbody>
                <tr>
                    <th>角色名称</th>
                    <th>机读名称</th>
                    <th>角色描述</th>
                    <th>解除角色</th>
                </tr>
                @foreach($user_roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{$role->slug}}</td>
                        <td>{{$role->description}}</td>
                        <td><a href="{{url('site/roles/detach/'.$id.'/'.$role->id)}}">解除</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>

            <h4>未授权角色</h4>
            <table class="table table-bordered text-center">
                <tbody>
                <tr>
                    <th>角色名称</th>
                    <th>机读名称</th>
                    <th>角色描述</th>
                    <th>绑定角色</th>
                </tr>
                @foreach($x_roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{$role->slug}}</td>
                        <td>{{$role->description}}</td>
                        <td><a href="{{url('site/roles/attach/'.$id.'/'.$role->id)}}">授权</a></td>
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