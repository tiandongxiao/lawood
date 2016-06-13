@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lssz-main">
        <div style="text-align:center;margin-top: 60%">您当前不能使用设置系统</div>
        <div class="bottom-btn">
            <div class="blank100" style="height:120px;"></div>
            <div class="con te-cen">
                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="返回首页" id="In-btn">
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $(function () {
            $('#In-btn').click(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop