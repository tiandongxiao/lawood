@extends('wechat.base.app')
@section('content')
<!--弹出框-->
<section class="lstc-main">
    <!--约见地点-->
    <div class="tc-m yjdd-main" style="display: block;">
        <div class="bg-fff c-main">
            <div class="tie">选择约见地点<i class="btn-fjls btn-gb"></i><i class="btn-back back-lszx"></i></div>
            <div class="con" >
                <div class="line-40 fc-505050">提示：下列地点仅为推荐，可协商变更</div>
                <div class="itms">
                    <div class="f-left"><img src="/images/dd-banner.jpg" width="120" height="80"></div>
                    <div class="right">
                        <h3 class="chaochu_1">COST咖啡店</h3>
                        <p class="chaochu_1">法律咖啡：人均25元</p>
                        <p class="chaochu_1">地址：北京市海淀区中关村33号</p>
                        <p class="chaochu_1 mar-top-10">距离200米</p>
                    </div>
                    <div class="itms-radio"><input type="radio" name="dd" class="In-radio" checked></div>
                </div>
                <div class="itms">
                    <div class="f-left"><img src="/images/dd-banner.jpg" width="120" height="80"></div>
                    <div class="right">
                        <h3 class="chaochu_1">COST咖啡店</h3>
                        <p class="chaochu_1">法律咖啡：人均25元</p>
                        <p class="chaochu_1">地址：北京市海淀区中关村33号</p>
                        <p class="chaochu_1 mar-top-10">距离200米</p>
                    </div>
                    <div class="itms-radio"><input type="radio" name="dd" class="In-radio"></div>
                </div>
                <div class="itms">
                    <div class="f-left"><img src="/images/dd-banner.jpg" width="120" height="80"></div>
                    <div class="right">
                        <h3 class="chaochu_1">COST咖啡店</h3>
                        <p class="chaochu_1">法律咖啡：人均25元</p>
                        <p class="chaochu_1">地址：北京市海淀区中关村33号</p>
                        <p class="chaochu_1 mar-top-10">距离200米</p>
                    </div>
                    <div class="itms-radio"><input type="radio" name="dd" class="In-radio"></div>
                </div>
                <div class="itms">
                    <div class="f-left"><img src="/images/dd-banner.jpg" width="120" height="80"></div>
                    <div class="right">
                        <h3 class="chaochu_1">COST咖啡店</h3>
                        <p class="chaochu_1">法律咖啡：人均25元</p>
                        <p class="chaochu_1">地址：北京市海淀区中关村33号</p>
                        <p class="chaochu_1 mar-top-10">距离200米</p>
                    </div>
                    <div class="itms-radio"><input type="radio" name="dd" class="In-radio"></div>
                </div>
            </div>
            <div class=" btn-ddxz">
                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff line-40 fs-16 mar-top-10" value="立即咨询" id="btn-ddxz">  							</div>
        </div>
    </div>
    <!--约见地点-->

</section>
<!--弹出框-->
@stop
@section('script')
    <script>
        $(function(){
            //约见地点
            $('.btn-yjdd').tap(function(){
                $('.lszx-main').css({display:'none'});
                $('.yjdd-main').fadeIn();
            });
        })
    </script>
@stop