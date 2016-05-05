@extends('tpl.lawyer.app')
@section('content')
    <ul>
        @foreach($orders as $order)
            <li> 订单号：{{$order->id}}  &nbsp;<a href="{{url('order/accept/'.$order->order_no)}}" class="btn btn-success">接单</a><a href="{{url('order/reject/'.$order->order_no)}}" class="btn btn-success">据单</a></li>
        @endforeach
    </ul>
@endsection