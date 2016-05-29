<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b6f97a31076e886a1236312d87e8b35e"></script>
<script>
    var map, location, keyword, cloudDataLayer;

    function gdMapInit() {
        map = new AMap.Map('container', {
            resizeEnable: true
        });
        addLayers();
    }

    function addLayers() {
        locationPlugin();
        cloudDataPlugin();
    }

    function locationPlugin() {
        map.plugin('AMap.Geolocation', function() {
            geolocation = new AMap.Geolocation({
                enableHighAccuracy: true,  //是否使用高精度定位，默认:true
                timeout: 10000,            //超过10秒后停止定位，默认：无穷大
                buttonOffset: new AMap.Pixel(10, 20), //定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
                zoomToAccuracy: true,      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
                buttonPosition:'RB'
            });
            map.addControl(geolocation);
            geolocation.getCurrentPosition();
            AMap.event.addListener(geolocation, 'complete', onComplete); //返回定位信息
            AMap.event.addListener(geolocation, 'error', onError);       //返回定位出错信息
        });
        // 解析定位结果
        function onComplete(data) {
            //alert('定位成功');
            regeocoder(data.position);
//            var str=['定位成功'];
//            str.push('经度：' + data.position.getLng());
//            str.push('纬度：' + data.position.getLat());
//            str.push('精度：' + data.accuracy + ' 米');
//            str.push('是否经过偏移：' + (data.isConverted ? '是' : '否'));
            //document.getElementById('tip').innerHTML = str.join('<br>');
        }
        // 解析定位错误信息
        function onError(data) {
            alert('定位失败');
            //document.getElementById('tip').innerHTML = '定位失败';
        }
    }

    function cloudDataPlugin() {
        // 加载云图层插件
        map.plugin('AMap.CloudDataLayer', function () {
            var layerOptions = {
                query:{keywords: ''},
                clickable:true
            };
            cloudDataLayer = new AMap.CloudDataLayer('56fa40c9305a2a3288363151', layerOptions); //实例化云图层类
            cloudDataLayer.setMap(map); //叠加云图层到地图

            AMap.event.addListener(cloudDataLayer, 'click', function (result) {
                var cloudData = result.data;
                var infoWindow = new AMap.InfoWindow({
                    content:"<h3><font face=\"微软雅黑\"color=\"#3366FF\">"+ cloudData._name +"</font></h3><hr />地址："+ cloudData._address + "<br />" + "业务：" +cloudData.category+  "</strong><br />",
                    size:new AMap.Size(300, 0),
                    autoMove:true,
                    offset:new AMap.Pixel(0,-5)
                });

                infoWindow.open(map, cloudData._location);
            });
        });
    }

    // 地址-坐标 正向编码
    function geocoder(location) {
        var coder = new AMap.Geocoder({
            city: "010", //城市，默认：“全国”
            radius: 1000 //范围，默认：500
        });
        //地理编码,返回地理编码结果
        coder.getLocation(location, function(status, result) {
            if (status === 'complete' && result.info === 'OK') {
                geocoder_CallBack(result);
            }
        });

        function addMarker(i, d) {
            var marker = new AMap.Marker({
                map: map,
                position: [ d.location.getLng(),  d.location.getLat()]
            });
            var infoWindow = new AMap.InfoWindow({
                content: d.formattedAddress,
                offset: {x: 0, y: -30}
            });
            marker.on("mouseover", function(e) {
                infoWindow.open(map, marker.getPosition());
            });
        }

        //地理编码返回结果展示
        function geocoder_CallBack(data) {
            var resultStr = "";
            //地理编码结果数组
            var geocode = data.geocodes;
            for (var i = 0; i < geocode.length; i++) {
                //拼接输出html
                resultStr += "<span style=\"font-size: 12px;padding:0px 0 4px 2px; border-bottom:1px solid #C1FFC1;\">" + "<b>地址</b>：" + geocode[i].formattedAddress + "" + "&nbsp;&nbsp;<b>的地理编码结果是:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;坐标</b>：" + geocode[i].location.getLng() + ", " + geocode[i].location.getLat() + "" + "<b>&nbsp;&nbsp;&nbsp;&nbsp;匹配级别</b>：" + geocode[i].level + "</span>";
                addMarker(i, geocode[i]);
            }
            map.setFitView();
            document.getElementById("result").innerHTML = resultStr;
        }
    }

    // 坐标-地址 逆地理编码 positon = [116.396574, 39.992706];
    function regeocoder(positon) {  //new AMap.LngLat(112.752686,37.692514)
        //通过AMap.service加载检索服务，加载的服务可以包括服务插件列表中一个或多个
        AMap.service(["AMap.Geocoder"], function() { //加载地理编码
            geocoder = new AMap.Geocoder({
                radius: 1000,
                extensions: "all"
            });
            //步骤三：通过服务对应的方法回调服务返回结果，本例中通过逆地理编码方法getAddress回调结果
            geocoder.getAddress(positon, function(status, result){
                if (status === 'complete' && result.info === 'OK') {
                    callBack(result);
                }
            });


//            var marker = new AMap.Marker({  //加点
//                map: map,
//                position: lnglatXY
//            });
//            map.setFitView();
//
            // 回调函数
            function callBack(data) {
                $('#In-wz').val(result.regeocode.formattedAddress);
                //alert(result.regeocode.formattedAddress);
            }
        });
    }

    // Begin  搜索高德地图 公共数据
    function searchPublicByAround(center,type) { //center = [116.405467, 39.907761];
        AMap.service(["AMap.PlaceSearch"], function() {
            var placeSearch = new AMap.PlaceSearch({ //构造地点查询类
                pageSize: 5,
                type: '餐饮服务',
                pageIndex: 1,
                city: "010", //城市
                map: map,
                panel: "panel"
            });

            var cpoint = [116.405467, 39.907761]; //中心点坐标
            placeSearch.searchNearBy('', center, 200, function(status, result) {

            });
        });
    }
    // Ended  搜索高德地图 公共数据

    // Begin 搜索自创建地图 私有数据
    function searchPrivateByAround(center,keyword) { //center = [116.405467, 39.907761];
        var search;
        var searchOptions = {
            map: map,
            panel: 'panel',
            keywords: keyword,
            pageSize: 5,
            orderBy: '_id:ASC'
        };
        //加载CloudDataSearch服务插件
        AMap.service(["AMap.CloudDataSearch"], function() {
            search = new AMap.CloudDataSearch('56fa40c9305a2a3288363151', searchOptions);
            search.searchNearBy(center, 10000);
        });
    }
    // Ended 搜索自创建地图 私有数据
</script>