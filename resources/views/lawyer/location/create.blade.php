@extends('tpl.base.app')
@section('content')
    <div class="box box-info" style="border:solid #cccccc 1px;">
        <div class="box box-widget widget-user" style="margin-bottom:30px;">
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">请您选择您的执业地址</h3>
            </div>
            <br/>
            <div class="widget-user-image">
                <img class="img-circle" src="/images/user1-128x128.jpg" alt="User Avatar">
            </div>
        </div>
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{URL('lawyer/location/create')}}">
            {!! csrf_field() !!}
            <div class="box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" class="form-control" placeholder="家庭地址" name="home">
                </div>
                <br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                    <input type="text" class="form-control" placeholder="工作地址" name="work">
                </div>
                <br/>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">下一步</button>
                </div><!-- /.box-footer -->
            </div>
        </form>
    </div>
@endsection