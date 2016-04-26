@extends('tpl.base.app')

@section('content')

    <h2>Place: {{$place->name}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$place->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Name</h4>
            <h5>{{$place->name}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Price</h4>
            <h5>{{$place->price}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Avatar</h4>
            <h5>{{$place->avatar}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Desc</h4>
            <h5>{{$place->desc}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Address</h4>
            <h5>{{$place->address}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Attach</h4>
            <h5>{{$place->attach}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$place->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$place->updated_at}}</h5>
        </li>
        
    </ul>

@endsection