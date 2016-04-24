@extends('tpl.admin.app')
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a href="{{ url('role/create') }}" class="btn btn-lg btn-info" >新增角色</a>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>显示名称</th>
                    <th>机读名称</th>
                    <th>角色描述</th>
                    <th style="width: 40px"><a>链接</a></th>
                    <th style="width: 40px"><a>操作</a></th>
                    <th style="width: 40px"><a>操作</a></th>
                </tr>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->slug }}</td>
                        <td>{{ $role->description }}</td>
                        <td><a href="{{ url('role/'.$role->id) }}" class="btn btn-info"> 查看角色信息</a></td>
                        <td>
                            <a href="{{ url('role/'.$role->id.'/edit') }}" class="btn btn-success">编辑</a>
                        </td>
                        <td>
                            <form action="{{ url('role/'.$role->id) }}" method="POST">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody></table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
    </div>
@stop
@section('script')
    <script src="/js/app.min.js"></script>
@stop