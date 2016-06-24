@extends('wechat.base.menu')
@section('css')
    <style>
        .itms .banner{position: absolute;width: 97.2%;height: 25px;line-height: 26px;bottom: 1px;background: rgba(148,85,40,0.6);color: whitesmoke}
        .itms:nth-child(2n)	.banner {
            position: absolute;left:5px;width: 97.2%;height: 25px;line-height: 26px;bottom: 1px;background: rgba(148,85,40,0.6);color: whitesmoke
        }
        .banner-lawyer{padding-left: 6px;}
        .banner-major{float: right;padding-right: 6px}
    </style>
@stop
@section('content')
    <section class="lvzy-main" style="padding-top: 100px">
        <h3 class="tie" style="font-size: 20px;font-weight: lighter">律屋共有<span class="fc-03aaf0"> 456 </span>名律师</h3>
        <p class="sx mar-top-20">输入<span class="fc-03aaf0">律师姓名</span>或者<span class="fc-03aaf0">您的位置</span>即可快速查找</p>
        <form>
            <div class="itms-form" id="form-xz">
                <div class="bd">
                    <input type="text" placeholder="请输入律师姓名" id="In-xm" class="In-text" style="width: 185px">
                    <input type="text" placeholder="请输入我的位置" id="In-wz" class="In-text" style="width: 185px;display:none">
                </div>
                <div class="hd">
                    <i class="icon-xm on" id="icon-xm"></i>
                    <i class="icon-wz" id="icon-wz"></i>
                </div>
            </div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16" value="找律师" id="In-btn">
        </form>

        <div class="line-30 pad-0-10 fc-909090 mar-top-50" style="text-align: center"><span style="color: rgba(255,152,0,0.78);font-size: 16px">推荐律师</span></div>
        <div class="tjls pad-0-10  mar-top-15 clearfix">
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <div class="banner">
                    <span class="banner-lawyer">王树德律师</span><span class="banner-major">婚姻家庭</span>
                </div>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <div class="banner">
                    <span class="banner-lawyer">王树德律师</span><span class="banner-major">婚姻家庭</span>
                </div>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <div class="banner">
                    <span class="banner-lawyer">王树德律师</span><span class="banner-major">婚姻家庭</span>
                </div>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <div class="banner">
                    <span class="banner-lawyer">王树德律师</span><span class="banner-major">婚姻家庭</span>
                </div>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <div class="banner">
                    <span class="banner-lawyer">王树德律师</span><span class="banner-major">婚姻家庭</span>
                </div>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <div class="banner">
                    <span class="banner-lawyer">王树德律师</span><span class="banner-major">婚姻家庭</span>
                </div>
            </a>
        </div>
    </section>
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        $(function(){
            //切换查找条件
            $('#form-xz .hd i').tap(function(){
                $('#form-xz .hd i').removeClass('on')
                $(this).addClass('on');
                var icon = $('#form-xz .bd .In-text');
                icon.hide();
                icon.eq($(this).index()).show();
            });

            $('#In-btn').tap(function () {
                if($('#icon-wz').hasClass('on')){
                    if(!major){
                        alert('您没有选择任何咨询门类');
                        return;
                    }
                    if(!$('#In-wz').val()){
                        alert('地址不能为空');
                        return;
                    }
                    query = 'chose=position&'+'major='+major+'&tab='+tabName+'&address='+$('#In-wz').val();
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

            // 地图放在最后一部分，以免影响菜单操作
            var city;
            gdMapInit();            
            locatePosition(function (data) {
                regeocoder(data.position,function (result) {
                    console.log(result);
                    $('#In-wz').val(result.formattedAddress);
                });
            },function () {
                // 定位失败
                $('#In-wz').val('定位失败，请输入您的位置');
            });
            getCity(function (cityName) {
                city = cityName;
            },function (info) {
                city = '北京市';
            });
            $('.list').tap(function(){
                searchPrivateByDistrict(city,major,function (result) {
                    // 搜索成功
                    console.log(result);
                },function (result) {
//                    alert('说的是我吗');
                });
            });
        })
    </script>
@stop
