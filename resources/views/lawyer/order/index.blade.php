@extends('tpl.lawyer.app')
@section('content')
    @if($consults)
        <div class="text-center">
            @foreach($consults as $consult)
                <div class="bg-black-gradient">
                    <h3>{{$consult->price}}</h3>
                    <p>{{$consult->user->email}}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection