@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lstc-main wdsc-main">
        <div class="fjls-main">
            <div class="bg-fff c-main">
                <div class="con">
                    @if($collects)
                        @foreach($collects as $consult)
                            <div class="itms">
                                <div class="f-left"><img src="{{$consult->seller->avatar}}" width="30px" height="30px"></div>
                                <div class="right">
                                    <h3 class="chaochu_1 mar-top-10"><span class="fc-03aaf0">{{$consult->seller->real_name}} 律师</span>　　{{$consult->category->name}}</h3>
                                    <p class=" fc-03aaf0 mar-top-10">咨询费：{{$consult->price}}元</p>
                                </div>
                                <a class="btn-ckmp" href="{{url('wechat/user/'.$consult->seller->id.'?consult='.$consult->id)}}">查看名片</a>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align:center;margin-top: 60%;background:#f8f8f8">您当前没有收藏任何咨询项</div>
                        <div class="bottom-btn">
                            <div class="blank100" style="height:120px;background:#f8f8f8"></div>
                            <div class="con te-cen">
                                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="返回首页">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $(function () {
            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });
        })
    </script>
@stop