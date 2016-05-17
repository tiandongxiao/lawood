@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@endsection
@section('content')
    <section class="zc-main">
        <div class="banner"><img src="/images/zc-banner.png" width="100%"></div>
        <form  action="{{url('wechat/bind')}}" id="form" method="POST">
            {!! csrf_field() !!}
            <div class="form">
                <div class="itms">
                    <div class="f-left">真实姓名</div>
                    <div class="right"><input type="text" placeholder="如王二" class="In-text" id="name" name="name"></div>
                </div>
                <div class="itms">
                    <div class="f-left">手机号码</div>
                    <div class="right"><input type="tel" placeholder="有效手机号" class="In-text" id="mobile" name="phone"></div>
                </div>
                <div class="itms">
                    <div class="f-left">验 证 码</div>
                    <div class="right"><input type="text" placeholder="短信验证码" class="In-text" id="yzm"></div>
                    <input type="button" value="获取验证码"  class="btn-yzm" id="btn-yzm"  fs="true">
                </div>
            </div>
            <input type="button" class="In-btn In-btn-1 bg-hui fc-fff" value="下一步" id="In-btn">
        </form>
        <div class="wjmm fc-d2d2d2 line-20 te-cen fs-12">点击［下一步］代表您已阅读并同意<a href="#" class="fc-03aaf0">用户使用协议</a></div>
    </section>
@endsection
@section('script')
    <script>
        $(function(){
            var form	=	false;
            //表单判断
            $('.In-text').bind('input propertychange', function() {
                form = true;
                //姓名
                if(!$('#name').val()){

                    form	= false;
                    $('#In-btn').removeClass('bg-lan1')

                }else{

                    var re = /^.{2,20}$/
                    if (!re.test($('#name').val())) {

                        form	= false;
                        $('#In-btn').removeClass('bg-lan1')
                    }

                }

                //手机号
                if(!$('#mobile').val()){

                    form	= false;
                    $('#In-btn').removeClass('bg-lan1')

                }else{

                    var re = /^1\d{10}$/
                    if (!re.test($('#mobile').val())) {

                        form	= false;
                        $('#In-btn').removeClass('bg-lan1')
                    }

                }

                //判断验证码
                if(!$('#yzm').val()){
                    form	= false;
                    $('#In-btn').removeClass('bg-lan1')

                }else{
                    var re =  /\d{4}$/
                    if (!re.test($('#yzm').val())) {

                        form	= false;
                        $('#In-btn').removeClass('bg-lan1')
                    }

                }

                //更改按钮状态
                if(form){
                    $('#In-btn').addClass('bg-lan1')
                }
            });


            //表单提交
            $('#In-btn').tap(function(){
                if(form){
                    $("#form").submit();
                }

            })


            //发送验证码

            var	Time	=	60;

            $('#btn-yzm').tap(function(){

                if(!$('#mobile').val()){

                    alert('手机号码不能为空');
                    return false;


                }else{

                    var re = /^1\d{10}$/
                    if (!re.test($('#mobile').val())) {

                        alert('请正确填写手机号码')
                        return false;
                    }

                }

                if($('#btn-yzm').attr('fs') == 'true'){
                    show_Time()
                }

            })



            function show_Time(){ //加时函数

                if(Time == 0){

                    $('#btn-yzm').attr({'fs':'true'})
                    $('#btn-yzm').val('再发一次');
                    $('#btn-yzm').removeClass('on');
                }else{

                    $('#btn-yzm').addClass('on');
                    $('#btn-yzm').val(Time+'s后重新发送');
                    Time--;
                    setTimeout(show_Time,1000);
                    $('#btn-yzm').attr({'fs':'false'})
                }

            };
        })
    </script>
@endsection