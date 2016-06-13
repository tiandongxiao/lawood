@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="xxtz-main pad-0-10">
        <div style="text-align:center;margin-top: 60%">没有任何通告消息</div>
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
            $('#In-btn').tap(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop