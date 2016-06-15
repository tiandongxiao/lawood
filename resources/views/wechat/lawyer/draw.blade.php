@extends('wechat.base.app')
<style>
    body{background:#f8f8f8}
</style>
@section('content')
    <section class="lssz-main">
        <form  action="{{url('wechat/lawyer/draw')}}" id="form" method="post">
            {!! csrf_field() !!}
            <div class="form-list bg-fff-box">
                <div class="itms">
                    <div class="f-left">真实姓名</div>
                    <div class="right"><input type="text" placeholder="请输入真实姓名" class="In-text" id="name" name="name"></div>
                </div>
                <div class="itms">
                    <div class="f-left">银行卡号</div>
                    <div class="right"><input type="tel" placeholder="请输入银行卡号" class="In-text" id="yhk" name="card"></div>
                </div>
                <div class="itms">
                    <div class="f-left">手机号码</div>
                    <div class="right"><input type="tel" placeholder="请输入手机号码" class="In-text" id="mobile" name="phone"></div>
                </div>
                <div class="itms">
                    <div class="f-left">验 证 码</div>
                    <div class="right">
                        <input type="tel" placeholder="请输入短信验证码" class="In-text"  id="yzm" name="code">
                        <input type="button" value="获取验证码"  class="btn-yzm" id="btn-yzm"  fs="true">
                    </div>
                </div>
            </div>
            <div class="bottom-btn">
                <div class="blank160"></div>
                <div class="con te-cen">
                    <p class="fs-20 fc-c0c0c0 fw-normal">为保证提现无误</p>
                    <p class="fs-14 fc-c0c0c0">请保证注册名与卡号一致</p>
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确认提现" id="In-btn">
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
                //手机号
                if(!$('#mobile').val()){
                    alert('手机号码不能为空')
                    return	false;
                }else{
                    var re = /^1\d{10}$/
                    if (!re.test($('#mobile').val())) {
                        alert('请正确输入手机号码')
                        return	false;
                    }
                }
                //判断验证码
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
                //判断银行卡
                if(!$('#yhk').val()){
                    alert('银行卡卡号不能为空')
                    return	false;
                }
                $("#form").submit();
            })
        })
    </script>
@stop