@extends('tpl.base.app')
@section('content')
    @if($consults)
        <div class="text-center">
            @foreach($consults as $consult)
                <div class="bg-black-gradient">
                    <h3>{{$consult->price}}</h3>
                    <p>{{$consult->user->email}}</p>
                    <a href="{{url('order/place/'.$consult->id)}}">预约咨询</a>
                </div>
            @endforeach
        </div>
    @endif
@endsection