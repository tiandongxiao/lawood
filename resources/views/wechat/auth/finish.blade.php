@extends('wechat.base.app')
@section('css')
    <style>body{background:#03aaf0}
        .dl-main .logo-index {margin: 30% 0;}
    </style>
@endsection
@section('content')
    <section class="dl-main">
        <div class="logo-index"><img style="width: 70%" src="/images/logo.png"></div>
    </section>
    <!--提交审核-->
    <section class="tc-main	tjsh-main">
        <div class="main te-cen">
            <div class="pad-10-0"><img src="/images/wc.png" width="38" height="38"></div>
            <div class="line-20 fc-909090 pad-10-0 fs-15">您的注册已经提交律屋</div>
            <div class="fc-03aaf0">我们将尽快审核</div>
            <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-30" value="确认" id="btn-qr">
        </div>
    </section>
    <!--提交审核-->
@endsection
@section('script')
    <script>
    //提交审核
    $('#btn-qr').tap(function(){
        $('.tc-main').hide();
        window.location.href="/wechat";
    })
    </script>
@stop