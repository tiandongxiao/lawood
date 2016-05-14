@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <!--律师名称-->
    <section class="lszcmc-main">
        <form action="" method="">
            <label class="pad-10-0 dis-block top">
                <input type="tel" class="In-text bg-fff-box" placeholder="请输入您的律所名称" id="In-name">
            </label>
            <div class="hot bg-fff-box fc-909090">
                <div class="tie">热门律所</div>
                <div class="con  clearfix" id="btn-name">
                    <div class="itms chaochu_1">北京京师律师事务所1</div>
                    <div class="itms chaochu_1 on">北京京师律师事务所2</div>
                    <div class="itms chaochu_1">北京京师律师事务所3</div>
                    <div class="itms chaochu_1">北京京师律师事务所4</div>
                    <div class="itms chaochu_1">北京京师律师事务所5</div>
                    <div class="itms chaochu_1">北京京师律师事务所6</div>
                    <div class="itms chaochu_1">北京京师律师事务所7</div>
                    <div class="itms chaochu_1">北京京师律师事务所8</div>
                </div>
            </div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-50" value="确认" >
        </form>
    </section>
    <!--律师名称-->
@stop
@section('script')
    <script>
        $(function(){
            //切换默认
            $('#btn-name .itms').tap(function(){
                $('#btn-name .itms').removeClass('on')
                $(this).addClass('on')
                $('#In-name').val($(this).text());
            })
        })
    </script>
@stop