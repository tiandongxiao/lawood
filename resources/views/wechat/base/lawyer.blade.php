<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#035c9b">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/global.css" rel="stylesheet" type="text/css" />
    <link href="/css/css.css" rel="stylesheet" type="text/css" />
    <title>律屋</title>
    @yield('css')
</head>
<body style="background:#f8f8f8">
@inject('category','App\Category')
<!--顶部-->
<div class="po-f nav-main">
    <div class="btn-cb"></div>
    <div class="btn-xl"></div>
    <div class="hd">
        @foreach($category->nodes as $node)
            @if($node['tab_name']=='ms')
                <div class="itms-hd on">{{$node['name']}}</div>
            @else
                <div class="itms-hd">{{$node['name']}}</div>
            @endif
        @endforeach
    </div>

    <div class="bd">
        @foreach($category->nodes as $node)
            @if($node['tab_name']=='ms')
                <div class="itms-bd clearfix show">
                    @foreach($node['nodes'] as $item)
                        <span class="list">{{$item['name']}}</span>
                    @endforeach
                </div>
            @else
                <div class="itms-bd clearfix">
                    @foreach($node['nodes'] as $item)
                        <span class="list">{{$item['name']}}</span>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>
<!--顶部-->

<!--侧边-->
<section class="cblm-main po-f" >
    <div class="main">
        <a class="itms itms-tx bor-bot">
            <div class="f-left"><img src="/images/tx.png" width="60" height="60" ></div>
            <div class="right">登录/注册</div>
        </a>
        <a class="itms" href="{{url('wechat/lawyer')}}">
            <div class="f-left"><img src="/images/nav1.png" width="20" height="20"></div>
            <div class="right">律屋主页</div>
        </a>
        <a class="itms" href="{{url('wechat/lawyer/notifies')}}">
            <div class="f-left"><img src="/images/nav2.png" width="20" height="20"></div>
            <div class="right">消息通知</div>
        </a>
        <a class="itms bor-bot" href="{{url('wechat/lawyer/orders')}}">
            <div class="f-left"><img src="/images/nav3.png" width="20" height="20"></div>
            <div class="right">我的订单</div>
        </a>
        <a class="itms " href="{{url('wechat/lawyer/me')}}">
            <div class="f-left"><img src="/images/nav4.png" width="20" height="20"></div>
            <div class="right">我的主页</div>
        </a>
        <a class="itms" href="{{url('wechat/lawyer/wallet')}}">
            <div class="f-left"><img src="/images/nav5.png" width="20" height="20"></div>
            <div class="right">我的钱包</div>
        </a>
        <a class="itms bor-bot" href="http://www.baidu.com">
            <div class="f-left"><img src="/images/nav6.png" width="20" height="20"></div>
            <div class="right">停用</div>
            <div class="ts">停用后律屋将停止</br>对您推荐</div>
            <input type="checkbox" class="In-check" >
        </a>
        <a class="itms bor-bot" href="{{url('wechat/lawyer/setting')}}">
            <div class="f-left">
                <img src="/images/nav7.png" width="20" height="20">
            </div>
            <div class="right">设置</div>
        </a>
    </div>
</section>
<!--侧边-->
@yield('content')
</body>
<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/tap.js"></script>
<script>
    $(function(){
        $('.dtdw-main').height($('body').height()-100)
        $(window).resize(function() {
            $('.dtdw-main').height($('body').height()-100)
        });

        //切换栏目
        $('.itms-hd').tap(function(){
            $('.itms-hd').removeClass('on');
            $(this).addClass('on');
            $('.itms-bd').removeClass('show');
            $('.itms-bd').removeClass('on');
            $('.itms-bd').eq($(this).index()).addClass('on');

        })

        //栏目下拉上升
        $(document).on('click','.btn-xl',function(){
            $('.nav-main').removeClass('on1');
            $('.nav-main').addClass('on');
            $(this).attr({class:'btn-ss'})
        })
        $(document).on('click','.btn-ss',function(){
            $('.nav-main').removeClass('on');
            $('.nav-main').addClass('on1');
            $(this).attr({class:'btn-xl'})
        })
        $('.nav-main').click(function(){
            if(event.target==this){
                $('.nav-main').removeClass('on');
                $('.nav-main').addClass('on1');
                $('.btn-ss').attr({class:'btn-xl'})
            }
        })
        //打开侧边
        $('.btn-cb').tap(function(){
            $('.cblm-main').removeClass('on1');
            $('.cblm-main').addClass('on')
        })
        $('.cblm-main').click(function(){

            if(event.target==this){
                $('.cblm-main').removeClass('on');
                $('.cblm-main').addClass('on1')
            }
        })
        //切换栏目
        $('.list').tap(function(){
            $('.list').removeClass('on');
            $(this).addClass('on')
        })
    })
</script>
@yield('script')
</html>