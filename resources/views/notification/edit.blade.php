@extends('tpl.base.app')

@section('content')

    <h2>Update Notification: {{$notification->user_id}}</h2>

    <form action="/notification/{{$notification->id}}" method="post">

        {{ csrf_field() }}

        {{ method_field("PUT") }}

        {!! \Nvd\Crud\Form::input('user_id','text')->model($notification)->show() !!}

        {!! \Nvd\Crud\Form::input('type','text')->model($notification)->show() !!}

        {!! \Nvd\Crud\Form::input('title','text')->model($notification)->show() !!}

        {!! \Nvd\Crud\Form::input('url','text')->model($notification)->show() !!}

        {!! \Nvd\Crud\Form::input('read','text')->model($notification)->show() !!}

        {!! \Nvd\Crud\Form::input('content','text')->model($notification)->show() !!}

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection