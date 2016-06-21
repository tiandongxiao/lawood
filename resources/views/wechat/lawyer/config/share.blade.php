@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div class="te-cen">
            @if($user)
            <img src="{{$user->avatar}}" width="70" height="70" class="br-100 mar-top-30">
            <p class="fs-16 fc-03aaf0  mar-top-20 line-20">{{$user->real_name}}</p>
            <div class="mar-top-15">{!! QrCode::encoding('UTF-8')->size(275)->generate(url('wechat/user/'.$user->id)) !!}</div>
            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="返回首页" >
                </div>
            </div>
            @else
                <div style="text-align: center;margin-top: 60%">获取失败</div>
            @endif
        </div>
    </section>
@stop
@section('script')
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareTimeline','onMenuShareAppMessage'), false) ?>);
    </script>
    <script>
        wx.ready(function () {
            var shareData = {
                title: '{!! $user->real_name !!} 律师名片',
                desc: '{!! $user->real_name !!} 律师主页',
                link: '{!! url('wechat/user/'.$user->id) !!}',
                imgUrl: '{!! $user->avatar !!}'
            };
            wx.onMenuShareAppMessage(shareData);
            wx.onMenuShareTimeline(shareData);
            wx.onMenuShareQQ(shareData);
        });
        $(function(){
            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop