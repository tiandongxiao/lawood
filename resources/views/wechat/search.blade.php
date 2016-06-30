@extends('wechat.base.menu')
@section('css')
<style>
    .dtdw-main {top: 0px;}
    .lstc-main .tc-m { bottom: 25px;}
    .lstc-main .tc-m .c-main { max-height: 550px;}
    .dtdw-main	.btn-pl {top: 115px;}
</style>
@stop
@section('content')
<!--地图定位-->
<section class="dtdw-main">
    <div class="map" id="map" style="height: 100%"></div>
    <div class="btn-pl"><img src="/images/icon-pl.png" width="44" height="44"></div>
    <div class="lvzy-main">
        <span  class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16 line-40" id="btn-more"></span>
    </div>
</section>
<!--地图定位-->

<!--弹出框-->
<section class="lstc-main"   style="display:none;">
    <!--附近律师-->
    <div class="tc-m fjls-main">
        <div class="bg-fff c-main" >
            <div class="tie tie-1">
                <p>您附近的专业律师</p><i class="btn-fjls btn-gb"></i>
                <div class="itms-nav"><span>价格筛选</span></div>
                <div class="itms-nav"><span>距离筛选</span></div>
            </div>
            <div class="con">
            </div>
        </div>
    </div>
    <!--附近律师-->
    <!--律师名片-->
    <div class="tc-m lsmp-main">
        <div class="bg-fff c-main" style="height: 350px;">
            <div class="tie">您附近的专业律师<i class="btn-fjls  btn-gb"></i></div>
            <div class="con">
                <div class="img">
                    <img src="/images/mp-banner.png" width="100%">
                    <a href="" class="link-more" id="detail_info">点击查看详情</a>
                    <div class="zxf">
                        <p class="top">咨询费</p>
                        <p class="bottom" style="top: -4px;"><span id="price">220</span><span class="fs-18">元</span></p>
                    </div>
                </div>
                <div class="name">
                    @if(!Auth::check())
                    <div class="f-right" ><span class="btn-ljzx">立即咨询</span></div>
                    @else
                        @if(Auth::user()->role != 'lawyer')
                            <div class="f-right" ><span class="btn-ljzx" style="top: 25px;">立即咨询</span></div>
                        @endif
                    @endif
                    <div class="left">
                        <h3 class="chaochu_1" ><span id="name">王树德</span>	<span>律师</span></h3>
                        <p class="chaochu_1" id="office">北京市朝阳区京师律师事务所</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--律师名片-->
