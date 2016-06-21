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
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
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
                                        <span class="btn btn-hv" data-order="{{$order->id}}">忽略</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align:center;margin-top: 60%">您当前没有未完成的订单</div>
                    <div class="bottom-btn">
                        <div class="blank100" style="height:120px;"></div>
                        <div class="con te-cen">
                            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="返回首页">
                        </div>
                    </div>
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
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    @if($order->seller_signed)
                                    <div class="djs fc-03aaf0 fs-12">您已签到，等待顾客签到</div>
                                    @endif
                                    @if($order->client_signed)
                                    <div class="djs fc-03aaf0 fs-12">顾客已签到，等待您的签到</div>
                                    @endif
                                    <div class="btn-main">
                                        <a class="btn lan" href="tel:{{$order->client->phone}}">打电话</a>
                                        @if(!$order->seller_signed)
                                            <a class="btn lan" href="{{url('wechat/order/sign/'.$order->id)}}">咨询签到</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'accepted')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
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
                    @endforeach
                @else
                    <div style="text-align:center;margin-top: 60%">您当前没有进行中的订单</div>
                    <div class="bottom-btn">
                        <div class="blank100" style="height:120px;"></div>
                        <div class="con te-cen">
                            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="返回首页">
                        </div>
                    </div>
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
                                <div class="f-right">单号：{{$order->order_no}}</div>
                            </div>
                            <div class="con">
                                <div class="img"><img src="{{$order->client->avatar}}" width="70" height="70"></div>
                                <div class="xx">
                                    <p class="name chaochu_1 mar-top-5">客户 {{$order->client->real_name}}<span>{{$order->category}}</span></p>
                                    <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
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
                    <div class="bottom-btn">
                        <div class="blank100" style="height:120px;"></div>
                        <div class="con te-cen">
                            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="返回首页">
                        </div>
                    </div>
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
                <div class="btn fc-03aaf0" id="nothing">我再想想</div>
                <div class="btn" id="reject" data-order="">取消订单</div>
            </div>
        </div>
    </section>
    <!--取消订单-->
    <!--律师名片-->
    <div class="tc-m lsmp-main">
        <div class="bg-fff c-main" style="height: 375px;">
            <div class="tie">您附近的专业律师<i class="btn-fjls  btn-gb"></i></div>
            <div class="con">
                <div class="img">
                    <img src="/images/mp-banner.png" width="100%">
                    <a href="" class="link-more" id="detail_info">点击查看详情</a>
                    <div class="zxf">
                        <p class="top">咨询费</p>
                        <p class="bottom" style="top: -4px;"><span id="price">220</span><span class="fs-18">元</span></p>
                    </div>
                </div>
                <div class="name">
                    @if(!Auth::check())
                        <div class="f-right" ><span class="btn-ljzx">立即咨询</span></div>
                    @else
                        @if(Auth::user()->role != 'lawyer')
                            <div class="f-right" ><span class="btn-ljzx" style="top: 25px;">立即咨询</span></div>
                        @endif
                    @endif
                    <div class="left">
                        <h3 class="chaochu_1" ><span id="name">王树德</span>	<span>律师</span></h3>
                        <p class="chaochu_1" id="office">北京市朝阳区京师律师事务所</p>
                    </div>
                </div>
                <div class="bq">
                    <span class="jl" id="distance">0.5km</span>
                </div>
            </div>
        </div>
    </div>
    <!--律师名片-->
@stop
@section('script')
    <script>
        $(function(){
            //取消订单
            $('.btn-hv').tap(function(){
                $(this).data('order');
                $('#reject').data('order',$(this).data('order'));
                $('#qxdd').show();
            });
            $('#reject').tap(function () {
                $('#qxdd').hide();
                window.location.href = '/wechat/order/reject/'+$(this).data('order');
            });
            $('#nothing').tap(function () {
                $('#reject').data('order','');
                $('#qxdd').hide();
            });
            //切换
            $('.hd .itms').tap(function(){
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('.bd-itms').css({display:'none'});
                $('.bd-itms').eq($(this).index()).show();
            });
            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop