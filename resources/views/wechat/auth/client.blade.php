@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@endsection
@section('content')
    <section class="zc-main">
        <div class="gr-tx te-cen">
            <label class="label"><img src="/images/tx.png" width="70" height="70" class="tx" id="File_img"><input type="file" class="op-0" id="file_toget"></label>
        </div>
        <form  action="{{url('wechat/bind')}}" id="form" method="POST">
            {!! csrf_field() !!}
            <div class="form">
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
            <input type="button" class="In-btn In-btn-1 bg-hui fc-fff" value="立即注册" id="In-btn">
        </form>
        <div class="wjmm fc-d2d2d2 line-20 te-cen fs-12">点击［立即注册］代表您已阅读并同意<a href="#" class="fc-03aaf0">用户使用协议</a></div>
    </section>
@endsection
@section('script')
    <script>
        $(function(){
            var form	=	false	;

//表单判断
            $('.In-text').bind('input propertychange', function() {
                form	= true;

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

                    var re =  /^.{4}$/
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

        //H5图像
        $("#file_toget").change(function(){
            var objUrl = getObjectURL(this.files[0]) ;
            console.log("objUrl = "+objUrl) ;
            if (objUrl) {
                $('#File_img').attr({src:objUrl})

            }
        }) ;
        //建立一個可存取到該file的url
        function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
        }
    </script>
@endsection