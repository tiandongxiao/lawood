@extends('tpl.lawyer.app')
@section('content')
    <ul>
    @foreach($orders as $order)
        <li><a>订单交易号：{{$order->transaction->transaction_id}}</a>订单状态<span>{{$order->getState()}}</span></li>
    @endforeach
    </ul>
@endsection