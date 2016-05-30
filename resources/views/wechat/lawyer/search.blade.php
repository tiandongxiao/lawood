@extends('wechat.base.lawyer')
@section('content')
    <!--地图定位-->
    <section class="dtdw-main">
        <div class="map" id="map" style="height: 100%"></div>
        <div class="btn-pl"><img src="/images/icon-pl.png" width="44" height="44"></div>
        <div class="lvzy-main">
            <a class="itms-form" href="#"><span  class="In-text" >我的位置</span></a>

            <span  class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16 line-40" id="btn-more">发现204位相关律师<font class="fs-12">(点击查看)</font></span>
        </div>
    </section>
    <!--地图定位-->

    <!--弹出框-->
    <section class="lstc-main"   style="display:none;">
        <!--附近律师-->
        <div class="tc-m fjls-main">
            <div class="bg-fff c-main" >
                <div class="tie tie-1">
                    <p>您附近的专业律师</p><i class="btn-fjls btn-gb"></i>
                    <div class="itms-nav"><span>价格筛选</span></div>
                    <div class="itms-nav"><span>距离筛选</span></div>
                </div>
                <div class="con" style="padding-top:80px;">
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>
                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>

                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>

                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
                        </div>
                        <div class="btn-ckmp">查看名片</div>
                    </div>

                    <div class="itms">
                        <div class="f-left"><img src="/images/ls.jpg" width="40px" height="40px;"></div>
                        <div class="right">
                            <h3 class="chaochu_1">王树德 律师</h3>
                            <p class="chaochu_1"><span><img src="/images/icon-q.png" width="20" height="20" class="img">220元</span>　　<span><img src="/images/icon-w.png" width="20" height="20" class="img">220米</span></p>
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
                <div class="con" style="padding-top:60px;">
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
                <div class="top" style="padding-top:60px;">
                    <div class="tie">咨询费<i class="btn-fjls btn-gb"></i><i class="btn-back back-lsmp"></i></div>
                    <div class="xx">
                        <div><img src="/images/logo.png"  height="50"></div>
                        <div>咨询费　｜　220元</div>
                        <p class="fs-12 line-15 mar-top-5">见面咨询90分钟</p>
                        <p class="fs-12 line-15">电话咨询不超过60分钟</p>
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
                <div class="con" style="padding:60px 10px 70px;">
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
    @include('wechat.base.service.gaode')
    <script>
        $(function(){
            // 初始化地图
            gdMapInit();
            locatePosition(function (data) {
                // 定位成功
                position = data.position;
                map.setZoom(13);
                map.setCenter(position);
                //添加点标记，并使用自己的icon
                var icon = new AMap.Icon({
                    image: '/images/icon-wz2.png',
                    size: new AMap.Size(22, 28)
                });
                new AMap.Marker({
                    map: map,
                    position: [position.getLng(),position.getLat()],
                    icon: icon
                });

            },function (data) {
                // 定位失败
            });

            showCloudData();
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
            $('.lstc-main').click(function(){

                if(event.target==this){
                    $('.lstc-main').fadeOut();
                    $('.tc-m').fadeOut();
                }
            })
            $('.btn-gb').tap(function(){

                $('.lstc-main').fadeOut();
                $('.tc-m').fadeOut();
            })
        })
    </script>
@stop
