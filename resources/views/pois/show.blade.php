@extends('tpl.lawyer.app')
@section('content')
    <h2>Pois: {{$pois->poi_id}}</h2>
    <ul class="list-group">
        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$pois->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Poi Id</h4>
            <h5>{{$pois->poi_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$pois->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$pois->updated_at}}</h5>
        </li>
    </ul>
@endsection