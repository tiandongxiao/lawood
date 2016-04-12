/**
 * Created by 王国营 on 2016/3/30.
 */
var mapObj;
var keywords;
var cloudDataLayer;
/*
 *初始化地图对象，加载地图
 */
function mapInit(){
    mapObj = new AMap.Map("iCenter",{center:new AMap.LngLat(116.39946,39.907629),level:12});
    addCloudLayer();

}
/*
 *叠加云数据图层
 */
function addCloudLayer() {
    //加载云图层插件
    mapObj.plugin('AMap.CloudDataLayer', function () {
        var layerOptions = {
            query:{keywords: ''},
            clickable:true
        };
        cloudDataLayer = new AMap.CloudDataLayer('56fa40c9305a2a3288363151', layerOptions); //实例化云图层类
        cloudDataLayer.setMap(mapObj); //叠加云图层到地图

        AMap.event.addListener(cloudDataLayer, 'click', function (result) {
            var clouddata = result.data;
            var infoWindow = new AMap.InfoWindow({
                content:"<h3><font face=\"微软雅黑\"color=\"#3366FF\">"+ clouddata._name +"</font></h3><hr />地址："+ clouddata._address + "<br />" + "电话号码：" + clouddata.phonenumber+ "<br />" + "邮编：" + clouddata.postalcode+"<br /><strong>" + "擅长专科：" +clouddata.medicalspecialists+  "</strong><br />" + "所在省份：" +clouddata.provinces ,
                size:new AMap.Size(300, 0),
                autoMove:true,
                offset:new AMap.Pixel(0,-5)
            });

            infoWindow.open(mapObj, clouddata._location);
        });
    });
}

function getType(medicalspecialists){
    var op={
        /*map:mapObj,*/
        query:{keywords:medicalspecialists}
    }
    cloudDataLayer.setOptions(op)
}
