@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div class="form-list bg-fff-box">
            <div class="itms">
                <div class="f-left">真实姓名</div>
                <div class="f-right">{{Auth::user()->real_name}}</div>
            </div>
            <a class="itms itms-link" href="{{url('wechat/client/config/phone')}}">
                <div class="f-left">手机号码</div>
                <div class="f-right">{{Auth::user()->phone}}</div>
            </a>
        </div>
        <div class="bottom-btn">
            <div class="blank100" style="height:120px;"></div>
            <div class="con te-cen">
                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="返回首页" id="In-btn">
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $(function () {
            $('#In-btn').click(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop