@extends('wechat.base.app')
@section('css')
    <style>
        body{background:#f8f8f8}
        .tie{
            width:100%; height:50px; line-height:50px; text-align:center; color:#686868;  z-index:100; background:#fff;
            padding:5px 0; border-top-left-radius:10px; border-top-right-radius:10px; font-size:16px;margin-top: -10px;
        }
        .tie .btn-gb{
            width:45px; height:45px; position:absolute; right:5px; top:5px; background:url({{url('images/gb.png')}}) center center no-repeat;background-size:22px 22px;
        }
    </style>
@stop
@section('content')
    <section class="lsdd-main">
        <div class="hd po-f">
            <div class="itms" data-tab="applies"><span>未完成</span></div>
            <div class="itms" data-tab="in_process"><span>进行中</span></div>
            <div class="itms" data-tab="completed"><span>已完成</span></div>
            <div id="refresh" style="position: absolute;right: 5px;"><img src="/images/refresh-simple.png" width="30px" height="30px"></div>
        </div>
        <div class="bd" style="padding-top:40px;">
            <!--未完成-->
            <div class="bd-itms">
                @if($applies)
                    @foreach($applies as $order)
                        @if($order->statusCode == 'pending')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>{{$order->category}}</span></p>
                                        @if($order->place)
                                            <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                        @else
                                            <p class="dd chaochu_2 mar-top-15">预约地点：未设定咨询地址</p>
                                        @endif
                                        <div class="zxf">
                                            <p>需付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="{{url('wxpay/js/'.$order->id)}}">继续下单</a></span>
                                        <span class="btn"><a href="{{url('wechat/order/cancel/'.$order->id)}}">取消订单</a></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'payed')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">正在等待律师接单…</div>
                                    <div class="btn-main">
                                        <span class="btn"><a href="{{url('wechat/order/cancel/'.$order->id)}}">取消订单</a></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'rejected')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                        <div class="zxf">
                                            <p>已退咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">律师拒绝接单，费用已退回</div>
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="{{url('wechat/order/abandon/'.$order->id)}}">删除订单</a></span>
                                        <span class="btn lan"><a href="{{url('wechat')}}">重新查找</a></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'canceled')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        @if($order->place)
                                            <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                        @else
                                            <p class="dd chaochu_2 mar-top-15">预约地点：未设定咨询地点</p>
                                        @endif
                                        @if($order->payed)
                                        <div class="zxf">
                                            <p>已退咨询费</p>
                                            <p class="jg">{{$order->total}} <span style="font-weight: normal">元</span></p>
                                        </div>
                                        @else
                                        <div class="zxf">
                                            <p>未支付费用</p>
                                            <p class="jg">0 <span style="font-weight: normal">元</span></p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="bottom">
                                    @if($order->payed)
                                        <div class="djs fc-03aaf0 fs-12">订单已取消，费用已退回</div>
                                    @else
                                        <div class="djs fc-03aaf0 fs-12">订单已取消，未支付订单</div>
                                    @endif
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="{{url('wechat/order/abandon/'.$order->id)}}">删除订单</a></span>
                                        <span class="btn lan"><a href="{{url('wechat')}}">重新查找</a></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'expired')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                        <div class="zxf">
                                            <p>已退咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="djs fc-03aaf0 fs-12">订单过期未接单，费用已退回</div>
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="{{url('wechat/order/abandon/'.$order->id)}}">删除订单</a></span>
                                        <span class="btn lan"><a href="{{url('wechat')}}">重新查找</a></span>
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
            <div class="bd-itms" >
                @if($ongoings)
                    @foreach($ongoings as $order)
                        @if($order->statusCode == 'in_process')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">下单时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：<a href="{{url('wechat/order/poi/'.$order->place->poi_id)}}" style="color: #BE5C00;">{{$order->place->name}}</a></p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    @if($order->seller_signed)
                                    <div class="djs fc-03aaf0 fs-12">律师已签到，等待您的签到</div>
                                    @endif
                                    @if($order->client_signed)
                                    <div class="djs fc-03aaf0 fs-12">您已签到，等待律师签到</div>
                                    @endif
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="tel:{{$order->seller->phone}}">打电话</a></span>
                                        @if(!$order->client_signed)
                                        <span class="btn lan"><a href="{{url('wechat/order/sign/'.$order->id)}}">咨询签到</a></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($order->statusCode == 'accepted')
                            <div class="itms bg-fff-box">
                                <div class="top">
                                    <div class="f-left">更新时间 {{$order->updated_at->diffForHumans()}}</div>
                                    <div class="f-right">单号：{{$order->order_no}}</div>
                                </div>
                                <div class="con">
                                    <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                    <div class="xx">
                                        <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                        <p class="dd chaochu_2 mar-top-15">预约地点：<a href="{{url('wechat/order/poi/'.$order->place->poi_id)}}" style="color: #BE5C00;">{{$order->place->name}}</a></p>
                                        <div class="zxf">
                                            <p>已付咨询费</p>
                                            <p class="jg">{{$order->total}}元</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="btn-main">
                                        <span class="btn lan"><a href="tel:{{$order->seller->phone}}">打电话</a></span>
                                        <span class="btn lan"><a href="{{url('wechat/order/sign/'.$order->id)}}">咨询签到</a></span>
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
                                <div class="f-left">完成时间 {{$order->updated_at->diffForHumans()}}</div>
                                <div class="f-right">单号：{{$order->order_no}}</div>
                            </div>
                            <div class="con">
                                <div class="img"><img src="{{$order->seller->avatar}}" width="70" height="70"></div>
                                <div class="xx">
                                    <p class="name chaochu_1 mar-top-5">律师 {{$order->seller->real_name}}<span>婚姻</span></p>
                                    <p class="dd chaochu_2 mar-top-15">预约地点：{{$order->place->name}}</p>
                                    <div class="zxf">
                                        <p>已付咨询费</p>
                                        <p class="jg">{{$order->total}}元</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="btn-main">
                                    @if(!$order->rating_id)
                                    <span class="btn lan btn-ljpj" data-order="{{$order->id}}" data-client="{{$order->client->id}}" data-lawyer="{{$order->seller->real_name}}" data-office="{{$order->seller->office}}">
                                        立即评价
                                    </span>
                                    @else
                                    <span class="btn lan btn-xgpj" data-order="{{$order->id}}" data-client="{{$order->client->id}}">
                                        修改评价
                                    </span>
                                    @endif
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

    <!--首次评价-->
    <section class="tc-main pj-main po-f"  style="display:none" id="ljpj">
        <div class="main te-cen"  style="top:6%;">
            <div class="tie">王树德 律师<i class="btn-gb" id="gb-comment"></i></div>

            <div class="pjcs pad-0-10">
                <div class="title" style="margin-top: -20px"><span>星级评价</span></div>
                <div class="pj">
                    <em class="on" data-sx="很差劲"></em>
                    <em class="on" data-sx="差劲"></em>
                    <em class="on" data-sx="一般"></em>
                    <em class="on" data-sx="比较满意，但仍可改善"></em>
                    <em class="on" data-sx="非常满意"></em>
                </div>
                <div class="xxts fs-12 line-20 fc-03aaf0">非常满意</div>
            </div>
            <form id="evaluate" action="{{url('wechat/order/evaluate')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="client" id="e-client" value=""/>
                <input type="hidden" name="order" id="e-order" value=""/>
                <input type="hidden" name="user-score" id="e-score" value="5"/>
                <input type="hidden" name="time-score" id="e-time" value="3"/>
                <input type="hidden" name="dress-score" id="e-dress" value="3"/>
                <input type="hidden" name="polite-score" id="e-polite" value="3"/>
                <input type="hidden" name="major-score" id="e-major" value="3"/>
                <div class="pjyj  pad-0-10 mar-top-10">
                    <textarea placeholder="意见和建议" class="In-text" name="comment"></textarea>
                </div>
            </form>
            <div class="lsyx pad-0-10" style="margin-bottom: 20px">
                <div class="title"><span>律师印象</span></div>
                <div class="itms">
                    <div class="f-left">准时：</div>
                    <div class="right" id="time">
                        <span data-score="1">迟到</span>
                        <span data-score="3" class="on">准时</span>
                        <span data-score="5">提前</span>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">穿着：</div>
                    <div class="right" id="dress">
                        <span data-score="1">随意</span>
                        <span data-score="3" class="on">得体</span>
                        <span data-score="5">职业</span>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">专业：</div>
                    <div class="right" id="major">
                        <span data-score="1">业余</span>
                        <span data-score="3" class="on">专业</span>
                        <span data-score="5">资深</span>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">态度：</div>
                    <div class="right" id="polite">
                        <span data-score="1">随意</span>
                        <span data-score="3" class="on">温和</span>
                        <span data-score="5">礼貌</span>
                    </div>
                </div>
            </div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10"  value="提交" id="rate-first">
        </div>
    </section>
    <!--首次评价-->
    <!--修改评价-->
    <section class="tc-main pj-main po-f"  style="display:none" id="xgpj">
        <div class="main te-cen"  style="top:20%;">
            <div class="tie">王树德 律师<i class="btn-gb" id="gb-update"></i></div>
            <div class="pjcs pad-0-10">
                <div class="title" style="margin-top: -20px"><span>星级评价</span></div>
                <div class="pj">
                    <em data-sx="很差劲" class="on"></em>
                    <em data-sx="差劲" class="on"></em>
                    <em data-sx="一般" class="on"></em>
                    <em data-sx="比较满意，但仍可改善"></em>
                    <em data-sx="非常满意"></em>
                </div>
                <div class="xxts fs-12 line-20 fc-03aaf0">比较满意，但仍可改善</div>
            </div>
            <form id="modify" action="{{url('wechat/order/evaluate/update')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="uri" value="{{url('/')}}">
                <input type="hidden" name="client" id="m-client" value="" />
                <input type="hidden" name="order" id="m-order" value=""/>
                <input type="hidden" name="user-score" id="m-score" value="5"/>
                <div class="pjyj  pad-0-10 mar-top-10">
                    <textarea class="In-text" name="comment" id="m-comment" style="height: 55px;margin-bottom: 20px"></textarea>
                </div>
            </form>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10"  value="提交" id="rate-modify">
        </div>
    </section>
    <!--修改评价-->
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

            $('.In-text').tap(function(){
                $(this).val('');
                $(this).focus();
            });

            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });

            // timing rating
            $('#time span').tap(function () {
                $('.In-text').blur();
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('#e-time').val($(this).data('score'));
            });
            // dressing rating
            $('#dress span').tap(function () {
                $('.In-text').blur();
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('#e-dress').val($(this).data('score'));
            });
            // polite rating
            $('#polite span').tap(function () {
                $('.In-text').blur();
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('#e-polite').val($(this).data('score'));
            });
            // major rating
            $('#major span').tap(function () {
                $('.In-text').blur();
                $(this).siblings().removeClass('on');
                $(this).addClass('on');
                $('#e-major').val($(this).data('score'));
            });
            // 初次评价
            $('#ljpj .pj em').tap(function(){
                $('.In-text').blur();
                $(this).siblings().removeClass('on');
                var EmIndex	= $(this).index();
                $('.xxts').text($(this).attr('data-sx'));
                for (var i=0;i<=EmIndex;i++){
                    $(this).parent('.pj').children('em').eq(i).addClass('on');
                }
                $('#e-score').val(EmIndex+1);
            });
            // 修改评价
            $('#xgpj .pj em').tap(function(){
                $('.In-text').blur();
                $(this).siblings().removeClass('on');
                var EmIndex	= $(this).index();
                $('.xxts').text($(this).attr('data-sx'));
                for (var i=0;i<=EmIndex;i++){
                    $(this).parent('.pj').children('em').eq(i).addClass('on');
                }
                $('#m-score').val(EmIndex+1);
            });
            // 弹出评价
            $('.btn-ljpj').tap(function(){
                $('#e-score').val(5);
                $('#e-order').val($(this).data('order'));
                $('#e-client').val($(this).data('client'));
                $('#ljpj').show();
            });
            $('.btn-xgpj').tap(function(){
                $('#m-order').val($(this).data('order'));
                $('#m-client').val($(this).data('client'));
                var address = $('input[name=uri]').val();
                var order_id = $(this).data('order');
                $.ajax({
                    type: 'POST',
                    url: address+'/ajax/evaluate',
                    data: {
                        '_token':$('input[name=_token]').val(),
                        'order':order_id
                    },
                    success: function(result){
                        if(result.code == 'Y'){
                            var rating = result.data.rating;
                            var em = $('#xgpj .pj em');
                            $('#m-score').val(rating);
                            em.removeClass('on');
                            $('#xgpj .xxts').text(em.eq(rating-1).attr('data-sx'));
                            for (var i=0;i<=rating-1;i++){
                                em.eq(i).addClass('on');
                            }
                            $('#m-comment').val(result.data.comment);
                            $('#xgpj').show();
                            return true;
                        }
                        return false;
                    }
                });
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
                $('.bd-itms').hide();
                $('.bd-itms').eq($(this).index()).show();
            });
            $('#rate-first').tap(function () {
                $('.In-text').blur();
                $("#evaluate").submit();
            });
            $('#rate-modify').tap(function () {
                $('.In-text').blur();
                $("#modify").submit();
            });
            $('#gb-comment').tap(function() {
                $('#ljpj').hide();
            });
            $('#gb-update').tap(function() {
                $('#xgpj').hide();
            });
            $('#refresh').tap(function () {
                window.location.href = '/wechat/client/orders';
            });
        })
    </script>
@stop