@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="zc-main">
        <form id="form" action="{{url('wechat/lawyer/config')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="key" value="phone">
            <input type="hidden" name="uri" value="{{url('/')}}">
            <div class="form">
                <div class="itms">
                    <div class="f-left">手机号码</div>
                    <div class="right"><input type="tel" placeholder="新的手机号" class="In-text" id="mobile" name="phone"></div>
                </div>
                <div class="itms">
                    <div class="f-left">验 证 码</div>
                    <div class="right"><input type="text" placeholder="短信验证码" class="In-text" id="yzm" name="code"></div>
                    <input type="button" value="获取验证码"  class="btn-yzm" id="btn-yzm"  fs="true" style="display: none">
                </div>
            </div>
            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 fc-fff mar-top-10" value="确定" id="In-btn" readonly>
                </div>
            </div>
        </form>
    </section>
@stop
@section('script')
    <script>
        $(function(){
            var form = false;
            var address = $('input[name=uri]').val();
            var btn_yzm = $('#btn-yzm');
            //表单判断
            $('.In-text').bind('input propertychange', function() {
                //手机号
                if(!$('#mobile').val()){
                    form = false;
                    $('#In-btn').removeClass('bg-lan1');
                    $('#mobile').parents('.itms').removeClass('itms-ok');
                    btn_yzm.parents('.itms').removeClass('itms-ok');
                    $('#yzm').val('');
                    btn_yzm.hide()
                }else{
                    var re = /^1\d{10}$/;
                    if (!re.test($('#mobile').val())) {
                        form = false;
                        $('#In-btn').removeClass('bg-lan1');
                        $('#mobile').parents('.itms').removeClass('itms-ok');
                        btn_yzm.parents('.itms').removeClass('itms-ok');
                        $('#yzm').val('');
                        btn_yzm.hide();
                        return false;
                    }

                    function checkPhone(){
                        $.ajax({
                            type: 'POST',
                            url: address+'/ajax/phone',
                            data: {
                                'phone':$('input[name=phone]').val(),
                                '_token':$('input[name=_token]').val(),
                            },
                            success: function(data){
                                if(data == 'Y'){
                                    $('#mobile').parents('.itms').addClass('itms-ok');
                                    if(!btn_yzm.parents('.itms').hasClass('itms-ok'))
                                        btn_yzm.show();
                                    return true;
                                }
                                form = false;
                                $('#In-btn').removeClass('bg-lan1')
                                if(!$('#mobile').parents('.itms').hasClass('itms-ok'))
                                    alert('此号码已被注册');
                                return false;
                            }
                        });
                    }
                    checkPhone();
                }

                //判断验证码
                if(!$('#yzm').val()){
                    form	= false;
                    $('#In-btn').removeClass('bg-lan1');
                    btn_yzm.parents('.itms').removeClass('itms-ok');
                    return false;
                }else{
                    var re =  /\d{4}$/;
                    if (!re.test($('#yzm').val())) {
                        form = false;
                        $('#In-btn').removeClass('bg-lan1');
                        btn_yzm.parents('.itms').removeClass('itms-ok');
                        return false;
                    }


                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/code',
                        data: {
                            'type':'reset',
                            'code':$('input[name=code]').val(),
                            'phone':$('input[name=phone]').val(),
                            '_token':$('input[name=_token]').val(),
                        },
                        success: function(data){
                            switch (data){
                                case 'Y':
                                    btn_yzm.hide();
                                    btn_yzm.parents('.itms').addClass('itms-ok');
                                    form = true;
                                    $('#In-btn').addClass('bg-lan1');
                                    return true;
                                case 'N':
                                case 'E':
                                    form = false;
                                    $('#In-btn').removeClass('bg-lan1');
                                    $('#mobile').parents('.itms').removeClass('itms-ok');
                                    alert('验证码错误');
                                    $('#yzm').val('');
                                    return false;
                            }
                        }
                    })
                }
            });

            // 表单提交
            $('#In-btn').tap(function(){
                if(form){
                    $("#form").submit();
                }
            });

            // 发送验证码
            var	Time	=	60;
            var timer;

            btn_yzm.tap(function(){
                if(!$('#mobile').parents('.itms').hasClass('itms-ok'))
                    return false;

                if(btn_yzm.attr('fs') == 'true'){
                    var address = $('input[name=uri]').val();
                    function sendMsg(){
                        $.ajax({
                            type: 'POST',
                            url: address+'/ajax/sms',
                            data: {
                                'phone':$('input[name=phone]').val(),
                                '_token':$('input[name=_token]').val(),
                                'do' : 'reset'
                            },
                            success: function(result){
                                if(result.code == 'X'){
                                    Time = 60;
                                    clearTimeout(timer);
                                    btn_yzm.attr({'fs':'true'});
                                    btn_yzm.val('再发一次');
                                    btn_yzm.removeClass('on');
                                    btn_yzm.show();
                                }
                                alert(data.info);
                            }
                        });
                    }
                    sendMsg();
                    show_Time();
                }
            })

            function show_Time(){ //加时函数
                if(Time == 0){
                    btn_yzm.attr({'fs':'true'})
                    btn_yzm.val('再发一次');
                    btn_yzm.removeClass('on');
                }else{
                    btn_yzm.addClass('on');
                    btn_yzm.val(Time+'s后重新发送');
                    Time--;
                    timer = setTimeout(show_Time,1000);
                    btn_yzm.attr({'fs':'false'})
                }
            };
        })
    </script>
@stop