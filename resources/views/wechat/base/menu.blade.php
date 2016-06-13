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
    @if(Auth::user())
    <div class="btn-cb"></div>
    @endif
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

@if(Auth::user())
<!--侧边-->
<section class="cblm-main po-f" >
    <div class="main">
    @if(Auth::user()->role == 'lawyer')
        <a class="itms itms-tx bor-bot">
            <div class="f-left"><img src="{{Auth::user()->avatar}}" width="60" height="60" ></div>
            <div class="right">{{Auth::user()->real_name}} <span style="color: #df8a13">[{{Auth::user()->status}}]</span></div>
        </a>
        <a class="itms" href="{{url('wechat')}}">
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
        <a class="itms " href="{{url('wechat/user/'.Auth::user()->id)}}">
            <div class="f-left"><img src="/images/nav4.png" width="20" height="20"></div>
            <div class="right">我的主页</div>
        </a>
        <a class="itms" href="{{url('wechat/lawyer/wallet')}}">
            <div class="f-left"><img src="/images/nav5.png" width="20" height="20"></div>
            <div class="right">我的钱包</div>
        </a>
        @if(Auth::user()->active)
            <div class="itms bor-bot">
                <div class="f-left"><img src="/images/nav6.png" width="20" height="20"></div>
                @if(Auth::user()->enable)
                    <div class="right">停用</div>
                    <div class="ts">停用后律屋将停止</br>对您推荐</div>
                @else
                    <div class="right">开启</div>
                    <div class="ts">开启后咨询用户才</br>可找到您</div>
                @endif
                <input type="hidden" name="uri" value="{{url('/')}}">
                <input type="hidden" name="user" value="{{Auth::user()->id}}">
                {!! csrf_field() !!}
                @if(Auth::user()->enable)
                    <input type="checkbox" class="In-check" id="In-service" checked>
                @else
                    <input type="checkbox" class="In-check" id="In-service">
                @endif
            </div>
        @endif
        <a class="itms bor-bot" href="{{url('wechat/lawyer/setting')}}">
            <div class="f-left">
                <img src="/images/nav7.png" width="20" height="20">
            </div>
            <div class="right">设置</div>
        </a>

    @elseif(Auth::user()->role == 'client')
        <div class="itms itms-tx bor-bot">
            <div class="f-left"><img src="{{Auth::user()->avatar}}" width="60" height="60" ></div>
            <div class="right">{{Auth::user()->real_name}} <span style="color: #df8a13">[{{Auth::user()->status}}]</span></div>
        </div>
        <a class="itms" href="{{url('wechat')}}">
            <div class="f-left"><img src="/images/nav1.png" width="20" height="20"></div>
            <div class="right">律屋主页</div>
        </a>
        <a class="itms" href="{{url('wechat/client/notifies')}}">
            <div class="f-left"><img src="/images/nav2.png" width="20" height="20"></div>
            <div class="right">消息通知</div>
        </a>
        <a class="itms" href="{{url('wechat/client/orders')}}">
            <div class="f-left"><img src="/images/nav3.png" width="20" height="20"></div>
            <div class="right">我的订单</div>
        </a>
        <a class="itms bor-bot" href="{{url('wechat/client/orders')}}">
            <div class="f-left"><img src="/images/nav4.png" width="20" height="20"></div>
            <div class="right">我的收藏</div>
        </a>
        <a class="itms bor-bot" href="{{url('wechat/client/setting')}}">
            <div class="f-left">
                <img src="/images/nav7.png" width="20" height="20">
            </div>
            <div class="right">设置</div>
        </a>
    @elseif(Auth::user()->role == 'none')
        <div class="itms itms-tx bor-bot">
            <div class="f-left"><img src="{{Auth::user()->avatar}}" width="60" height="60" ></div>
            <div class="right">{{Auth::user()->real_name}} <span style="color: #df8a13">[{{Auth::user()->status}}]</span></div>
        </div>
        <a class="itms" href="{{url('wechat')}}">
            <div class="f-left"><img src="/images/nav1.png" width="20" height="20"></div>
            <div class="right">律屋主页</div>
        </a>
        <a class="itms" href="{{url('wechat/client/notifies')}}">
            <div class="f-left"><img src="/images/nav2.png" width="20" height="20"></div>
            <div class="right">消息通知</div>
        </a>
        <a class="itms" href="{{url('wechat/client/orders')}}">
            <div class="f-left"><img src="/images/nav3.png" width="20" height="20"></div>
            <div class="right">我的订单</div>
        </a>
        <a class="itms bor-bot" href="{{url('wechat/client/orders')}}">
            <div class="f-left"><img src="/images/nav4.png" width="20" height="20"></div>
            <div class="right">我的收藏</div>
        </a>
        <a class="itms bor-bot" href="{{url('wechat/client/setting')}}">
            <div class="f-left">
                <img src="/images/nav7.png" width="20" height="20">
            </div>
            <div class="right">设置</div>
        </a>
    @endif
    </div>
