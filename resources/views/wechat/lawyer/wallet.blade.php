@extends('wechat.base.app')
@section('content')
    <section class="wdqb-main">
        <div class="top">
            <div class="f-left">我的余额</div>
            <div class="right fs-24">￥<span>{{$incoming}}</span></div>
        </div>
        <div class="bg-f8f8f8 clearfix pad-10-0">
            <a href="{{url('wechat/lawyer/draw')}}" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16 line-40" >全部提现</a>
        </div>
        <div class="hd">
            <div  class="itms on"><span>全部</span></div>
            <div  class="itms"><span>收入明细</span></div>
            <div class="itms"><span>提现明细</span></div>
        </div>
        <div class="bd">
            <!--全部-->
            <div class="bd-itms" style="display:block;">
                @if($orders)
                    @foreach($orders as $order)
                        @if(!$order->withdrew)
                            <div class="itms">
                                <div class="f-left">
                                    <h3>收入－{{$order->client->real_name}}</h3>
                                    <p class="mar-top-10">{{$order->updated_at}}</p>
                                </div>
                                <div class="right">＋{{$order->total}}</div>
                            </div>
                        @else
                            <div class="itms">
                                <div class="f-left">
                                    <h3>提现</h3>
                                    <p class="mar-top-10">{{$order->updated_at}}</p>
                                </div>
                                <div class="right">- {{$order->total}}</div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <!--全部-->
            <!--收入-->
            <div class="bd-itms">
                @if($orders)
                    @foreach($orders as $order)
                        @if(!$order->withdrew)
                            <div class="itms">
                                <div class="f-left">
                                    <h3>收入－{{$order->client->real_name}}</h3>
                                    <p class="mar-top-10">{{$order->updated_at}}</p>
                                </div>
                                <div class="right">＋{{$order->total}}</div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <!--收入-->
            <!--提现-->
            <div class="bd-itms">
                @if($orders)
                    @foreach($orders as $order)
                        @if($order->withdrew)
                            <div class="itms">
                                <div class="f-left">
                                    <h3>提现</h3>
                                    <p class="mar-top-10">{{$order->updated_at}}</p>
                                </div>
                                <div class="right">- {{$order->total}}</div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align:center;margin-top: 60%">您当前没有任何收支记录</div>
                @endif
            </div>
            <!--提现-->
        </div>
    </section>
@stop
@section('script')
    <script>
        $(function(){
            $('.hd .itms').tap(function(){
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('.bd-itms').css({display:'none'});
                $('.bd-itms').eq($(this).index()).fadeIn();
            })
        })
    </script>
@stop