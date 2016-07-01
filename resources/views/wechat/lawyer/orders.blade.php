@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lsdd-main">
        <div class="hd po-f">
            <div class="itms" data-tab='applies'><span>未完成</span></div>
            <div class="itms" data-tab="in_process"><span>进行中</span></div>
            <div class="itms" data-tab="completed"><span>已完成</span></div>
            <div id="refresh" style="position: absolute;right: 5px;"><img src="/images/refresh-simple.png" width="30px" height="30px"></div>
        </div>
        <div class="bd" style="padding-top:40px;">
            <!--未完成-->
            <div class="bd-itms">
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
                                        <p class="dd chaochu_2 mar-top-15">预约地点：<a href="{{url('wechat/order/poi/'.$order->place->poi_id)}}" style="color: #BE5C00;">{{$order->place->name}}</a></p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    @if($order->receipt)
                                        <div class="djs fc-03aaf0 fs-12 receipt" data-user="{{$order->user->id}}" data-order="{{$order->id}}">需开发票</div>
                                    @else
                                        <div class="djs fc-03aaf0 fs-12">无需开发票</div>
                                    @endif
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
                                        <p class="dd chaochu_2 mar-top-15">预约地点：<a href="{{url('wechat/order/poi/'.$order->place->poi_id)}}" style="color: #BE5C00;">{{$order->place->name}}</a></p>
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
                                        <p class="dd chaochu_2 mar-top-15">预约地点：<a href="{{url('wechat/order/poi/'.$order->place->poi_id)}}" style="color: #BE5C00;">{{$order->place->name}}</a></p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    @if($order->receipt)
                                        <div class="djs fc-03aaf0 fs-12 receipt" data-user="{{$order->user->id}}" data-order="{{$order->id}}">需开发票</div>
                                    @else
                                        <div class="djs fc-03aaf0 fs-12">无需开发票</div>
                                    @endif
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
                            <div class="bottom">
                                @if($order->receipt)
                                    <div class="djs fc-03aaf0 fs-12 receipt"  data-user="{{$order->user->id}}" data-order="{{$order->id}}">需开发票</div>
                                @else
                                    <div class="djs fc-03aaf0 fs-12">无需开发票</div>
                                @endif
                                <div class="btn-main">
                                    <a class="btn lan" href="tel:{{$order->client->phone}}">打电话</a>
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
    <section class="lstc-main"   style="display:none;" id="receipt-area">
        <!--发票信息-->
        <div class="tc-m lsmp-main" style="display: block;bottom: 100px">
            <div class="bg-fff c-main" style="height: 335px;">
                <div class="tie" style="width: 100%">发票信息<i class="btn-fjls  btn-gb"></i></div>
                <div style="text-align: center;margin-top: 5px"><img id="avatar" src="/images/user1-128x128.jpg" width="80px" height="80px" style="border-radius: 10px;"></div>
                <div style="padding: 25px">
                    {!! csrf_field() !!}
                    <input type="hidden" name="uri" value="{{url('/')}}">
                    <div style="margin-top: 8px"><span>收 &nbsp;件 &nbsp;人：</span><span id="receiver">王国营</span></div>
                    <div style="margin-top: 8px"><span>电话号码：</span><span id="phone">18511892536</span></div>
                    <div style="margin-top: 8px"><span>发票抬头：</span><span id="title">北京易行动科技有限公司</span></div>
                    <div style="margin-top: 8px"><span>邮寄地址：</span><span id="address" style="line-height: 25px;color: #DEB887">北京市朝阳区望京宝星国际小区108楼7单元20A</span></div>
                </div>
            </div>
        </div>
        <!--发票信息-->
    </section>
@stop
@section('script')
    <script>
        $(function(){
            function appleFit() {
                //检查版本
                var u = navigator.userAgent, app = navigator.appVersion;
                var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

                //苹果兼容
                if(isiOS){
                    $('.In-text').focus(function(){
                        $('.po-f').addClass('po-a');
                    }).blur(function(){//输入框失焦后还原初始状态
                        $('.po-f').removeClass('po-a');
                    });
                }
            }
            appleFit();

            var tab_name='init';
            @if($tab)
                tab_name = '{!! $tab !!}';
            @endif

            function showTab() {
                $('.hd .itms').each(function () {
                    if($(this).data('tab') == tab_name){
                        $(this).siblings().removeClass('on');
                        $(this).addClass('on');
                        $('.bd-itms').hide();
                        $('.bd-itms').eq($(this).index()).show();
                    }
                })
            }
            showTab();

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
                $('.bd-itms').hide();
                $('.bd-itms').eq($(this).index()).show();
            });
            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });
            $('.btn-gb').tap(function () {
                $('#receipt-area').hide();
                $('.lsdd-main').show();
            });
            $('#refresh').tap(function () {
                window.location.href = '/wechat/lawyer/orders';
            });
            $('.receipt').tap(function () {
                var address = $('input[name=uri]').val();
                var user_id = $(this).data('user');
                var order_id = $(this).data('order');

                $.ajax({
                    type: 'POST',
                    url: address+'/ajax/receipt',
                    data: {
                        'user':user_id,
                        'order':order_id,
                        '_token':$('input[name=_token]').val()
                    },
                    success: function(result){
                        if(result.code == 'Y'){
                            $('#avatar').attr("src",result.data.avatar);
                            $('#receiver').text(result.data.receiver);
                            $('#phone').text(result.data.phone);
                            $('#title').text(result.data.title);
                            $('#address').text(result.data.address);
                            $('.lsdd-main').hide();
                            $('#receipt-area').show();
                            return true;
                        }

                        return false;
                    }
                });

            })
        })
    </script>
@stop