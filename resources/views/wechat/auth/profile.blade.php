@extends('wechat.base.app')
@section('css')
    <style>
        body{background:#f8f8f8}
        .scly-main	.hd	.itms-hd{width: 24%}
    </style>
@stop
@section('content')
    @inject('category','App\Category')
    <!--默认状态-->
    <section class="zc-main">
        <div class="banner"><img src="/images/zc-banner.png" width="100%"></div>
        <form id="form" action="{{url('wechat/profile')}}" method="POST">
            {!! csrf_field() !!}
            <div class="form">
                <div class="itms" >
                    <div class="f-left">律所名称</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="如北京京师事务所" name="office" id="office">
                    </div>
                </div >
                <div class="itms" >
                    <div class="f-left">律师证号</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="" name="licence" id="licence">
                    </div>
                </div >
                <div class="itms">
                    <div class="f-left">律所地址</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="我的位置" name="work" id="work-address">
                        <input type="hidden"  name="work-poi" id="work-poi">
                    </div>
                </div>
                <div class="itms" >
                    <div class="f-left">居住地址</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="我的位置" name="home" id="home-address">
                    </div>
                </div>
            </div>
            <div class="scly-main pad-0-10">
                <div class="top">
                    <div class="f-left fc-909090 fs-16">擅长领域</div>
                    <div class="num fs-12 fc-cccccc"><span id="num">0</span>/4</div>
                </div>
                <div class="hd">
                    @foreach($category->nodes as $node)
                        @if($node['tab_name']=='ms')
                            <div class="itms-hd on">{{$node['name']}}</div>
                        @else
                            <div class="itms-hd">{{$node['name']}}</div>
                        @endif
                    @endforeach
                </div>

                <div class="bd">
                    @foreach($category->nodes as $node)
                        @if($node['tab_name']=='ms')
                            <div class="itms-bd clearfix show">
                                @foreach($node['nodes'] as $item)
                                    <span class="list" val="{{$item['id']}}">{{$item['name']}}</span>
                                @endforeach
                            </div>
                        @else
                            <div class="itms-bd clearfix">
                                @foreach($node['nodes'] as $item)
                                    <span class="list" val="{{$item['id']}}">{{$item['name']}}</span>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div id="select">
            </div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30" value="提交注册" id="btn-submit" readonly>
        </form>
    </section>
    <!--默认状态-->
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        $(function(){
            var address={
                'type'  : 'input',
                'full'  : null
            };
            function updateSelect() {
                $('#select input').remove();
                $('.list.on').each(function () {
                    $('#select').append("<input type='hidden' name='range[]' value='"+$(this).attr('val')+"'/>");
                });
            }
            // 切换擅长领域
            $('.itms-hd').tap(function(){
                $('.itms-hd').removeClass('on');
                $(this).addClass('on');
                $('.itms-bd').removeClass('show');
                $('.itms-bd').removeClass('on');
                $('.itms-bd').eq($(this).index()).addClass('on');
            });
            // 个数
            $('.list').tap(function(){
                if($('.list.on').size()	>	3){
                    if($(this).attr('class') ==	'list on'){
                        $(this).removeClass('on');
                        $('#num').html($('.list.on').size());
                        updateSelect();
                    }else{
                        alert('最多只能选择4项')
                    }
                }else{
                    $(this).toggleClass('on');
                    $('#num').html($('.list.on').size());
                    updateSelect();
                }
            });
            // 输入判断
            $('.In-text').bind('input propertychange', function() {
                if($(this).val()){
                    $(this).parents('.itms').addClass('itms-ok');
                }else{
                    $(this).parents('.itms').removeClass('itms-ok');
                }
            });
            // 表单提交
            $('#btn-submit').tap(function(){

                if(!$('#office').val()){
                    alert('律所信息不能为空');
                    return	false;
                }
                if(!$('#work-address').val()){
                    alert('工作区域不能为空');
                    return	false;
                }
                if(!$('#home-address').val()){
                    alert('居住区域不能为空');
                    return	false;
                }
                if(!$('#licence').val()){
                    alert('证件信息不能为空');
                    return	false;
                }

                if(address.type == 'auto'){
                    $('#work-address').val(address.full);
                }

                $("#form").submit();
            });

            AMap.plugin(['AMap.Autocomplete','AMap.PlaceSearch'],function(){
                var autoOptions = {
                    input: "work-address"
                };
                autocomplete= new AMap.Autocomplete(autoOptions);
                AMap.event.addListener(autocomplete, "select", function(e){
                    var poi = e.poi;
                    address.type = 'auto';
                    address.full = poi.district+poi.address+poi.name;
                    $('#work-poi').val(poi.id);
                    console.log(e);
                });
            });
        })
    </script>
@stop