@extends('wechat.base.app')
@section('css')
    <style>body{background:#03aaf0}</style>
@endsection
@section('content')
    <section class="dl-main">
        <div class="logo-index"><img src="/images/logo.png"></div>
        <div class="fc-fff bottom-index">
            <a href="{{url('wechat/reg/client')}}">个人注册</a>　|　<a href="{{url('wechat/reg/lawyer')}}">律师注册</a>
        </div>
    </section>
@endsection