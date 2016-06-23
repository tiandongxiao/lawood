@extends('vendor.crud.single-page-templates.common.app')

@section('content')
    <h2>Update Bill: {{$bill->user_id}}</h2>
    <form action="/bill/{{$bill->id}}" method="post">
        {{ csrf_field() }}
        {{ method_field("PUT") }}
        {!! \Nvd\Crud\Form::input('done','boolean')->model($bill)->show() !!}
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@endsection