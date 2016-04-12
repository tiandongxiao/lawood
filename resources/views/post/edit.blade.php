@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Update Post: {{$post->title}}</h2>

    <form action="/post/{{$post->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('title','text')->model($post)->show() !!}

        {!! \Nvd\Crud\Form::input('body','text')->model($post)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection