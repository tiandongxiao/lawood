@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <!--律师名称-->
    <section class="lszcmc-main">
        <form id="form" action="{{url('wechat/lawyer/config')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="key" value="office">
            <label class="pad-10-0 dis-block top">
                <input type="text" class="In-text bg-fff-box" placeholder="请输入您的律所名称" id="In-name" name="office">
            </label>
            <div class="hot bg-fff-box fc-909090">
                <div class="tie">热门律所</div>
                <div class="con  clearfix" id="btn-name">
                    <div class="itms chaochu_1 on">北京京师律师事务所1</div>
                    <div class="itms chaochu_1">北京京师律师事务所2</div>
                    <div class="itms chaochu_1">北京京师律师事务所3</div>
                    <div class="itms chaochu_1">北京京师律师事务所4</div>
                    <div class="itms chaochu_1">北京京师律师事务所5</div>
                    <div class="itms chaochu_1">北京京师律师事务所6</div>
                </div>
            </div>

            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定" id="In-btn" readonly>
                </div>
            </div>
        </form>
    </section>
    <!--律师名称-->
@stop
@section('script')
    <script>
        $(function(){
            //切换默认
            $('#btn-name .itms').tap(function(){
                $('#btn-name .itms').removeClass('on');
                $(this).addClass('on');
                $('#In-name').val($(this).text());
            });
            //表单提交
            $('#In-btn').tap(function(){
                //名称
                if(!$('.In-text').val()){
                    alert('律师事务所名称不能为空');
                    return	false;
                }
                $("#form").submit();
            });
        })
    </script>
@stop