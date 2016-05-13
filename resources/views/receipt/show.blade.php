@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Receipt: {{$receipt->order_id}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$receipt->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Order Id</h4>
            <h5>{{$receipt->order_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Receiver</h4>
            <h5>{{$receipt->receiver}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Title</h4>
            <h5>{{$receipt->title}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Address</h4>
            <h5>{{$receipt->address}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Code</h4>
            <h5>{{$receipt->code}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Phone</h4>
            <h5>{{$receipt->phone}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$receipt->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$receipt->updated_at}}</h5>
        </li>
        
    </ul>

@endsection