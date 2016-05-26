@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Update Price: {{$price->user_id}}</h2>

    <form action="/price/{{$price->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('user_id','text')->model($price)->show() !!}

        {!! \Nvd\Crud\Form::input('category_id','text')->model($price)->show() !!}

        {!! \Nvd\Crud\Form::input('price','text')->model($price)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection