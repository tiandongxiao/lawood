@extends('tpl.base.app')
@section('content')
    <a class="btn btn-primary hidden" href="">支付宝扫码支付</a>
    <a class="btn btn-primary hidden" href="">支付宝支付</a>
    <a class="btn btn-success" href="{{url('wxpay/native/'.$item_id)}}">微信扫码支付</a>
    <a class="btn btn-success" href="{{url('wxpay/jsapi/'.$item_id)}}">微信支付</a>
@endsection