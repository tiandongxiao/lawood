@extends('tpl.lawyer.app')
@section('content')
    <ul>
    @foreach($orders as $order)
        <li><a>订单号：{{$order->id}}</a>订单状态<span>{{$order->statusCode}}~ 金额：{{$order->total/100}}元<a href="{{url('wxpay/refund/'.$order->transactions[0]->transaction_id)}}">退款</a></span></li>
    @endforeach
    </ul>
@endsection