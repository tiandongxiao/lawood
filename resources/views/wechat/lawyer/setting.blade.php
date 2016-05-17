@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div class="form-list bg-fff-box">
            <div class="itms">
                <div class="f-left">真实姓名</div>
                <div class="f-right">王树德</div>
            </div>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/phone')}}">
                <div class="f-left">手机号码</div>
            </a>
            <div class="itms">
                <div class="f-left">律师证号</div>
                <div class="f-right">212345654321</div>
            </div>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/office')}}">
                <div class="f-left">律所名称</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/work')}}">
                <div class="f-left">工作区域</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/home')}}">
                <div class="f-left">居住区域</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/major')}}">
                <div class="f-left">专业选择</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/price')}}">
                <div class="f-left">设定咨询费</div>
            </a>
            <a class="itms itms-link" href="{{url('wechat/lawyer/config/qr')}}">
                <div class="f-left">我的二维码</div>
            </a>
        </div>
        <div class="bottom-btn">
            <div class="blank100" style="height:120px;"></div>
            <div class="con te-cen">
                <p class="fs-14 fc-03aaf0">律师简介在电脑上登陆律屋网修改</p>
                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定" id="In-btn">
            </div>
        </div>
    </section>
@stop
@section('script')
@stop