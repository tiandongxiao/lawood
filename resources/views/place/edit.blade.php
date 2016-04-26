@extends('tpl.base.app')

@section('content')

    <h2>Update Place: {{$place->name}}</h2>

    <form action="/place/{{$place->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('name','text')->model($place)->show() !!}

        {!! \Nvd\Crud\Form::input('price','text')->model($place)->show() !!}

        {!! \Nvd\Crud\Form::input('avatar','text')->model($place)->show() !!}

        {!! \Nvd\Crud\Form::input('desc','text')->model($place)->show() !!}

        {!! \Nvd\Crud\Form::input('address','text')->model($place)->show() !!}

        {!! \Nvd\Crud\Form::input('attach','text')->model($place)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection