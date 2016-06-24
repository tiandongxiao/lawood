@extends('wechat.base.menu')
@section('content')
    <section class="lvzy-main" style="padding-top: 100px">
        <h3 class="tie" style="font-size: 20px;font-weight: lighter">律屋共有<span class="fc-03aaf0"> 456 </span>名律师</h3>
        <p class="sx mar-top-20">输入<span class="fc-03aaf0">律师姓名</span>或者<span class="fc-03aaf0">您的位置</span>即可快速查找</p>
        <form>
            <div class="itms-form" id="form-xz">
                <div class="bd">
                    <input type="text" placeholder="请输入律师姓名" id="In-xm" class="In-text">
                    <input type="text" placeholder="请输入我的位置" id="In-wz" class="In-text" style="display:none">
                </div>
                <div class="hd">
                    <i class="icon-xm on" id="icon-xm"></i>
                    <i class="icon-wz" id="icon-wz"></i>
                </div>
            </div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16" value="找律师" id="In-btn">
        </form>

        <div class="line-30 pad-0-10 fc-909090 mar-top-30">推荐律师</div>
        <div class="tjls pad-0-10 clearfix">
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </a>
            <a class="itms" href="{{url('wechat/user/6')}}">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
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
                //alert(cityName);
            },function (info) {
                alert(info);
            });
        })
    </script>
@stop
