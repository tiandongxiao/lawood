@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <!--默认状态-->
    <section class="zc-main">
        <div class="banner"><img src="/images/zc-banner.png" width="100%"></div>
        <form id="form" action="{{url('wechat/reg_more')}}" method="POST">
            {!! csrf_field() !!}
            <div class="form">
                <div class="itms" >
                    <div class="f-left">律所名称</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="如北京京师事务所">
                    </div>
                </div >
                <div class="itms">
                    <div class="f-left">律所地址</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="我的位置">
                    </div>
                </div>
                <div class="itms" >
                    <div class="f-left">居住地址</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="我的位置">
                    </div>
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
            <input type="submit" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30" value="提交注册" id="In-btn">
        </form>
    </section>
    <!--默认状态-->

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
            //输入判断
            $('.In-text').bind('input propertychange', function() {
                if($(this).val()){
                    $(this).parents('.itms').addClass('itms-ok')
                }else{
                    $(this).parents('.itms').removeClass('itms-ok')
                }
            })
        })
    </script>
@stop