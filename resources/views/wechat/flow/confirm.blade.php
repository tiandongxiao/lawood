@extends('wechat.base.app')
@section('content')
    <section class="sjxz-main">
        <div class="top">
            <div class="tx"><img src="/images/ls.jpg" width="60" height="60" class="br-50"></div>
            <div class="fy"><span class="fs-18">{{$order->total}}</span>元</div>
            <p class="fc-fff line-40 fs-18">您正在预约</p>
            <p class="fc-a4dfff line-20">{{$order->seller->office}} <font class="fc-fff">{{$order->seller->real_name}}</font> 进行法</p>
            <p class="fc-a4dfff line-20 dd">预约地点暂定{{$order->place->name}}</p>
            <p class="mar-top-20 fc-fff fs-12">律师将在12小时内以电话形式回复预约</p>
            <p class="fc-fff fs-12">并确定最终的预约信息</p>
        </div>

        <form id="form" action="{{url('wechat/order/confirm')}}">
            <input type="hidden" name="order" value="{{$order}}">
            {!! csrf_field() !!}
            <div class="form bg-fff-box">
                <div class="itms">
                    <div class="f-left">联 系 人</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="请输入联系人姓名" id="name" name="name">
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">我要开发票</div>
                    <div class="right">
                        <div class="ts fc-c0c0c0" style="display:none">邮费用费到付</div>
                        <input type="checkbox" class="In-check" name="switch">
                    </div>
                </div>
                <div class="con con-1" style="display:none;">
                    <div class="itms">
                        <div class="f-left">发票抬头</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入发票抬头"  id="fptt" name="title">
                        </div>
                    </div>
                    <div class="itms">
                        <div class="f-left">邮寄地址</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入邮寄地址" id="yjdz" name="address">
                        </div>
                    </div>
                    <div class="itms">
                        <div class="f-left">收件人</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入收件人" id="sjr-name" name="receiver">
                        </div>
                    </div>
                    <div class="itms">
                        <div class="f-left">电话号码</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入电话号码" id="mobile" name="phone">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确认支付" id="In-btn">
                </div>
            </div>
        </form>
    </section>
@stop
@section('script')
    <script>
        $(function(){
            //公布到广场
            $('.In-check').on('change',function(){
                if($(this).prop("checked")){
                    $('.con-1').slideDown();
                    $('.ts').fadeIn();
                }else{
                    $('.con-1').slideUp();
                    $('.ts').fadeOut();
                }
            });

            //表单提交
            $('#In-btn').tap(function(){
                //姓名
                if(!$('#name').val()){
                    alert('姓名不能为空')
                    return	false;
                }else{
                    var re = /^.{2,20}$/
                    if (!re.test($('#name').val())) {
                        alert('请输入正确的姓名(2-20字符)')
                        return	false;
                    }
                }
                if($('.In-check').prop("checked")){
                    //发票抬头不能为空
                    if(!$('#fptt').val()){
                        alert('发票抬头不能为空');
                        return	false;
                    }
                    //邮寄地址
                    if(!$('#yjdz').val()){
                        alert('邮寄地址不能为空');
                        return	false;
                    }
                    //收件人sjr-name

                    if(!$('#sjr-name').val()){
                        alert('收件人姓名不能为空');
                        return	false;
                    }else{
                        var re = /^.{2,20}$/
                        if (!re.test($('#sjr-name').val())) {
                            alert('请输入正确的收件人姓名(2-20字符)');
                            return	false;
                        }
                    }

                    //手机号
                    if(!$('#mobile').val()){
                        alert('手机号码不能为空');
                        return	false;
                    }else{
                        var re = /^1\d{10}$/
                        if (!re.test($('#mobile').val())) {
                            alert('请正确输入手机号码')
                            return	false;
                        }
                    }
                }
                $("#form").submit();
            })

        })
    </script>
@stop