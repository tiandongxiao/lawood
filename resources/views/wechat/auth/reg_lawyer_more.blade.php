@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <!--默认状态-->
    <section class="zc-main">
        <div class="banner"><img src="/images/zc-banner.png" width="100%"></div>
        <form id="form" method="POST">
            {!! csrf_field() !!}
            <div class="form">
                <div>
                    <label>律所名称</label>
                    <input type="text" placeholder="" name="office">
                </div>
                <div>
                    <label>律师证号</label>
                    <input type="text" placeholder="" name="code">
                </div>
                <div>
                    <label>律所地址</label>
                    <input type="text" placeholder="" name="work_add">
                </div>
                <div>
                    <label>居住地址</label>
                    <input type="text" placeholder="" name="home_add">
                </div>
            </div>
            <div class="scly-main pad-0-10">
                <div class="top">
                    <div class="f-left fc-909090 fs-16">擅长领域</div>
                    <div class="num fs-12 fc-cccccc"><span id="num">0</span>/4</div>
                </div>
                <div class="hd">
                    <div class="itms-hd on">民事、经济</div>
                    <div class="itms-hd">刑事案件</div>
                    <div class="itms-hd">行政案件</div>
                </div>

                <div class="bd">
                    <div class="itms-bd clearfix show">
                        <span class="list">婚姻</span>
                        <span class="list">房产</span>
                        <span class="list">债务</span>
                        <span class="list">劳动争议</span>
                        <span class="list">合同纠纷</span>
                        <span class="list">损害赔偿</span>
                        <span class="list">医疗纠纷</span>
                        <span class="list">建设工程</span>
                        <span class="list">著作权</span>
                        <span class="list">商标权</span>
                        <span class="list">专利权</span>
                        <span class="list">土地</span>
                        <span class="list">股权</span>
                    </div>
                    <div class="itms-bd clearfix">
                        <span class="list">婚姻</span>
                        <span class="list">房产</span>
                        <span class="list">债务</span>
                        <span class="list">劳动争议</span>
                        <span class="list">合同纠纷</span>
                        <span class="list">损害赔偿</span>
                        <span class="list">医疗纠纷</span>
                        <span class="list">建设工程</span>
                        <span class="list">著作权</span>
                        <span class="list">商标权</span>
                        <span class="list">专利权</span>
                        <span class="list">土地</span>
                        <span class="list">股权</span>
                        <span class="list">商标权</span>
                        <span class="list">专利权</span>
                        <span class="list">土地</span>
                        <span class="list">股权</span>
                    </div>
                    <div class="itms-bd clearfix">
                        <span class="list">婚姻</span>
                        <span class="list">房产</span>
                        <span class="list">债务</span>
                        <span class="list">劳动争议</span>
                        <span class="list">合同纠纷</span>
                        <span class="list">损害赔偿</span>
                        <span class="list">医疗纠纷</span>
                        <span class="list">建设工程</span>
                        <span class="list">著作权</span>
                        <span class="list">商标权</span>
                        <span class="list">专利权</span>
                        <span class="list">土地</span>
                        <span class="list">股权</span>
                    </div>
                </div>
            </div>
            <div id="select">
            </div>
            <input type="submit" value="submit" style="display: none">
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30" value="提交注册" id="In-btn">
        </form>
    </section>
    <!--默认状态-->
    <!--提交审核-->
    <section class="tc-main	tjsh-main" style="display: none;">
        <div class="main te-cen">
            <div class="pad-10-0"><img src="/images/wc.png" width="38" height="38"></div>
            <div class="line-20 fc-909090 pad-10-0 fs-15">您的注册已经提交律屋</div>
            <div class="fc-03aaf0">我们将尽快审核</div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30" value="确认" id="btn-qr">
        </div>
    </section>
    <!--提交审核-->
@stop
@section('script')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script>
        $(function(){
            function updateSelect() {
                $('#select input').remove();
                $('.list.on').each(function () {
                    $('#select').append("<input type='hidden' name='range[]' value='"+$(this).text()+"'/>");
                });
            }
            //默认
            //切换擅长领域
            $('.itms-hd').tap(function(){
                $('.itms-hd').removeClass('on');
                $(this).addClass('on');
                $('.itms-bd').removeClass('show');
                $('.itms-bd').removeClass('on');
                $('.itms-bd').eq($(this).index()).addClass('on');

            })
            //个数
            $('.list').tap(function(){
                if($('.list.on').size()	>	3){
                    if($(this).attr('class')	==	'list on'){
                        $(this).removeClass('on');
                        $('#num').html($('.list.on').size())
                        updateSelect();
                    }else{
                        alert('最多只能选择4项')
                    }
                }else{
                    $(this).toggleClass('on');
                    $('#num').html($('.list.on').size())
                    updateSelect();
                }
            })

            //提交审核
            $('#btn-qr').tap(function(){
                $('.tc-main').fadeOut();
                window.location.href='/wechat/settings';
            })

            $('#In-btn').tap(function(){
                var options = {
                    url: '/wechat/reg_more',
                    type: 'post',
                    dataType: 'text',
                    data: $("#form").serialize(),
                    success: function (data) {
                        if (data.length > 0)
                                alert(1);
                    }
                };
                $.ajax(options);
            })
        })
    </script>
@stop