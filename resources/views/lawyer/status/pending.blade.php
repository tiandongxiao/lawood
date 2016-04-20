@extends('tpl.base.app')
@section('content')
    <ul>
        @foreach($orders as $order)
            <li> 订单号：{{$order->id}}  &nbsp;<a href="{{url('order/accept/'.$order->order_no)}}" class="btn btn-success">接单</a></li>
        @endforeach
    </ul>
@endsection