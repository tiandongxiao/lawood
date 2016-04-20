@extends('tpl.lawyer.app')
@section('content')
    <ul>
        @foreach($orders as $order)
            <li> 订单号：{{$order->id}}  &nbsp; </li>
        @endforeach
    </ul>
@endsection