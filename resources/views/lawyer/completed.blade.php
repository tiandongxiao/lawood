@extends('tpl.lawyer.app')
@section('content')
    <ul>
    @foreach($orders as $order)
        <li><a>订单交易号：{{$order->transactions[0]->transaction_id}}</a>订单状态<span>{{$order->statusCode}}</span></li>
    @endforeach
    </ul>
@endsection