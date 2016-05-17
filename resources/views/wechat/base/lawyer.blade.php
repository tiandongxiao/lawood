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
<!--顶部-->
<div class="po-f nav-main">
    <div class="btn-cb"></div>
    <div class="btn-xl"></div>
    <div class="hd">
        <div class="itms-hd on">民事、经济</div>
        <div class="itms-hd">刑事案件</div>
        <div class="itms-hd">行政案件</div>
    </div>

    <div class="bd">
        <div class="itms-bd clearfix show">
            <span class="list on">婚姻</span>
            <span class="list">房产</span>
            <span class="list">债务</span>
            <span class="list">劳动争议</span>
            <span class="list">合同纠纷</span>
            <span class="list">损害赔偿</span>
            <span class="list">医疗纠纷</span>
            <span class="list">建设工程</span>
            <span class="list">著作权</span>
            <span class="list">商标权</span>
            <span class="list">专利权</span>
            <span class="list">土地</span>
            <span class="list">股权</span>
        </div>
        <div class="itms-bd clearfix">
            <span class="list">婚姻</span>
            <span class="list">房产</span>
            <span class="list">债务</span>
            <span class="list">劳动争议</span>
            <span class="list">合同纠纷</span>
            <span class="list">损害赔偿</span>
            <span class="list">医疗纠纷</span>
            <span class="list">建设工程</span>
            <span class="list">著作权</span>
            <span class="list">商标权</span>
            <span class="list">专利权</span>
            <span class="list">土地</span>
            <span class="list">股权</span>
            <span class="list">商标权</span>
            <span class="list">专利权</span>
            <span class="list">土地</span>
            <span class="list">股权</span>

        </div>
        <div class="itms-bd clearfix">
            <span class="list">婚姻</span>
            <span class="list">房产</span>
            <span class="list">债务</span>
            <span class="list">劳动争议</span>
            <span class="list">合同纠纷</span>
            <span class="list">损害赔偿</span>
            <span class="list">医疗纠纷</span>
            <span class="list">建设工程</span>
            <span class="list">著作权</span>
            <span class="list">商标权</span>
            <span class="list">专利权</span>
            <span class="list">土地</span>
            <span class="list">股权</span>

        </div>
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
        //查看更多律师
        $('#btn-more').tap(function(){
            $('.lstc-main').fadeIn();
            $('.fjls-main').fadeIn();
        })

        //查看名片
        $('.btn-ckmp').tap(function(){
            $('.fjls-main').css({display:'none'});
            $('.lsmp-main').fadeIn();
        })
        //返回附近律师
        $('.back-fjls').tap(function(){
            $('.lsmp-main').css({display:'none'});
            $('.fjls-main').fadeIn();
        })
        //律师咨询
        $('.btn-ljzx').tap(function(){
            $('.lsmp-main').css({display:'none'});
            $('.lszx-main').fadeIn();
        })
        //返回律师名片
        $('.back-lsmp').tap(function(){
            $('.lszx-main').css({display:'none'});
            $('.lsmp-main').fadeIn();
        })

        //切换咨询栏目
        $('.list-1').tap(function(){
            $('.list-1').removeClass('on');
            $(this).addClass('on')
        })

        //约见地点
        $('.btn-yjdd').tap(function(){
            $('.lszx-main').css({display:'none'});
            $('.yjdd-main').fadeIn();
        })

        //返回律师咨询
        $('.back-lszx').tap(function(){
            $('.yjdd-main').css({display:'none'});
            $('.lszx-main').fadeIn();
        })
        //关闭弹出框
        $('.lstc-main').click(function(){

            if(event.target==this){
                $('.lstc-main').fadeOut();
                $('.tc-m').fadeOut();
            }
        })
        $('.btn-gb').tap(function(){

            $('.lstc-main').fadeOut();
            $('.tc-m').fadeOut();
        })
    })
</script>
@yield('script')
</html>