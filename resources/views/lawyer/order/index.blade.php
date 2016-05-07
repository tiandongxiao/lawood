@extends('tpl.lawyer.app')
@section('content')
    @if($orders)
        <div class="col-md-2">
            <h4>pending</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'pending')
                    <div class="bg-black-gradient">
                        <h3>{{$order->user_id}}</h3>
                        <p>{{$order->statusCode}}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-md-2">
            <h4>已付款未接单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'payed')
                <div class="bg-black-gradient">
                    <h3>{{$order->user_id}}</h3>
                    <p>{{$order->statusCode}}</p>
                    <a href="{{url('order/accept/'.$order->id)}}">接单</a>
                    <a href="{{url('order/reject/'.$order->id)}}">忽略</a>
                </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-2">
            <h4>已接单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'accepted')
                    <div class="bg-black-gradient">
                        <h3>{{$order->user_id}}</h3>
                        <p>{{$order->statusCode}}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-2">
            <h4>忽略订单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'rejected')
                    <div class="bg-black-gradient">
                        <h3>{{$order->user_id}}</h3>
                        <p>{{$order->statusCode}}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-2">
            <h4>已完成</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'completed')
                    <div class="bg-black-gradient">
                        <h3>{{$order->user_id}}</h3>
                        <p>{{$order->statusCode}}</p>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection