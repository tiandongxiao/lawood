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
            <h3>拥有权限</h3>
        </div><!-- /.box-body -->
    </div>
@stop
@section('script')
    <script src="/js/app.min.js"></script>
@stop