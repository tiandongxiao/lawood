@extends('base.master')

@section('content')

    <h2>Location: {{$location->type}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$location->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Type</h4>
            <h5>{{$location->type}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Address</h4>
            <h5>{{$location->address}}</h5>
        </li>
        
    </ul>

@endsection