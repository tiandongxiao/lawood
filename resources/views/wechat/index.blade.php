@extends('wechat.base.menu')
@section('css')
    <style>
        .itms .banner{position: absolute;width: 97.1%;height: 25px;line-height: 26px;bottom: 1px;background: rgba(148,85,40,0.6);color: whitesmoke}
        .itms:nth-child(2n)	.banner {
            position: absolute;right:0;width: 97.1%;height: 25px;line-height: 26px;bottom: 1px;background: rgba(148,85,40,0.6);color: whitesmoke
        }
        .banner-lawyer{padding-left: 6px;}
        .banner-major{float: right;padding-right: 6px}
        .amap-sug-result{border: none}
    </style>
@stop
@section('content')
    <section class="lvzy-main" style="padding-top: 90px">
        <h3 class="tie" style="font-size: 20px;font-weight: lighter">律屋共有<span class="fc-03aaf0"> 456 </span>名律师</h3>
        <form style="margin-top: 30px">
            <div class="itms-form" id="form-xz">
                <div class="bd">
                    <input type="text" placeholder="请输入律师姓名" id="In-xm" class="In-text" style="width: 185px;display: none;line-height: normal;padding-top: 2px">
                    <input type="text" placeholder="定位中..." id="In-wz" class="In-text" style="width: 185px;line-height: normal;padding-top: 2px">
                </div>
                <div class="hd">
                    <i class="icon-xm" id="icon-xm"></i>
                    <i class="icon-wz on" id="icon-wz"></i>
                </div>
            </div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30 fs-16" value="找律师" id="In-btn">
        </form>

        <div class="line-30 pad-0-10 fc-909090 mar-top-50" id="recommend-title" style="text-align: center;display: none">
            <span style="color: rgba(255,152,0,0.78);font-size: 16px">推 荐 律 师</span>
        </div>
        <div class="tjls pad-0-10  mar-top-20 clearfix" id="recommend-list">
        </div>
        <br/>
    </section>
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        $(function(){
            var city;
            var address={
                'type'  : 'input',
                'full'  : null
            };

            function loadGaode() {
                jQuery.getScript("http://webapi.amap.com/maps?v=1.3&key=b6f97a31076e886a1236312d87e8b35e").done(function() {
                    alert('成功');
                    // 地图放在最后一部分，以免影响菜单操作
                    //切换查找条件
                    $('#form-xz .hd i').tap(function(){
                        $('#form-xz .hd i').removeClass('on')
                        $(this).addClass('on');
                        var icon = $('#form-xz .bd .In-text');
                        icon.hide();
                        icon.eq($(this).index()).show();
                    });
                    $('#In-wz').focus(function() {
                        $('#In-wz').attr('placeholder','请输入您的位置');
                        $(this).val('');
                        console.log('获得焦点');
                        address.type = 'input';
                    });

                    $('#In-btn').tap(function () {
                        if($('#icon-wz').hasClass('on')){
                            var query;
                            if(!major){
                                alert('您没有选择任何咨询门类');
                                return;
                            }

                            if(!$('#In-wz').val() && $('#In-wz').attr('placeholder')!="定位中..."){
                                alert('没有指定要搜索的地址');
                                return;
                            }

                            switch (address.type){
                                case 'auto':
                                case 'locate':
                                    query = 'chose=position&'+'major='+major+'&tab='+tabName+'&address='+address.full;
                                    break;
                                case 'input':
                                    query = 'chose=position&'+'major='+major+'&tab='+tabName+'&address='+$('#In-wz').val();
                                    break;
                            }

                            window.location.href="/wechat/search?"+query;
                        }
                        if($('#icon-xm').hasClass('on')){
                            if(!$('#In-xm').val()){
                                alert('请输入要查找的律师姓名');
                                return;
                            }
                            query = 'chose=name&'+'name='+$('#In-xm').val();
                            window.location.href="/wechat/search?"+query;
                        }
                    });
                    
                    gdMapInit();
                    locatePosition(function (data) {
                        regeocoder(data.position,function (result) {
                            console.log(result);
                            address.type = 'locate';
                            component = result.addressComponent;
                            address.full = result.formattedAddress;
                            $('#In-wz').val(component.district+component.street+component.township);

                            var province = result.addressComponent.province;
                            switch (province){
                                case '北京市':
                                case '上海市':
                                case '天津市':
                                case '重庆市':
                                    city = province;
                                    break;
                                default :
                                    city = province.district;
                                    break;
                            }
                        });
                    },function () {
                        city = '北京市';
                        // 定位失败
                        $('#In-wz').attr('placeholder','定位失败，请输入您的位置');
                    });

                    AMap.plugin(['AMap.Autocomplete','AMap.PlaceSearch'],function(){
                        var autoOptions = {
                            input: "In-wz"
                        };
                        autocomplete= new AMap.Autocomplete(autoOptions);
                        AMap.event.addListener(autocomplete, "select", function(e){
                            var poi = e.poi;
                            address.type = 'auto';
                            address.full = poi.district+poi.address+poi.name;
                            console.log(e);
                        });
                    });

                    $('.list').tap(function(){
                        $('#recommend-title').hide();
                        $('#recommend-list').hide();
                        searchPrivateByDistrict(city,major,function (result) {
                            // 搜索成功
                            console.log(result);
                            var data = result.datas;
                            var recommendList = $('#recommend-list');
                            recommendList.empty();
                            for(var i = 0; i < data.length; i++){
                                recommendList.append(
                                        "<a class='itms' href='/wechat/user/"+data[i].user+"?consult="+data[i].consult+"&address="+$('#In-wz').val()+"'>"+
                                        "<div class='img'><img src='"+data[i].avatar+"' width='100%'></div>"+
                                        "<div class='banner'>"+
                                        "<span class='banner-lawyer'>"+data[i]._name+"律师</span><span class='banner-major'>"+data[i].price+"元</span>"+
                                        "</div>"+
                                        "</a>"
                                );
                            }
                            $('#recommend-title').show();
                            recommendList.fadeIn();

                        },function (result) {
                            $('#recommend-title').hide();
                            $('#recommend-list').hide();
                        });
                    });
                }).fail(function() {
                    alert('失败');
                    loadGaode();
                });
            }
        })
    </script>
@stop