</section>
<!--弹出框-->
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        major = "{!! $major !!}";
        address = "{!! $address !!}";
        tabName = "{!! $tab !!}";
        var cur_position;

        function highlightChose() {
            $('.list').each(function () {

                if($(this).text() == major){
                    // 分类显示逻辑
                    $('.itms-hd').removeClass('on');
                    $('.itms-hd').each(function () {
                        if($(this).text() == tabName){
                            $(this).addClass('on');
                            $('.itms-bd').removeClass('show');
                            $('.itms-bd').removeClass('on');
                            $('.itms-bd').eq($(this).index()).addClass('on');
                        }
                    });
                    $(this).addClass('on');

                    // 数据逻辑
                    getResults();
                }
            });
        }

        function getResults() {
            //初始化地图
            gdMapInit();
            geocoder(address,function (position) {
                cur_position = position;
                setCenter(cur_position);
                searchDataByMajor('_distance:ASC');
            },function () {
                alert('转化失败');
            });
        }

        function showPOI(data) {
            var position = data._location;

            AMap.event.addListener(new AMap.Marker({
                map: map,
                clickable:true,
                position: [position.getLng(), position.getLat()],
                content:"<img style='border-radius: 100%;border: solid 2px white; z-index: 9999' src='"+data.avatar+"' height='30' width='30'>",
                extData:{
                    'name':data._name,
                    'price': data.price,
                    'office':data.office,
                    'consult':data.consult,
                    'user': data.user,
                    'total':10
                }
            }), 'click', function () {
                var data = this.H.extData;
                console.log(data);

                $('#name').text(data.name);
                $('#price').text(data.price);
                $('#office').text(data.office);
                $('#detail_info').attr('href',"/wechat/user/"+data.user+"?consult="+data.consult);
                $('.btn-ljzx').data('consult',data.consult);

                $('.lstc-main').show();
                $('.fjls-main').hide();
                $('.lsmp-main').show();
            });
        }

        function searchDataByMajor(order_by) { //仍然使用当前位置
            searchPrivateByAround(cur_position,major,order_by,function (result) {
                // 搜索成功
                var dom = $('.fjls-main .con');
                console.log(result.datas);
                dom.empty();
                var data = result.datas;
                $('#btn-more').text("您附近有 "+data.length+" 位相关律师  (点击查看)");
                for(var i = 0; i < data.length; i++){
                    showPOI(data[i]);
                    dom.append(
                        "<div class='itms'>" +
                            "<div class='f-left'><img src='"+data[i].avatar+"' width='40px' height='40px'></div>"+
                            "<div class='right'>"+
                                "<h3 class='chaochu_1' style='padding-top: 0px;padding-left: 4px;'>"+ data[i]._name +" 律师</h3>"+
                                "<p class='chaochu_1' style='padding-top: 5px;'><span><img src='/images/icon-q.png' width='20' height='20' class='img'>"+ data[i].price+"元</span>　　<span><img src='/images/icon-w.png' width='20' height='20' class='img'>" + data[i]._distance + "米</span></p>"+
                            "</div>"+
                            "<div class='btn-ckmp' style='top:22px' data-user='"+data[i].user+"' data-consult='"+data[i].consult+"'>查看名片</div>"+
                        "</div>"
                    );
                }
                // 查看名片
                $('.btn-ckmp').tap(function(){
                    window.location.href="/wechat/user/"+$(this).data('user')+"?consult="+$(this).data('consult');
                });
            },function (result) {
                // 失败
                console.log(map.getAllOverlays('marker'));
                map.clearMap();
                setCenter(cur_position);
                $('.fjls-main .con').empty();
                $('#btn-more').text("抱歉，您附近没有相关领域律师");
                console.log(result);
            });
        }

        function setCenter(position) {
            map.setZoom(13);
            map.setCenter(position);
            // 添加点标记，并使用自己的icon
            new AMap.Marker({
                map: map,
                position: [position.getLng(), position.getLat()],
                icon: new AMap.Icon({
                    size: new AMap.Size(48, 48),  //图标大小
                    image: "/images/marker.svg"
                })
            });
        }

        $(function(){
            highlightChose();
            // 筛选
            $('.itms-nav').tap(function(){
                searchDataByMajor('price:DESC');
                if($(this).attr('class') == 'itms-nav'){
                    $('.itms-nav').removeClass('on');
                    $('.itms-nav').removeClass('on1');
                    $(this).addClass('on');
                }else{
                    $('.itms-nav').removeClass('on');
                    $('.itms-nav').removeClass('on1');
                    $(this).addClass('on');
                    $(this).addClass('on1');
                }
            });
            //返回中心点
            $('.btn-pl').tap(function(){
                setCenter(cur_position);
            });
            //查看更多律师
            $('#btn-more').click(function(){
                $('.lstc-main').show();
                $('.fjls-main').show();
            });
            //切换栏目，完成搜索
            $('.list').tap(function(){
                searchDataByMajor(major);
            });
            //律师咨询
            $('.btn-ljzx').tap(function(){
                window.location.href="/wechat/order/place/"+$(this).data('consult');
            });
            //关闭弹出框
            $('.lstc-main').click(function(){
                if(event.target==this){
                    $('.lstc-main').hide();
                    $('.tc-m').hide();
                }
            });
            $('.btn-gb').tap(function(){
                $('.lstc-main').hide();
                $('.tc-m').hide();
            })
        });
    </script>
@stop      