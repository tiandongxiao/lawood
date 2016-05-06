@extends('tpl.lawyer.app')
@section('content')
    @if($orders)
        <div class="text-center">
            @foreach($orders as $order)
                <div class="bg-black-gradient">
                    <h3>{{$order->user_id}}</h3>
                    <p>{{$order->statusCode}}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection