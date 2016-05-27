@extends('wechat.base.app')
@section('content')
    <section class="xxtz-main pad-0-10">
        @if($notifies)
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
        @endif
    </section>
@stop