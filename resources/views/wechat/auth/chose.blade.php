@extends('wechat.base.app')
@section('css')
    <style>
        body{background:#03aaf0}
        .dl-main .logo-index {
            margin: 25% 0;
        }
        .dl-main .bottom-index {
            bottom: 25%;
        }
    </style>
@endsection
@section('content')
    <section class="dl-main">
        <div class="logo-index"><img style="width: 70%" src="/images/logo.png"></div>
        <div class="fc-fff bottom-index">
            <a href="{{url('wechat/bind/client')}}">咨询用户</a>　|　<a href="{{url('wechat/bind/lawyer')}}">律师注册</a>
        </div>
    </section>
@endsection