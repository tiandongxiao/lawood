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
            <div class="bd-itms" style="display:block">
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
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
                            <span class="btn lan">确认接单</span>
                            <span class="btn btn-hv">忽略</span>
                        </div>
                    </div>
                </div>
                <!--列表-->
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">

                        <div class="djs"  id="leftTime1">正在加载中</div>
                        <script type="text/javascript">
                            //第一个为倒计时传人ID 第二个为倒计时限制时间
                            addTimer("leftTime1", 3600);
                        </script>
                        <div class="btn-main">
                            <span class="btn lan">确认接单</span>
                            <span class="btn btn-hv">忽略</span>
                        </div>
                    </div>
                </div>
                <!--列表-->
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <p class="te-cen fc-909090">过期未接单</p>
                    </div>
                </div>
                <!--列表-->
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <p class="te-cen fc-909090">客户已取消订单</p>
                    </div>
                </div>
                <!--列表-->
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <p class="te-cen fc-909090">已忽略订单</p>
                    </div>
                </div>
                <!--列表-->
            </div>
            <!--未完成-->

            <!--进行中-->
            <div class="bd-itms">
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">

                        <div class="btn-main">
                            <a class="btn lan" href="#">打电话</a>
                            <a class="btn lan" href="#">签到咨询</a>
                        </div>
                    </div>
                </div>
                <!--列表-->
            </div>
            <!--进行中-->


            <!--已完成-->
            <div class="bd-itms">
                <!--列表-->
                <div class="itms bg-fff-box">
                    <div class="top">
                        <div class="f-left">下单时间 16:00 11月1日</div>
                        <div class="f-right">单编号：11222324321</div>
                    </div>
                    <div class="con">
                        <div class="img"><img src="/images/tx.png" width="70" height="70"></div>
                        <div class="xx">
                            <p class="name chaochu_1">客户 马娟<span>婚姻</span></p>
                            <p class="dd chaochu_2">预约地点：COST咖啡厅</p>
                            <p class="jl chaochu_1">距离：0.9km</p>

                            <div class="zxf">
                                <p>已付咨询费</p>
                                <p class="jg">220元</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--列表-->

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
    <script src="/js/time-djs.js"></script>
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
                $(this).siblings().removeClass('on')
                $(this).addClass('on')
                $('.bd-itms').css({display:'none'})
                $('.bd-itms').eq($(this).index()).fadeIn();
            });
        })
    </script>
@stop