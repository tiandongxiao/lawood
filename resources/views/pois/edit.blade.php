@extends('base.master')

@section('content')

    <h2>Update Pois: {{$pois->poi_id}}</h2>

    <form action="/pois/{{$pois->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('poi_id','text')->model($pois)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection