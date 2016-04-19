@extends('tpl.base.app')
@section('content')
    <ul>
    @foreach($orders as $order)
        <li> 订单交易号：{{$order->transactions[0]->transaction_id}}  &nbsp;<a href="#" class="btn btn-success">评论</a></li>
    @endforeach
    </ul>
@endsection