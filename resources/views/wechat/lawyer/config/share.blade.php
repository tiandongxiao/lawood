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
            <p class=" line-30">{{$user->office}}</p>
            <p class=" mar-top-20 line-30 fs-13">约见次数：{{$user->service_count}}次</p>
            <div class="mar-top-30"><img src="/images/ewm.png" width="160" height="160"></div>

            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="分享二维码" id="onMenuShareQQ">
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
        wx.config(<?php echo $js->config(array('onMenuShareQQ', 'onMenuShareWeibo','onMenuShareAppMessage'), false) ?>);
    </script>
    <script>
        $(function(){
            //切换默认
            $('#onMenuShareQQ').tap(function(){
                alert('good');
                wx.onMenuShareAppMessage({
                    title: "{!! $user->real_name !!} 律师", // 分享标题
                    desc: '来律屋，寻找您身边的律师，体验高效，快捷，专业的法律服务！', // 分享描述
                    link: "{!! url('wechat/user/'.$user->id) !!}", // 分享链接
                    imgUrl: '', // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        alert('分享成功');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        alert('取消分享');
                    }
                });
            });
        })
    </script>
@stop