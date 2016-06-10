@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('script-header')
    <script src="/js/time-djs.js"></script>
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
            <div class="bd-itms" style="display:block">
                @if($applies)
                    @foreach($applies as $order)
                        @if($order->statusCode == 'payed')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
                                        <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                        <p class="jl chaochu_1">距离：0.9km</p>

                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs"  id="leftTime0">正在加载中</div>
                                    <script type="text/javascript">
                                        //第一个为倒计时传人ID 第二个为倒计时限制时间
                                        addTimer("leftTime0", 100);
                                    </script>
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="{{url('wechat/order/accept/'.$order->id)}}">确认接单</a></span>
                                        <span class="btn btn-hv"><a href="{{url('wechat/order/reject/'.$order->id)}}">忽略</a></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align:center;margin-top: 60%">您当前没有未完成的订单</div>
                @endif
            </div>
            <!--未完成-->

            <!--进行中-->
            <div class="bd-itms">
                @if($ongoings)
                    @foreach($ongoings as $order)
                        @if($order->statusCode == 'in_process')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
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
                                        <a class="btn lan" href="tel:{{$order->client->phone}}">打电话</a>
                                        <a class="btn lan" href="{{url('wechat/order/sign/'.$order->id)}}">咨询签到</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'accepted')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">订单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
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
                                        <a class="btn lan" href="tel:{{$order->client->phone}}">打电话</a>
                                        <a class="btn lan" href="#">签到咨询</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align:center;margin-top: 60%">您当前没有进行中的订单</div>
                @endif
            </div>
            <!--进行中-->

            <!--已完成-->
            <div class="bd-itms">
                @if($completes)
                    @foreach($completes as $order)
                        <div class="itms bg-fff-box">
                            <div class="top">
                                <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                <div class="f-right">订单号：{{$order->order_no}}</div>
                            </div>
                            <div class="con">
                                <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                <div class="xx">
                                    <p class="name chaochu_1">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
                                    <p class="dd chaochu_2">预约地点：{{$order->place->name}}</p>
                                    <p class="jl chaochu_1">距离：0.9km</p>
                                    <div class="zxf">
                                        <p>已付咨询费</p>
                                        <p class="jg">{{$order->total}}元</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align:center;margin-top: 60%">您当前没有已完成的订单</div>
                @endif
            </div>
            <!--已完成-->

        </div>
    </section>

    <!--取消订单-->
    <section class="tc-main"  style="display:none" id="qxdd">
        <div class="main te-cen"  style="top:40%;">
            <div class="line-30 fc-909090  fs-16 mar-top-20">正在取消订单</div>
            <div class="btn-main mar-top-10">
                <div class="btn fc-03aaf0">我再想想</div>
                <div class="btn">取消订单</div>
            </div>
        </div>
    </section>
    <!--取消订单-->
@stop
@section('script')
    <script>
        $(function(){
            //取消订单
            $('.btn-hv').tap(function(){
                $('#qxdd').fadeIn();

            });
            $('#qxdd .btn').tap(function(){
                $('#qxdd').fadeOut();
            });
            //切换
            $('.hd .itms').tap(function(){
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('.bd-itms').css({display:'none'});
                $('.bd-itms').eq($(this).index()).show();
            });
        })
    </script>
@stop