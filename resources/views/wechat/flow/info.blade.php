@extends('wechat.base.app')
@section('css')
    <style>
        .title{
            height: 130px;
            line-height: 130px;
        }
        .content{
            padding:40px;
            height: 150px;
        }
    </style>
@stop
@section('content')
    <section class="info-area" style="height: 100%;">
        @if($data)
            <div style="text-align: center">
                @if($data['type'] == 'success')
                    <div class="title" style="background-color: #00a65a">{{$data['title']}}</div>
                @elseif($data['type'] == 'fail')
                    <div class="title" style="background-color: #2c3b41">{{$data['title']}}</div>
                @elseif($data['type'] == 'invalid')
                    <div class="title" style="background-color: #880000">{{$data['title']}}</div>
                @elseif($data['type'] == 'warning')
                    <div class="title" style="background-color: #BE5C00">{{$data['title']}}</div>
                @endif
            </div>
            <div class="content">
                {{$data['body']}}
            </div>
            <div class="button" style="text-align: center;bottom: 100px">
                <span><a href="{{$data['url']}}">{{$data['button']}}</a></span>
            </div>
        @endif
    </section>
@stop