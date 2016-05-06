@extends('tpl.lawyer.app')
@section('content')
    @if($locations)
        <div class="text-center">
            @foreach($locations as $location)
                <div class="bg-black-gradient">
                    <h3>{{$location->type}}</h3>
                    <p>{{$location->address}}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection