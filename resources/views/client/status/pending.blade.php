@extends('tpl.base.app')
@section('content')
    <ul>
        @foreach($orders as $order)
            <li> 订单号：{{$order->id}}  &nbsp;<a href="{{url('order/pay/'.$order->id)}}" class="btn btn-success">付款</a></li>
        @endforeach
    </ul>
@endsection