@extends('tpl.lawyer.app')
@section('content')
    <h3>{{$consult->category->name}}</h3>
    <p>{{$consult->price}}</p>
@endsection