@extends('wechat.base.app')
@section('content')
    <section class="zx-main">
        <div class="zx">
            <div class="btn-kszx"><span>开始</br>咨询</span></div>
            <div class="bl-1"></div>
            <div class="bl-2"></div>
            <div class="bl-3"></div>
        </div>
    </section>
    <!--本次咨询已完成-->
    <section class="tc-main" id="wczx" style="display:none">
        <div class="main te-cen"  style="top:40%;">
            <div class="pad-10-0"><img src="/images/wc.png" width="38" height="38"></div>
            <div class="line-30 fc-909090  fs-15">本次咨询已完成</div>
            <div class="fc-03aaf0 line-40 pad-10-0"><font class="fs-16" id="djs">3</font>S后回到订单首页</div>
        </div>
    </section>
    <!--本次咨询已完成-->
@stop
@section('script')
    <script>
        $(function(){
            $(document).on('click','.btn-kszx',function(){
                $('.zx').addClass('on');
                $(this).attr({class:'btn-kszx-on'})
                $(this).html('<span>咨询</br>完成</span>')
            })

            $(document).on('click','.btn-kszx-on',function(){
                $('#wczx').fadeIn('slow',function(){
                    show_Time()
                });
            })

            var	Time	=	3;
            function show_Time(){ //加时函数
                if(Time == 0){
                    window.location.href="01-登录.html";
                }else{

                    $('#djs').text(Time);
                    Time--;
                    setTimeout(show_Time,1000);
                }
            };
        })
    </script>
@stop