@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div class="form-list bg-fff-box">
            <a class="itms itms-link mar-top-10" href="{{url('wechat/lawyer/config/phone')}}">
                <div class="f-left">手机号码</div>
                <div class="f-right">{{Auth::user()->phone}}</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/office')}}">
                <div class="f-left">律所名称</div>
                <div class="f-right">{{Auth::user()->office}}</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/work')}}">
                <div class="f-left">工作区域</div>
                <div class="f-right">{{Auth::user()->work}}</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/home')}}">
                <div class="f-left">居住区域</div>
                <div class="f-right">{{Auth::user()->home}}</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/major')}}">
                <div class="f-left">专业选择</div>

            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/price')}}">
                <div class="f-left">设定咨询费</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/share')}}">
                <div class="f-left">我的二维码</div>
            </a>
        </div>
        <div class="bottom-btn">
            <div class="blank100" style="height:120px;"></div>
            <div class="con te-cen">
                <p class="fs-14 fc-03aaf0">律师简介在电脑上登陆律屋网修改</p>
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