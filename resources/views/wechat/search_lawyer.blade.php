@extends('wechat.base.app')
@section('css')
    <style>
        body{background:#f8f8f8}
        .wdsc-main	.fjls-main	.c-main	.itms	.f-left {padding: 8px 5px;}
        .lstc-main	.fjls-main	.c-main	.itms	.f-left	img {border-radius: 10%;}
        .lstc-main	.fjls-main	.c-main	.itms	.right {padding-left: 70px;}
    </style>
@stop
@section('content')
    <section class="lstc-main wdsc-main">
        <div class="fjls-main">
            <div class="bg-fff c-main">
                <div class="con">
                    @if($lawyers->count())
                        @foreach($lawyers as $lawyer)
                            <div class="itms">
                                <div class="f-left"><img src="{{$lawyer->avatar}}"></div>
                                <div class="right">
                                    <h3 class="chaochu_1"><span class="fc-03aaf0" style="font-size: 16px">{{$lawyer->real_name}}</span>　[律师]</h3>
                                    <p></p>
                                    <p class="mar-top-10" style="font-size: 15px">{{$lawyer->office}}</p>
                                </div>
                                <a class="btn-ckmp" href="{{url('wechat/user/'.$lawyer->id)}}">查看名片</a>
                            </div>
                        @endforeach
                    @else
                        <p class="te-cen" style="margin-top: 200px;background:#f8f8f8;font-size: 14px;">查无此律师</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="bottom-btn">
            <div class="blank100"></div>
            <div class="con te-cen">
                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="返回" id="In-btn" readonly>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $('.In-btn').tap(function () {
            window.location.href="/wechat";
        });
    </script>
@stop