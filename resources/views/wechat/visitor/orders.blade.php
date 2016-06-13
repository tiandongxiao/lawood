@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lsdd-main">
        <div class="hd po-f">
            <div class="itms on"><span>未完成</span></div>
            <div class="itms"><span>进行中</span></div>
            <div class="itms"><span>已完成</span></div>
        </div>
        <div class="bd" style="padding-top:40px;">
            <!--未完成-->
            <div class="bd-itms"  style="display:block">
                <div style="text-align:center;margin-top: 60%">您当前没有未完成的订单</div>
            </div>
            <!--未完成-->
            <!--进行中-->
            <div class="bd-itms" >
                <div style="text-align:center;margin-top: 60%">您当前没有进行中的订单</div>
            </div>
            <!--进行中-->
            <!--已完成-->
            <div class="bd-itms">
                <div style="text-align:center;margin-top: 60%">您当前没有已完成的订单</div>
            </div>
            <!--已完成-->
        </div>
    </section>
@stop
@section('script')
@stop