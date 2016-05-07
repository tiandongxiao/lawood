@extends('tpl.lawyer.app')
@section('content')
    <div class="col-md-4">
    @if($notifies)
        <h4>全部通知</h4>
        @foreach($notifies as $notify)
            <div class="bg-black-gradient">
                <h3>{{$notify->type}}</h3><span>{{$notify->read? '已读':'未读'}}</span>
                <p>{{$notify->title}}</p>
                <p>{{$notify->content}}</p>
                <a href="{{$notify->url}}">详情</a>
            </div>
        @endforeach
    @endif
    </div>

    <div class="col-md-4">
        @if($notifies)
            <h4>已读通知</h4>
            @foreach($notifies as $notify)
                @if($notify->read)
                <div class="bg-black-gradient">
                    <h3>{{$notify->type}}</h3><span>已读</span>
                    <p>{{$notify->title}}</p>
                    <p>{{$notify->content}}</p>
                    <a href="{{$notify->url}}">详情</a>
                </div>
                @endif
            @endforeach
        @endif
    </div>

    <div class="col-md-4">
        @if($notifies)
            <h4>未读通知</h4>
            @foreach($notifies as $notify)
                @if(!$notify->read)
                    <div class="bg-black-gradient">
                        <h3>{{$notify->type}}</h3><span>未读</span>
                        <p>{{$notify->title}}</p>
                        <p>{{$notify->content}}</p>
                        <a href="{{$notify->url}}">详情</a>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection