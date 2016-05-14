@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <!--默认状态-->
    <section class="zc-main">
        <div class="banner"><img src="images/zc-banner.png" width="100%"></div>
        <form  action="{{url('wechat/reg_more')}}" id="form" method="POST">
            {!! csrf_field() !!}
            <div class="form">
                <a class="itms itms-link" href="#">
                    <div class="f-left">律所名称</div>
                    <div class="right fc-cccccc">如北京京师事务所</div>
                </a>
                <a class="itms itms-link" href="#">
                    <div class="f-left">律所地址</div>
                    <div class="right fc-cccccc">我的位置</div>
                </a>
                <a class="itms itms-link" href="#">
                    <div class="f-left">居住地址</div>
                    <div class="right fc-cccccc">我的位置</div>
                </a>
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
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30" value="提交注册" id="In-btn">
        </form>

    </section>
    <!--默认状态-->
@stop
@section('script')
    <script>
        $(function(){
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

                    }else{
                        alert('最多只能选择4项')

                    }
                }else{
                    $(this).toggleClass('on');
                    $('#num').html($('.list.on').size())
                }
            })
            //默认
        })
    </script>
@stop