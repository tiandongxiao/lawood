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
            regeocoder(data.position);

        }
        // 解析定位错误信息
        function onError(data) {
            alert('定位失败');
            console(data);

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
        AMap.service(["AMap.Geocoder"], function() { //加载地理编码
            var coder = new AMap.Geocoder({
                radius: 1000 //范围，默认：500
            });
            // 地理编码,返回地理编码结果
            coder.getLocation(location, function(status, result) {
                if (status === 'complete' && result.info === 'OK') {
                    var geocode = data.geocodes;
                    if(geocode.length == 1){
                        return geocode[0].location; // location.getLng()  location.getLat()
                    }
                }
                return null;
            });
        })

    }

    // 坐标-地址 逆地理编码
    function regeocoder(position) {  //new AMap.LngLat(112.752686,37.692514)
        AMap.service(["AMap.Geocoder"], function() { //加载地理编码
            coder = new AMap.Geocoder({
                radius: 1000,
                extensions: "all"
            });
            coder.getAddress(position, function(status, result){
                if (status === 'complete' && result.info === 'OK') {
                    return result.regeocode.formattedAddress;
                }
                return null;
            });
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