@extends('tpl.base.app')

@section('content')

    <h2>Notification: {{$notification->user_id}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$notification->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>User Id</h4>
            <h5>{{$notification->user_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Type</h4>
            <h5>{{$notification->type}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Title</h4>
            <h5>{{$notification->title}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Url</h4>
            <h5>{{$notification->url}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Read</h4>
            <h5>{{$notification->read}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Content</h4>
            <h5>{{$notification->content}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$notification->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$notification->updated_at}}</h5>
        </li>
        
    </ul>

@endsection