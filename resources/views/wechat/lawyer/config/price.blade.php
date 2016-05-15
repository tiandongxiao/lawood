@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <form id="form" action="#">
            <div class="form-list bg-fff-box">
                <div class="itms">
                    <div class="f-left">婚姻</div>
                    <label class="right zxf">
                        <input type="text"  class="In-text" value="300">
                        <span class="dw">元/小时</span>
                    </label>
                </div>
                <div class="itms">
                    <div class="f-left">股权</div>
                    <label class="right zxf">
                        <input type="text"  class="In-text" value="300">
                        <span class="dw">元/小时</span>
                    </label>
                </div>
                <div class="itms">
                    <div class="f-left">离婚</div>
                    <label class="right zxf">
                        <input type="text"  class="In-text" value="300">
                        <span class="dw">元/小时</span>
                    </label>
                </div>
                <div class="itms">
                    <div class="f-left">房产</div>
                    <label class="right zxf">
                        <input type="text"  class="In-text" value="300">
                        <span class="dw">元/小时</span>
                    </label>
                </div>
            </div>
            <div class="bottom-btn">
                <div class="blank100" style="height:200px;"></div>
                <div class="con te-cen">
                    <p class="fc-c0c0c0 fs-20">设定您的咨询服务价格</p>
                    <p class="fc-c0c0c0 line-30">每小时计算</p>
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定修改" id="In-btn">
                </div>
            </div>
        </form>
    </section>
@stop
@section('script')
    <script>
        $(function(){
            //表单提交
            $('#In-btn').tap(function(){
                //判断手机号码
                if(!$('.In-text').val()){
                    alert('价格不能为空')
                    return	false;
                }else{
                    var re =  /\d$/
                    if (!re.test($('.In-text').val())) {

                        alert('请输入正确的价格')
                        return	false;
                    }
                }
                $("#form").submit();
            })
        })
    </script>
@stop