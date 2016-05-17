@extends('wechat.base.client')
@section('content')

    <!--地图定位-->
    <section class="dtdw-main">

        <div class="map"><img src="/images/map.png" class="po-a"  width="100%" height="100%"></div>
        <div class="btn-pl"><a><img src="/images/icon-pl.png" width="44" height="44"></a></div>
        <div class="btn-wz"></div>
        <div class="btn-wz"></div>
        <div class="btn-wz"></div>
        <div class="lvzy-main">
            <a class="itms-form" href="#"><span  class="In-text" >我的位置</span></a>
            <span  class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16 line-40" id="btn-more">发现204位相关律师<font class="fs-12">(点击查看)</font></span>
        </div>
    </section>
    <!--地图定位-->

    <!--弹出框-->
    <section class="lstc-main" style="display:none;">
        <!--附近律师-->
        <div class="tc-m fjls-main">
            <div class="bg-fff c-main">
                <div class="tie">您附近的专业律师<i class="btn-fjls btn-gb"></i></div>
                <div class="con">
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                </div>
            </div>
        </div>
        <!--附近律师-->
        <!--律师名片-->
        <div class="tc-m lsmp-main">
            <div class="bg-fff c-main">
                <div class="tie">您附近的专业律师<i class="btn-fjls  btn-gb"></i><i class="btn-back back-fjls"></i></div>
                <div class="con">
                    <div class="img">
                        <img src="/images/mp-banner.png" width="100%">
                        <a href="#" class="link-more">点击查看详情</a>
                        <div class="zxf">
                            <p class="top">咨询费</p>
                            <p class="bottom">220<font class="fs-18">元</font></p>
                        </div>
                    </div>
                    <div class="name">
                        <div class="f-right"><span class="btn-ljzx">立即咨询</span></div>
                        <div class="left">
                            <h3 class="chaochu_1">王树德	<span>律师</span></h3>
                            <p class="chaochu_1">北京市朝阳区京师律师事务所</p>
                        </div>
                    </div>
                    <div class="bq">
                        <span class="ren">39人咨询过</span>
                        <span class="jl">0.5km</span>
                    </div>
                </div>
            </div>
        </div>
        <!--律师名片-->
        <!--律师咨询费-->
        <div class="tc-m lszx-main">
            <div class="bg-fff c-main">
                <div class="top">
                    <div class="tie">咨询费<i class="btn-fjls btn-gb"></i><i class="btn-back back-lsmp"></i></div>
                    <div class="xx">
                        <h3>220元</h3>
                        <p>见面咨询90分钟</p>
                        <p>电话咨询不超过60分钟</p>
                    </div>
                </div>
                <div class="bottom pad-10">
                    <div class="line-35 fs-16 fc-505050">选择地区</div>
                    <div class="itms-select">
                        <div class="f-left">
                            <select>
                                <option>北京地区</option>
                                <option>上海地区</option>
                                <option>广州地区</option>
                            </select>
                        </div>
                        <div class="right chaochu_1">其他地区预约后只能电话咨询</div>
                    </div>
                    <div class="line-35 fs-16 fc-505050">选择相关法律问题</div>
                    <div class="itms-bd-1 clearfix">
                        <span class="list-1 on">婚姻</span>
                        <span class="list-1">房产</span>
                        <span class="list-1">债务</span>
                        <span class="list-1">劳动争议</span>
                    </div>
                    <a href="#" class="In-btn In-btn-1 bg-lan1 fc-fff line-40 fs-16 mar-top-10 btn-yjdd">立即咨询</a>
                </div>
            </div>
        </div>
        <!--律师咨询费-->
        <!--约见地点-->
        <div class="tc-m yjdd-main" >
            <div class="bg-fff c-main">
                <div class="tie">选择约见地点<i class="btn-fjls btn-gb"></i><i class="btn-back back-lszx"></i></div>
                <div class="con">
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
            </div>
        </div>
        <!--约见地点-->
    </section>
    <!--弹出框-->
@stop
@section('script')
    <script>
        $(function(){
            $('.dtdw-main').height($('body').height()-100)
            $(window).resize(function() {
                $('.dtdw-main').height($('body').height()-100)
            });

            //切换栏目
            $('.itms-hd').tap(function(){
                $('.itms-hd').removeClass('on');
                $(this).addClass('on');
                $('.itms-bd').removeClass('show');
                $('.itms-bd').removeClass('on');
                $('.itms-bd').eq($(this).index()).addClass('on');

            })

            //栏目下拉上升
            $(document).on('click','.btn-xl',function(){
                $('.nav-main').removeClass('on1');
                $('.nav-main').addClass('on');
                $(this).attr({class:'btn-ss'})
            })
            $(document).on('click','.btn-ss',function(){
                $('.nav-main').removeClass('on');
                $('.nav-main').addClass('on1');
                $(this).attr({class:'btn-xl'})
            })
            $('.nav-main').tap(function(){
                if(event.target==this){
                    $('.nav-main').removeClass('on');
                    $('.nav-main').addClass('on1');
                    $('.btn-ss').attr({class:'btn-xl'})
                }
            })

            //打开侧边
            $('.btn-cb').tap(function(){
                $('.nav-main').removeClass('on1');
                $('.cblm-main').addClass('on')
            })
            $('.cblm-main').tap(function(){

                if(event.target==this){
                    $('.nav-main').removeClass('on');
                    $('.cblm-main').addClass('on1')
                }
            })
            //切换栏目
            $('.list').tap(function(){
                $('.list').removeClass('on');
                $(this).addClass('on')
            })
            //查看更多律师
            $('#btn-more').tap(function(){
                $('.lstc-main').fadeIn();
                $('.fjls-main').fadeIn();
            })

            //查看名片
            $('.btn-ckmp').tap(function(){
                $('.fjls-main').css({display:'none'});
                $('.lsmp-main').fadeIn();
            })
            //返回附近律师
            $('.back-fjls').tap(function(){
                $('.lsmp-main').css({display:'none'});
                $('.fjls-main').fadeIn();
            })
            //律师咨询
            $('.btn-ljzx').tap(function(){
                $('.lsmp-main').css({display:'none'});
                $('.lszx-main').fadeIn();
            })
            //返回律师名片
            $('.back-lsmp').tap(function(){
                $('.lszx-main').css({display:'none'});
                $('.lsmp-main').fadeIn();
            })

            //切换咨询栏目
            $('.list-1').tap(function(){
                $('.list-1').removeClass('on');
                $(this).addClass('on')
            })

            //约见地点
            $('.btn-yjdd').tap(function(){
                $('.lszx-main').css({display:'none'});
                $('.yjdd-main').fadeIn();
            })

            //返回律师咨询
            $('.back-lszx').tap(function(){
                $('.yjdd-main').css({display:'none'});
                $('.lszx-main').fadeIn();
            })
            //关闭弹出框
            $('.lstc-main').tap(function(){

                if(event.target==this){
                    $('.lstc-main').fadeOut();
                    $('.tc-m').fadeOut();
                }
            })
            $('.btn-gb').tap(function(){

                if(event.target==this){
                    $('.lstc-main').fadeOut();
                    $('.tc-m').fadeOut();
                }
            })
        })
    </script>
@stop
