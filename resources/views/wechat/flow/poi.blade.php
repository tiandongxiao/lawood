@extends('wechat.base.app')
@section('content')
<!--地图定位-->
<section class="dtdw-main">
    <div class="map" id="map" style="height: 100%"></div>
    <div class="lvzy-main">
        <a class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16 line-40" > 返回 </a>
    </div>
</section>
<!--地图定位-->
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        function getResult(poi_id) {
            //初始化地图
            gdMapInit();
            searchPublicById(poi_id,function (result) {
                alert('success');
            },function (result) {
                alert('fail');
            })

        }

        function setCenter(position) {
            map.setZoom(14);
            map.setCenter(position);
            //添加点标记，并使用自己的icon
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
            poi_id = '{!! $id !!}}';
            getResult(poi_id);
            //返回中心点
            $('.btn-pl').tap(function(){
                setCenter(cur_position);
            });
        });

    </script>
@stop
