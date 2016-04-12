@extends('tpl.lawyer.app')

@section('content')

    <h2>Update Location: {{$location->type}}</h2>

    <form action="/location/{{$location->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('type','text')->model($location)->show() !!}

        {!! \Nvd\Crud\Form::input('address','text')->model($location)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection