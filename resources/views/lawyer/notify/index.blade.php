@extends('tpl.lawyer.app')
@section('content')
    @if($notifies)
        <div class="text-center">
        @foreach($notifies as $notify)
            <div class="bg-black-gradient">
                <h3>{{$notify->type}}</h3><span>{{$notify->read? '已读':'未读'}}</span>
                <p>{{$notify->title}}</p>
                <p>{{$notify->content}}</p>
                <a href="{{$notify->url}}">详情</a>
            </div>
        @endforeach
        </div>
    @endif
@endsection