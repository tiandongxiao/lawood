@extends('wechat.base.menu')
@section('content')
    <section class="lvzy-main">
        <h3 class="tie">您附近有<font class="fc-03aaf0">103</font>名律师</h3>
        <p class="sx">输入有<font class="fc-03aaf0">律师姓名</font>或者有<font class="fc-03aaf0">您的位置</font>即可快速查找</p>
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
            <div class="itms">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </div>
            <div class="itms">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </div>
            <div class="itms">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </div>
            <div class="itms">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </div>
            <div class="itms">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </div>
            <div class="itms">
                <div class="img"><img src="/images/ls.jpg" width="100%"></div>
                <p>1.4km</p>
            </div>
        </div>
    </section>
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        $(function(){

            // 初始化地图
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
            //切换查找条件
            $('#form-xz .hd i').tap(function(){
                $('#form-xz .hd i').removeClass('on')
                $(this).addClass('on');
                $('#form-xz .bd .In-text').css({display:'none'})
                $('#form-xz .bd .In-text').eq($(this).index()).css({display:'block'})
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
        })
    </script>
@stop
