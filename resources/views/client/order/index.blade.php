@extends('tpl.client.app')
@section('content')
    @if($orders)
        <div class="col-md-1">
            <h4>pending</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'pending')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                        <a href="{{url('client/order/pay/'.$order->id)}}">付款</a>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-md-1">
            <h4>已付款未接单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'payed')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                        <a href="{{url('order/cancel/'.$order->id)}}">取消</a>
                        <a href="{{url('order/reminder/'.$order->id)}}">催单</a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-1">
            <h4>已接单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'accepted')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                        <a href="{{url('order/sign/'.$order->id)}}">签到</a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-1">
            <h4>拒绝订单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'rejected')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-1">
            <h4>取消订单</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'canceled')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-1">
            <h4>一方签到</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'in_process')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                        <a href="{{url('order/sign/'.$order->id)}}">签到</a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="col-md-1">
            <h4>已完成</h4>
            @foreach($orders as $order)
                @if($order->statusCode == 'completed')
                    <div class="bg-black-gradient">
                        <h4>{{$order->seller->email}}</h4>
                        <p>{{$order->statusCode}}</p>
                        <a href="{{url('client/order/feedback/'.$order->id)}}">立即评论</a>
                        <a></a>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection