@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div class="te-cen">
            <img src="images/ls.jpg" width="70" height="70" class="br-100 mar-top-30">
            <p class="fs-16 fc-03aaf0  mar-top-20 line-20">王树德</p>
            <p class=" line-30">北京市朝阳区京师律师事务所</p>
            <p class=" mar-top-20 line-30 fs-13">约见次数：200次</p>
            <div class="mar-top-30"><img src="/images/ewm.png" width="160" height="160"></div>

            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="分享二维码" id="In-btn">
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop