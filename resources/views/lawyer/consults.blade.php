@extends('tpl.lawyer.app')
@section('content')
    <ul>
    @foreach($consults as $consult)
        <li><a href="/lawyer/consult/{{$consult->id}}">{{$consult->sku}} {{$consult->category->name}}</a></li>
    @endforeach
    </ul>
@endsection