@extends('wechat.base.app')
@section('css')
    <style>
        body{background:#f8f8f8}
        .lstc-main {background: rgba(88, 88, 88, 0.92); }
        .fc-yellow-law {color: rgba(255, 152, 0, 0.67) !important;}
        .lszx-main	.c-main	.bottom	.itms-bd-1	.list-1{font-size: 13px;}
    </style>
@stop
@section('content')
    @if($user)
    <section class="lsjs-main" style="padding-bottom:50px;">
        <div class="lsimg te-cen">
            <img src="/images/banner.png" width="100%">
            <p class="name">{{$user->real_name}}</p>
            <p class="sx">律师</p>
        </div>
        <div class="xx">
            <div class="bq clearfix">
                @if($user->categories)
                @foreach($user->categories as $category)
                <span>{{$category->name}}</span>
                @endforeach
                @endif
            </div>
            <div class="fc-bcbcbc mar-top-20">{{$user->office}}</div>
            <div class="fc-bcbcbc line-30 mar-top-5">执业证号：{{$user->licence}}</div>
            <div class="nf fc-bcbcbc bor-top" style="padding-top: 12px;">
                <span>加入时间：{{$user->created_at->diffForHumans()}} </span>
                <span>约见次数：{{$user->service_count}} 次</span>
            </div>
        </div>
        <div class="lsjj">
            <div class="bg-fff-box">
                <div class="te-cen line-40 fc-03aaf0 fs-16">律师简介</div>
                <div class="jj pad-10 fs-12 fc-909090" id="jj-con">
                    @if($user->profile && $user->profile->description)
                        {{$user->profile->description}}
                    @else
                        <p style="text-align: center">律师尚未完善个人简介</p>
                    @endif
                </div>
            </div>
            @if($user->profile && $user->profile->description)
            <div class="btn-xl"></div>
            @endif
        </div>

        <div class="khpj mar-top-10 bg-fff-box">
            <div class="te-cen line-40 fc-03aaf0 fs-16">客户评价</div>
            <div class="pad-0-10">
                @if($orders->count())
                    @foreach($orders as $order)
                        @if($order->comment_id)
                        <div class="itms">
                            <div class="f-left"><img src="{{$order->client->avatar}}" width="50" height="50"></div>
                            <div class="right">
                                <div class="name">
                                    <p>{{$order->client->name}}  <span class="fc-d2d2d2">{{$order->rating->updated_at->diffForHumans()}}</span></p>
                                    <div class="pj">
                                        @if($order->rating->rating == 1)
                                            <em class="on"></em><em></em><em></em><em></em><em></em>
                                        @elseif($order->rating->rating == 2)
                                            <em class="on"></em><em class="on"></em><em></em><em></em><em></em>
                                        @elseif($order->rating->rating == 3)
                                            <em class="on"></em><em class="on"></em><em class="on"></em><em></em><em></em>
                                        @elseif($order->rating->rating == 4)
                                            <em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em><em></em>
                                        @elseif($order->rating->rating == 5)
                                            <em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em>
                                        @endif
                                    </div>
                                </div>
                                <div class="fc-909090 fs-12">{{$order->comment->body}}</div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <p style="text-align: center">当前没有客户评价信息</p>
                @endif
            </div>
        </div>
    </section>
    <footer class="yy-footer po-f">
        <div class="itms itms-left">
            @if($user->enable)
                <span style="color: #df8a13">欢迎咨询</span>
            @else
                <span style="color: #b94a48">暂停接单</span>
            @endif
            @if(Auth::check())
                @if(Auth::user()->role != 'lawyer')
                    @if($consult)
                        @if($consult->liked(Auth::user()->id))
                            <span class="sc on" id="sc" data-consult="{{$consult->id}}" data-client="{{Auth::user()->id}}"><i>收藏</i></span>
                        @else
                            <span class="sc" id="sc" data-consult="{{$consult->id}}" data-client="{{Auth::user()->id}}"><i>收藏</i></span>
                        @endif
                    @endif
                @else
                    <span><a href="{{url('wechat/lawyer/config/share')}}"><img src="/images/qrcode-48.png" width="28"></a></span>
                @endif
            @endif
        </div>
        @if(!$consult)
            @if(Auth::check() && Auth::user()->role == 'lawyer')
                <a class="itms te-cen bg-lan1 fc-fff" href="{{url('wechat')}}">返回首页</a>
            @else
                <div class="itms te-cen bg-lan1 fc-fff" id="In-btn">预约咨询</div>
            @endif
        @else
            @if(!Auth::check())
                <a class="itms te-cen bg-lan1 fc-fff" href="{{url('wechat/order/place/'.$consult->id)}}">预约咨询</a>
            @else
                @if(Auth::user()->role != 'lawyer')
                    <a class="itms te-cen bg-lan1 fc-fff" href="{{url('wechat/order/place/'.$consult->id)}}">预约咨询</a>
                @else
                    <a class="itms te-cen bg-lan1 fc-fff" href="{{url('wechat')}}">返回首页</a>
                @endif
            @endif
        @endif
    </footer>

    <section class="lstc-main" style="display: none">
        <!--律师咨询费-->
        <div class="tc-m lszx-main" style="top: 120px; display: block;">
            <div class="bg-fff c-main" style="overflow: hidden;height:375px;max-height: 420px;border-color: #24A7DF;">
                <div class="top">
                    <div class="tie">
                        <span style="font-size: 20px;font-weight: lighter;padding-left: 20px;">咨询费</span>
                        <i class="btn-fjls btn-gb"></i>
                    </div>
                    <div class="xx">
                        <div style="font-size:30px;font-weight: lighter" id="price">{{$user->prices[0]->price}} 元</div>
                        <p class="fs-12 line-15 mar-top-15">见面咨询90分钟</p>
                        <p class="fs-12 line-15 mar-top-5">电话咨询不超过60分钟</p>
                    </div>
                </div>
                <div class="bottom pad-10">
                    <div class="line-35 fc-yellow-law">选择咨询领域</div>
                    <div class="itms-bd-1 clearfix">
                        {!! csrf_field() !!}
                        <input type="hidden" name="uri" value="{{url('/')}}">
                        @foreach($user->prices as $price)
                            @if($price == $user->prices[0])
                                <span class="list-1 on" style="margin-right: 5px" data-price="{{$price->id}}" data-consult="{{$price->consults[0]->id}}">{{$price->category->name}}</span>
                            @else
                                <span class="list-1" style="margin-right: 5px" data-price="{{$price->id}}" data-consult="{{$price->consults[0]->id}}">{{$price->category->name}}</span>
                            @endif
                        @endforeach
                    </div>
                    <div class="In-btn In-btn-1 bg-lan1 fc-fff line-40 fs-16 btn-yjdd" style="margin-top: 60px">立即咨询</div>
                </div>
            </div>
        </div>
        <!--律师咨询费-->
    </section>
    @endif
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
    </script>
    <script>
        var consult = "{!! $user->prices[0]->consults[0]->id !!}"; //定义全局变量，用于标记选择
        $(function(){
            //下拉上升
            $(document).on('click','.btn-xl',function(){
                $('#jj-con').removeClass('on1');
                $('#jj-con').addClass('on');
                $(this).attr({class:'btn-ss'})
            });
            $(document).on('click','.btn-ss',function(){
                $('#jj-con').removeClass('on');
                $('#jj-con').addClass('on1');
                $(this).attr({class:'btn-xl'})
            });
            //收藏
            $('#sc').tap(function(){
                var __this = $(this);
                var consult = $(this).data('consult');
                var client = $(this).data('client');
                var address = $('input[name=uri]').val();
                if($(this).hasClass('on')){
                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/consult_liked',
                        data: {
                            'consult' : consult,
                            'client'  : client,
                            'operate' : 'unlike',
                            '_token':$('input[name=_token]').val(),
                        },
                        success: function(result){
                            if(result.code == 'Y'){
                                __this.toggleClass('on');
                                return true;
                            }
                            return false;
                        }
                    });
                }else{
                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/consult_liked',
                        data: {
                            'consult' : consult,
                            'client'  : client,
                            'operate' : 'like',
                            '_token':$('input[name=_token]').val()
                        },
                        success: function(result){
                            if(result.code == 'Y'){
                                __this.toggleClass('on');
                                return true;
                            }
                            return false;
                        }
                    });
                }
            });
            //律师咨询
            $('#In-btn').tap(function(){
                $('.lsjs-main').hide();
                $('.lstc-main').show();
                $('.tc-m').show();
            });

            //切换咨询栏目
            $('.list-1').tap(function(){
                $('.list-1').removeClass('on');
                $(this).addClass('on');
                consult = $(this).data('consult');

                var select = $(this).data('price');
                var address = $('input[name=uri]').val();
                var price_dom = $('#price');

                $.ajax({
                    type: 'POST',
                    url: address+'/ajax/price',
                    data: {
                        'price' : select,
                        '_token':$('input[name=_token]').val(),
                    },
                    success: function(result){
                        if(result.code == 'Y'){
                            price_dom.fadeOut();
                            price_dom.text(result.data+" 元");
                            price_dom.fadeIn();
                            return true;
                        }
                        price_dom.fadeOut();
                        price_dom.text("获取数据失败");
                        price_dom.fadeIn();
                        return false;
                    }
                });
            });
            // 立即咨询
            $('.btn-yjdd').click(function(){
               window.location.href="/wechat/order/place/"+consult;
            });

            $('.btn-gb').tap(function(){
                $('.lstc-main').hide();
                $('.tc-m').hide();
                $('.lsjs-main').show();
            });
        })
    </script>
@stop