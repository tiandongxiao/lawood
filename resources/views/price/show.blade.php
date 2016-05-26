@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Price: {{$price->user_id}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$price->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>User Id</h4>
            <h5>{{$price->user_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Category Id</h4>
            <h5>{{$price->category_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Price</h4>
            <h5>{{$price->price}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$price->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$price->updated_at}}</h5>
        </li>
        
    </ul>

@endsection