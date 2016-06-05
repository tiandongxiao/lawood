@extends('wechat.base.app')
@section('content')
<!--弹出框-->
<section class="lstc-main">
    <!--约见地点-->
    <div class="tc-m yjdd-main" style="display: block;width:100%;left: 0;height: 100%;background-color: white;">
        <div class="bg-fff c-main" style="max-height: 100%;height: 100%;border-radius: 0;">
            <div class="tie" style="width:100%;background-color: #00abeb;color: white;border-radius: 0">选择约见地点<i class="btn-fjls" id="In-next" style="background: none;width: 80px;font-style: normal">下一步</i>
                <div class="line-40 " style="color: #F39D2E;font-size: 14px;text-align: left;padding-left: 10px;">提示：下列地点仅为推荐，可协商变更</div>
            </div>
            <div class="con" style="margin-top: 30px;">
            </div>
        </div>
    </div>
    <!--约见地点-->
</section>
<!--弹出框-->
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        $(function(){
            var address = "{!! $address !!}";
            function getResults(address) {
                //初始化地图
                gdMapInit();
                geocoder(address,function (position) {
                    cur_position = position;
                    searchDataByMajor();
                },function () {
                    alert('转化失败');
                });
            }

            function searchDataByMajor() { //仍然使用当前位置
                searchPublicByAround(cur_position,"咖啡厅",function (result) {
                    // 搜索成功
                    var pois = result.poiList.pois;
                    for(var i = 0; i < pois.length; i++) {
                        var poi = pois[i];
                        $('.con').append(
                            "<div class='itms'>"+
                                "<div class='f-left'><img src='"+ '/images/dd-banner.jpg' +"' width='110' height='80'></div>"+
                                "<div class='right'><h3 class='chaochu_1'>"+ poi.name +"</h3>"+
                                    "<p class='chaochu_1'>法律咖啡：人均"+25+"元</p>"+
                                    "<p class='chaochu_1'>"+poi.address+"</p>"+
                                    "<p class='chaochu_1 mar-top-10'>"+"距离"+poi.distance+"米"+"</p>"+
                                "</div>"+
                                "<div class='itms-radio'><input type='radio' name='dd' class='In-radio'></div>"+
                            "</div>"
                        );
                    }
                },function (result) {
                    // 失败
                    alert('没找到');
                    console.log(result);
                });
            }
            getResults(address);

            //约见地点
            $('#In-next').tap(function(){
                window.location.href="/wechat/order/pay";
            });
        })
    </script>
@stop