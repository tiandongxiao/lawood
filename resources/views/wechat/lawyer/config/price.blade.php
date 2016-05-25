@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <form id="form" action="{{url('wechat/lawyer/config')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="key" value="price">
            <div class="form-list bg-fff-box">
                @foreach(Auth::user()->categories as $category)
                    <div class="itms">
                        <div class="f-left">{{$category->name}}</div>
                        <label class="right zxf">
                            <input type="text"  class="In-text" value="{{Auth::user()->getGoodByCategory($category->id)->price}}">
                            <span class="dw">元/小时</span>
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="bottom-btn">
                <div class="blank100" style="height:200px;"></div>
                <div class="con te-cen">
                    <p class="fc-c0c0c0 fs-20">设定您的咨询服务价格</p>
                    <p class="fc-c0c0c0 line-30">每小时计算</p>
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16" value="确定修改" id="In-btn">
                </div>
            </div>
        </form>
    </section>

    <!--提交审核-->
    <section class="tc-main	tjsh-main" style="display:none;">
        <div class="main te-cen">
            <div class="pad-10-0"><img src="/images/icon-xsts.png" width="50" height="50"></div>
            <div class="line-20  fs-20">超限提示</div>
            <div class=" pad-20 mar-top-10 fs-13 fc-d2d2d2 te-left">您设置的金额超出限制，最低不超过200元，最高不超过300元。</div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16" value="确定" id="ok-btn">
        </div>
    </section>
    <!--提交审核-->
@stop
@section('script')
    <script>
        $(function(){
            //表单提交
            $('#In-btn').tap(function(){
                var itmsNum	=	$('.form-list .itms').last().index();
                for (var i=0;i<=itmsNum; i++){
                    var	dom	=$('.form-list .itms').eq(i).find('.In-text');
                    //判断手机号码
                    if(!dom.val()){
                        alert('价格不能为空')
                        return	false;
                    }else{
                        var re =  /\d$/
                        if (!re.test(dom.val())) {
                            alert('请输入正确的价格')
                            return	false;
                        }else{
                            if( dom.val()<200	|| dom.val()>300){
                                $('.tc-main').fadeIn();
                                return	false;
                            }
                        }
                    }
                }
                $("#form").submit();
            })

            $('input').focus(function(){
                $('input').has('focus').val('');
            }).blur(function () {

            });

            $('.tc-main').click(function(){
                if(event.target==this){
                    $('.tc-main').fadeOut('');
                }
            })

            $('#ok-btn').click(function(){
                $('.tc-main').fadeOut('');
            })
        })
    </script>
@stop