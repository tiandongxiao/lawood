@extends('base.master')

@section('content')

    <h2>Update Gdmap: {{$gdmap->address}}</h2>

    <form action="/gdmap/{{$gdmap->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('name','text')->model($gdmap)->show() !!}

        {!! \Nvd\Crud\Form::input('address','text')->model($gdmap)->show() !!}

        {!! \Nvd\Crud\Form::input('category','text')->model($gdmap)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection