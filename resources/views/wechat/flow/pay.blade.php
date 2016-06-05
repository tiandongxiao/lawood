@extends('wechat.base.app')
@section('content')
    <section class="sjxz-main">
        <div class="top">
            <div class="tx"><img src="/images/ls.jpg" width="60" height="60" class="br-50"></div>
            <div class="fy"><span class="fs-18">209</span>元</div>
            <p class="fc-fff line-40 fs-18">您正在预约</p>
            <p class="fc-a4dfff line-20">北京市京师律师事务所 <font class="fc-fff">王树德律师</font> 进行法</p>
            <p class="fc-a4dfff line-20 dd">预约地点暂定cost咖啡厅梅市口路点</p>
            <p class="mar-top-20 fc-fff fs-12">律师将在 12小时内以电话形式回复预</p>
            <p class="fc-fff fs-12">并确定最终的预约信息</p>
        </div>

        <form id="form" action="#">
            <div class="form bg-fff-box">
                <div class="itms">
                    <div class="f-left">联 系 人</div>
                    <div class="right">
                        <input type="text" class="In-text" placeholder="请输入联系人姓名" id="name">
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left">我要开发票</div>
                    <div class="right">
                        <div class="ts fc-c0c0c0" style="display:none">邮费用费到付</div>
                        <input type="checkbox" class="In-check" >
                    </div>
                </div>
                <div class="con con-1" style="display:none;">

                    <div class="itms">
                        <div class="f-left">发票抬头</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入发票抬头"  id="fptt">
                        </div>
                    </div>
                    <div class="itms">
                        <div class="f-left">邮寄地址</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入邮寄地址" id="yjdz">
                        </div>
                    </div>
                    <div class="itms">
                        <div class="f-left">收件人</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入收件人" id="sjr-name">
                        </div>
                    </div>
                    <div class="itms">
                        <div class="f-left">电话号码</div>
                        <div class="right">
                            <input type="text" class="In-text" placeholder="请输入电话号码" id="mobile">
                        </div>
                    </div>
                </div>

            </div>

            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确认支付" id="In-btn">
                </div>
            </div>
        </form>
    </section>
@stop
@section('script')
@stop