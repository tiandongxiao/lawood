@extends('tpl.base.app')
@section('content')
    @if($orders)
    <ul>
    @foreach($orders as $order)
        <li> 订单号：{{$order->id}}  &nbsp;<a href="{{url('order/refund/'.$order->order_no)}}" class="btn btn-success">退款</a></li>
    @endforeach
    </ul>
    @endif
@endsection