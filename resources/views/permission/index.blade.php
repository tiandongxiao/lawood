@extends('tpl.admin.app')
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a href="{{ url('admin/permission/create') }}" class="btn btn-lg btn-warning" >新增权限</a>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                    <th>权限名称</th>
                    <th>权限机械码</th>
                    <th>权限描述</th>
                    <th>操作</th>
                    <th>操作</th>
                    @foreach($roles as $role)
                        <th class="text-center">{{$role->name}}</th>
                    @endforeach
                </tr>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{$permission->slug}}</td>
                        <td>{{$permission->description}}</td>
                        <td>
                            <a href="{{ url('admin/permission/'.$permission->id.'/edit') }}" class="btn btn-success">编辑</a>
                        </td>
                        <td>
                            <form action="{{ url('admin/permission/'.$permission->id) }}" method="POST">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        </td>
                        @foreach($roles as $role)
                            @if($role->permissions->find($permission->id))
                                <td>Y</td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
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