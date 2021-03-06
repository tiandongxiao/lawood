@extends('tpl.admin.app')
@section('content')
    <div class="box-header with-border">
        <h3>律师审核</h3>
    </div><!-- /.box-header -->
    @if($users)
        <div class="box-body">
            <table class="table table-bordered text-center">
                <thead>
                <tr class="header-row" style="font-family: '微软雅黑 Light'">
                    <th>姓名</th>
                    <th>电话</th>
                    <th>律师事务所</th>
                    <th>律师证号</th>
                    <th>家庭住址</th>
                    <th>工作地址</th>
                    <th>激活</th>
                    <th>操作</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->real_name }}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->office}}</td>
                        <td>{{$user->licence}}</td>
                        <td>{{$user->home_address}}</td>
                        <td>{{$user->work_address}}</td>
                        @if($user->active)
                            <td>Yes</td>
                        @else
                            <td>No</td>
                        @endif
                        <td><a href="{{url('site/approve/'.$user->id)}}">通过审核</a></td>
                        <td><a href="{{url('site/user/delete/'.$user->id)}}">删除用户</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    @endif
@stop