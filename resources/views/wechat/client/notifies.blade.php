@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="xxtz-main pad-0-10">
        @if($notifies->count())
            @foreach($notifies as $notify)
                @if($notify->read)
                    <div class="itms bg-fff-box hui">
                        <div class="top">
                            <div class="f-right">已读</div>
                            <div class="bt">{{$notify->title}}</div>
                        </div>
                        <div class="con">{{$notify->content}}</div>
                        <div class="pad-0-10">
                            <div class="bottom">
                                <a href="#" class="more">点击查看</a>
                                <span class="time">{{$notify->created_at}}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="itms bg-fff-box">
                        <div class="top">
                            <div class="f-right">未读</div>
                            <div class="bt">{{$notify->title}}</div>
                        </div>
                        <div class="con">{{$notify->content}}</div>
                        <div class="pad-0-10">
                            <div class="bottom">
                                <a href="#" class="more">点击查看</a>
                                <span class="time">{{$notify->created_at}}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div style="text-align:center;margin-top: 60%">没有任何通告消息</div>
            <div class="bottom-btn">
                <div class="blank100" style="height:120px;"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 back-home" value="返回首页">
                </div>
            </div>
        @endif
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