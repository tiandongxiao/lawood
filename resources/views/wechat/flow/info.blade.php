@extends('wechat.base.app')
@section('css')
    <style>
        .title{
            height: 130px;
            line-height: 130px;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin-top: 1px;
        }
        .content{
            padding:25px;
            height: 130px;
            line-height: 25px;
        }
    </style>
@stop
@section('content')
    <section class="info-area" style="position:absolute;height: 100%;width:100%">
        @if($data)
            <div style="text-align: center;padding: 1px">
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
            <div>
                <div class="content mar-top-20">
                    {{$data['body']}}
                </div>
                <div class="button" style="text-align: center">
                    <span><a style="color: #00abeb;font-size: 14px" href="{{$data['url']}}">{{$data['button']}}</a></span>
                </div>
            </div>
        @endif
    </section>
@stop