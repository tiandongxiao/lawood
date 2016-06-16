@extends('tpl.admin.app')

@section('content')
    <h2>Bill: {{$bill->user_id}}</h2>
    <ul class="list-group">
        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$bill->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>User Id</h4>
            <h5>{{$bill->user_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$bill->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$bill->updated_at}}</h5>
        </li>
    </ul>
@endsection