@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div class="te-cen">
            <p class="fs-16 fc-03aaf0  mar-top-20 line-20">律屋在线</p>
            <div class="mar-top-15">
                <img src="/images/ewm.png" width="275px" height="275">
                <p>微信中长按二维码或微信搜索'律屋'加入我们</p>
            </div>
            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="律屋首页" >
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $(function(){
            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop
