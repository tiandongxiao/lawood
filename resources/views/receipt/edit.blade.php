@extends('vendor.crud.single-page-templates.common.app')

@section('content')

    <h2>Update Receipt: {{$receipt->order_id}}</h2>

    <form action="/receipt/{{$receipt->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('order_id','text')->model($receipt)->show() !!}

        {!! \Nvd\Crud\Form::input('receiver','text')->model($receipt)->show() !!}

        {!! \Nvd\Crud\Form::input('title','text')->model($receipt)->show() !!}

        {!! \Nvd\Crud\Form::input('address','text')->model($receipt)->show() !!}

        {!! \Nvd\Crud\Form::input('code','text')->model($receipt)->show() !!}

        {!! \Nvd\Crud\Form::input('phone','text')->model($receipt)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection