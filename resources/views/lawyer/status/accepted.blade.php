@extends('tpl.lawyer.app')
@section('content')
    <ul>
        @foreach($orders as $order)
            <li> 订单号：{{$order->id}}  &nbsp; <a href="{{url('order/sign/'.$order->order_no)}}" class="btn btn-success">签到</a> </li>
        @endforeach
    </ul>
@endsection