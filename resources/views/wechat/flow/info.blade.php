@extends('wechat.base.app')
@section('content')
    <section class="info-area">
        @if($data)
            <div class="title">
                @if($data['type'] == 'success')
                    <div style="background-color: #00a65a">{{$data['title']}}</div>
                @elseif($data['type'] == 'fail')
                    <div style="background-color: #2c3b41">{{$data['title']}}</div>
                @elseif($data['type'] == 'invalid')
                    <div style="background-color: #880000">{{$data['title']}}</div>
                @elseif($data['type'] == 'warning')
                    <div style="background-color: #BE5C00">{{$data['title']}}</div>
                @endif
            </div>
            <div class="body">
                {{$data['body']}}
            </div>
            <div class="button">
                <span><a href="{{$data['url']}}">{{$data['button']}}</a></span>
            </div>
        @endif
    </section>
@stop