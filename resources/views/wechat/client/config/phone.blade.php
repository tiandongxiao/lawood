@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <form id="form" action="#">
            <div class="form-list bg-fff-box">
                <div class="itms">
                    <input type="tel" placeholder="请输入您的新手机号码" class="In-text" id="mobile">
                </div>

                <div class="itms">
                    <input type="tel" placeholder="请输入短信验证码" class="In-text"  id="yzm" >
                    <input type="button" value="获取验证码"  class="btn-yzm" id="btn-yzm"  fs="true">
                </div>
            </div>
            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定" id="In-btn">
                </div>
            </div>
        </form>

    </section>
@stop
@section('script')
    <script>
        $(function(){
            //发送验证码
            var	Time	=	60;
            $('#btn-yzm').tap(function(){
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
            //表单提交
            $('#In-btn').tap(function(){
                //判断手机号码
                if(!$('#mobile').val()){
                    alert('新号码不能为空')
                    return	false;
                }else{
                    var re = /^1\d{10}$/
                    if (!re.test($('#mobile').val())) {
                        alert('请输入正确的新手机号码')
                        return	false;
                    }
                }
                if(!$('#yzm').val()){
                    alert('短信验证码不能为空')
                    return	false;
                }else{
                    var re =  /\d{4}$/
                    if (!re.test($('#yzm').val())) {

                        alert('请输入正确的短信验证码')
                        return	false;
                    }
                }
                $("#form").submit();
            })
        })
    </script>
@stop