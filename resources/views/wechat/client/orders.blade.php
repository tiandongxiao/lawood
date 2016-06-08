@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lsdd-main">
        <div class="hd po-f">
            <div class="itms on"><span>未完成</span></div>
            <div class="itms"><span>进行中</span></div>
            <div class="itms"><span>已完成</span></div>
        </div>
        <div class="bd" style="padding-top:40px;">
            <!--未完成-->
            <div class="bd-itms"  style="display:block">
                @if($applies)
                    @foreach($applies as $order)
                        @if($order->statusCode == 'pending')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>{{$order->category}}</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>需付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="{{url('wxpay/js/'.$order->id)}}">支付</a></span>
                                        <span class="btn">取消订单</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'payed')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">正在等待律师接单…</div>
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="tel:{{$order->seller->phone}}">拨打电话</a></span>
                                        <span class="btn">取消订单</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'rejected')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">律师拒绝接单，费用已退回</div>
                                    <div class="btn-main">
                                        <span class="btn lan">重新查找</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'canceled')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">订单已取消，费用已退回</div>
                                    <div class="btn-main">
                                        <span class="btn lan">重新查找</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'expired')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">订单过期未接单，费用已退回</div>
                                    <div class="btn-main">
                                        <span class="btn lan">重新查找</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align:center;">您当前没有未完成的订单</div>
                @endif
            </div>
            <!--未完成-->
            <!--进行中-->
            <div class="bd-itms" >
                @if($ongoings)
                    @foreach($ongoings as $order)
                        @if($order->statusCode == 'in_process')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="tel:{{$order->seller->phone}}">打电话</a></span>
                                        <span class="btn lan">签到咨询</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'accepted')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="tel:{{$order->seller->phone}}">打电话</a></span>
                                        <span class="btn lan">签到咨询</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align:center;">您当前没有进行中的订单</div>
                @endif
            </div>
            <!--进行中-->
            <!--已完成-->
            <div class="bd-itms">
                @if($completes)
                    @foreach($completes as $order)
                        <div class="itms bg-fff-box">
                            <div class="top">
                                <div class="f-left">下单时间 16:00 11月1日</div>
                                <div class="f-right">订单号：{{$order->order_no}}</div>
                            </div>
                            <div class="con">
                                <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                <div class="xx">
                                    <p class="name chaochu_1">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                    <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                    <p class="jl chaochu_1">距离：0.9km</p>
                                    <div class="zxf">
                                        <p>已付咨询费</p>
                                        <p class="jg">{{$order->total}}元</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="btn-main">
                                    <span class="btn lan btn-ljpj">立即评价</span>
                                    <span class="btn lan btn-xgpj">修改评价</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align:center;">您当前没有进行中的订单</div>
                @endif
            </div>
            <!--已完成-->
        </div>
    </section>
    <!--首次评价-->
    <section class="tc-main pj-main po-f"  style="display:none" id="ljpj">
        <div class="main te-cen"  style="top:6%;">
            <div class="lsxx">
                <div class="f-left"><img src="/images/ls.jpg" width="60" height="60"></div>
                <div class="right">
                    <div class="name">王树德 律师</div>
                    <div class="dz chaochu_1">北京市朝阳区京师律师事务所</div>
                    <div class="cs chaochu_1">约见次数：200次</div>
                </div>
            </div>
            <div class="pjcs pad-0-10">
                <div class="title"><span>星级评价</span></div>
                <div class="pj">
                    <em data-sx="很差劲" class="on"></em>
                    <em data-sx="差劲" class="on"></em>
                    <em data-sx="一般" class="on"></em>
                    <em data-sx="比较满意，但仍可改善"></em>
                    <em data-sx="非常满意"></em>
                </div>
                <div class="xxts fs-12 line-20 fc-03aaf0">比较满意，但仍可改善</div>
            </div>
            <div class="lsyx pad-0-10">
                <div class="title"><span>律师印象</span></div>
                <div class="itms">
                    <div class="f-left">准时：</div>
                    <div class="right">
                        <span>提前</span>
                        <span class="on">按时</span>
                        <span>迟到</span>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">穿着：</div>
                    <div class="right">
                        <span>职业</span>
                        <span class="on">随意</span>
                        <span>邋遢</span>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">专业：</div>
                    <div class="right">
                        <span>给赞</span>
                        <span class="on">一般</span>
                        <span>差劲</span>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">礼貌：</div>
                    <div class="right">
                        <span>给赞</span>
                        <span class="on">一般</span>
                        <span>差劲</span>
                    </div>
                </div>
            </div>
            <div class="pjyj  pad-0-10 mar-top-10"><textarea placeholder="其他意见和建议" class="In-text"></textarea></div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10"  value="提交" id="In-btn">
        </div>
    </section>
    <!--首次评价-->

    <!--修改评价-->
    <section class="tc-main pj-main po-f"  style="display:none" id="xgpj">
        <div class="main te-cen"  style="top:20%;">
            <div class="lsxx">
                <div class="f-left"><img src="images/ls.jpg" width="60" height="60"></div>
                <div class="right">
                    <div class="name">王树德 律师</div>
                    <div class="dz chaochu_1">北京市朝阳区京师律师事务所</div>
                    <div class="cs chaochu_1">约见次数：200次</div>
                </div>
            </div>
            <div class="pjcs pad-0-10">
                <div class="title"><span>星级评价</span></div>
                <div class="pj">
                    <em data-sx="很差劲" class="on"></em>
                    <em data-sx="差劲" class="on"></em>
                    <em data-sx="一般" class="on"></em>
                    <em data-sx="比较满意，但仍可改善"></em>
                    <em data-sx="非常满意"></em>
                </div>
                <div class="xxts fs-12 line-20 fc-03aaf0">比较满意，但仍可改善</div>
            </div>
            <div class="pjyj  pad-0-10 mar-top-10"><textarea placeholder="其他意见和建议" class="In-text"></textarea></div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10"  value="提交" id="In-btn">
        </div>
    </section>
    <!--修改评价-->
@stop
@section('script')
    <script>
        $(function(){
            //检查版本
            var u = navigator.userAgent, app = navigator.appVersion;
            var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

            //苹果兼容
            if(isiOS){
                $('.In-text').focus(function(){
                    $('.po-f').addClass('po-a');
                }).blur(function(){//输入框失焦后还原初始状态
                    $('.po-f').removeClass('po-a')
                });
            }
            //切换标记
            $('.lsyx .itms .right span').tap(function(){
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
            });
            //评价
            $('.pj em').click(function(){
                $(this).siblings().removeClass('on');
                var EmIndex	= $(this).index();
                $('.xxts').text($(this).attr('data-sx'));
                for (var i=0;i<=EmIndex;i++){
                    $(this).parent('.pj').children('em').eq(i).addClass('on');
                }
            });
            // 弹出评价
            $('.btn-ljpj').tap(function(){
                $('#ljpj').fadeIn();
            });
            $('.btn-xgpj').tap(function(){
                $('#xgpj').fadeIn();
            });
            $('.tc-main').tap(function(){
                if(event.target==this){
                    $('.tc-main').fadeOut();
                }
            });
            //切换
            $('.hd .itms').tap(function(){
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('.bd-itms').css({display:'none'});
                $('.bd-itms').eq($(this).index()).fadeIn();
            });
        })
    </script>
@stop