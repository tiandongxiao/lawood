@extends('tpl.base.app')
@section('content')
    <ul>
        @foreach($orders as $order)
            <li> {{$order->statusCode}}<a href="#" class="btn btn-success">退款</a></li>
        @endforeach
    </ul>
@endsection