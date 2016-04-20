@extends('tpl.base.app')
@section('content')
    <ul>
    @foreach($orders as $order)
        <li> 订单交易号：{{$order->transactions[0]->transaction_id}}  &nbsp;<a href="{{url('order/refund/'.$order->order_no)}}" class="btn btn-success">退款</a></li>
    @endforeach
    </ul>
@endsection