</section>
<!--侧边-->
@endif

@yield('content')
</body>
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="/js/tap.js"></script>
<script>
    var major,tabName;
    $(function(){
        $('.dtdw-main').height($('body').height()-100)
        $('.tc-m').css({top:$('body').height()*0.95-400});
        $('.tie').css({top:$('body').height()*0.95-400});
        $('.btn-ddxz').css({top:$('body').height()*0.95-65});
        $(window).resize(function() {
            $('.dtdw-main').height($('body').height()-100)
            $('.tc-m').css({top:$('body').height()*0.95-400});
            $('.tie').css({top:$('body').height()*0.95-400});
            $('.btn-ddxz').css({top:$('body').height()*0.95-65});
        });

        //切换栏目
        $('.itms-hd').tap(function(){
            $('.itms-hd').removeClass('on');
            $(this).addClass('on');
            tabName = $(this).text();
            $('.itms-bd').removeClass('show');
            $('.itms-bd').removeClass('on');
            $('.itms-bd').eq($(this).index()).addClass('on');

        });

        //栏目下拉上升
        $(document).on('click','.btn-xl',function(){
            $('.nav-main').removeClass('on1');
            $('.nav-main').addClass('on');
            $(this).attr({class:'btn-ss'})
        });

        $(document).on('click','.btn-ss',function(){
            $('.nav-main').removeClass('on');
            $('.nav-main').addClass('on1');
            $(this).attr({class:'btn-xl'})
        });

        $('.nav-main').click(function(){
            if(event.target==this){
                $('.nav-main').removeClass('on');
                $('.nav-main').addClass('on1');
                $('.btn-ss').attr({class:'btn-xl'})
            }
        });
        //切换栏目
        $('.list').tap(function(){
            $('.list').removeClass('on');
            $(this).addClass('on');
            major = $(this).text();
        });

        @if(Auth::user())
        //打开侧边
        $('.btn-cb').click(function(){
            $('.cblm-main').removeClass('on1');
            $('.cblm-main').addClass('on');
            event.preventDefault();
        });
        $('.cblm-main').click(function(){
            if(event.target==this){
                $('.cblm-main').removeClass('on');
                $('.cblm-main').addClass('on1')
            }
        });
        @if(Auth::user()->role =='lawyer')
        var address = $('input[name=uri]').val();
        $("#In-service").change(function() {
            if ($('#In-service').is(':checked')){
                $.ajax({
                    type: 'POST',
                    url: address + '/ajax/start',
                    data: {
                        'user':$('input[name=user]').val(),
                        '_token':$('input[name=_token]').val(),
                    },
                    success: function (data) {
                        if(data == 'X'){
                            $("#In-service").removeAttr("checked");
                        }
                    }
                })
            }else{
                $.ajax({
                    type: 'POST',
                    url: address + '/ajax/stop',
                    data: {
                        'user':$('input[name=user]').val(),
                        '_token':$('input[name=_token]').val(),
                    },
                    success: function (data) {
                        if(data == 'X'){
                            $("#In-service").attr("checked",'true');
                        }
                    }
                })
            }
        });
        @endif
        @endif
    })
</script>
@yield('script')
</html>