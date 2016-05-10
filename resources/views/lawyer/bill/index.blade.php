@extends('tpl.lawyer.app')
@section('content')
    <h3>我的余额：{{$sum}}</h3>
    <a class="btn btn-lg btn-danger" href="{{url('lawyer/withdraw')}}">余额提现</a>
    <hr/>
    @if($orders)
        <div class="bg-success col-md-4">
            @foreach($orders as $order)
                @if($order->withdrew == false)
                    <div class="bg-blue">
                    <h4>{{$order->user->email}}</h4>
                    <p>收入 <span>+ {{$order->total}}</span></p>
                    <p>{{$order->updated_at->diffForHumans()}}</p>
                    </div>
                @else
                    <div class="bg-red">
                    <h4>{{$order->user->email}}</h4>
                    <p>提现 <span>- {{$order->total}}</span></p>
                    <p>{{$order->updated_at->diffForHumans()}}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="bg-success col-md-4">
            @foreach($orders as $order)
                @if($order->withdrew == false)
                    <div class="bg-blue">
                    <h4>{{$order->user->email}}</h4>
                    <p>收入 <span>+ {{$order->total}}</span></p>
                    <p>{{$order->updated_at->diffForHumans()}}</p>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="bg-success col-md-4">
            @foreach($orders as $order)
                @if($order->withdrew == true)
                    <div class="bg-blue">
                    <h4>{{$order->user->email}}</h4>
                    <p>提现 <span>- {{$order->total}}</span></p>
                    <p>{{$order->updated_at->diffForHumans()}}</p>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection