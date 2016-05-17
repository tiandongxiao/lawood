@extends('wechat.base.app')
@section('content')

    <section class="wdqb-main">
        <div class="top">
            <div class="f-left">我的余额</div>
            <div class="right">￥<span>1200.00</span></div>
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
                <div class="itms">
                    <div class="f-left">
                        <h3>收入－马娟</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">＋300.00</div>
                </div>
                <div class="itms">
                    <div class="f-left">
                        <h3>收入－马娟</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">＋300.00</div>
                </div>
                <div class="itms">
                    <div class="f-left">
                        <h3>提现</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">-300.00</div>
                </div>
                <div class="itms">
                    <div class="f-left">
                        <h3>提现</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">-300.00</div>
                </div>
            </div>
            <!--全部-->
            <!--收入-->
            <div class="bd-itms">
                <div class="itms">
                    <div class="f-left">
                        <h3>收入－马娟</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">＋300.00</div>
                </div>
                <div class="itms">
                    <div class="f-left">
                        <h3>收入－马娟</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">＋300.00</div>
                </div>
            </div>
            <!--收入-->
            <!--提现-->
            <div class="bd-itms">
                <div class="itms">
                    <div class="f-left">
                        <h3>提现</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">-300.00</div>
                </div>
                <div class="itms">
                    <div class="f-left">
                        <h3>提现</h3>
                        <p>2016-03-31</p>
                    </div>
                    <div class="right">-300.00</div>
                </div>
            </div>
            <!--提现-->
        </div>
    </section>
@stop
@section('script')
    <script>
        $(function(){
            $('.hd .itms').tap(function(){
                $(this).siblings().removeClass('on')
                $(this).addClass('on')
                $('.bd-itms').css({display:'none'})
                $('.bd-itms').eq($(this).index()).fadeIn();
            })
        })
    </script>
@stop