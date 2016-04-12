@extends('tpl.lawyer.app')

@section('content')

    <h2>Post: {{$post->title}}</h2>

    <ul class="list-group">

        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$post->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Title</h4>
            <h5>{{$post->title}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Body</h4>
            <h5>{{$post->body}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Created At</h4>
            <h5>{{$post->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>Updated At</h4>
            <h5>{{$post->updated_at}}</h5>
        </li>
        
    </ul>

@endsection