@extends('tpl.base.app')
@section('content')
    @role('admin')
        <h3>我是管理员</h3>
    @endrole

    @role('lawyer')
        <h3>我是律师</h3>
    @endrole

    @role('client')
        <h3>我是注册用户</h3>
    @endrole

    @permission('create.user')
        <h3>我拥有删除user权限</h3>
    @endpermission

    @permission('xx.user')
        <h3>我拥有删除xx权限</h3>
    @endpermission

    @permission('eh.user')
        <h3>我拥有删除eh权限</h3>
    @endpermission

    @level(2)
        <h3>2</h3>
    @endlevel

    @level(1)
        <h3>1</h3>
    @endlevel
@endsection