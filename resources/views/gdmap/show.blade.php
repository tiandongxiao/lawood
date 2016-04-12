@extends('base.master')

@section('content')

    <h2>Gdmap: {{$gdmap->address}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$gdmap->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Address</h4>
            <h5>{{$gdmap->address}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Category</h4>
            <h5>{{$gdmap->category}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Name</h4>
            <h5>{{$gdmap->name}}</h5>
        </li>
        
    </ul>

@endsection