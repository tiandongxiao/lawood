@extends('tpl.base.app')
@section('content')
    <ul>
    @foreach($items as $item)
        @if($item->liked())
        <li>{{$item->category->name}} &nbsp; {{$item->likeCount}} &nbsp;<a class="btn btn-success" href="{{url('test/unlike/'.$item->id)}}">不再收藏</a></li>
        @else
        <li>{{$item->category->name}} &nbsp; {{$item->likeCount}} &nbsp; <a class="btn btn-primary" href="{{url('test/like/'.$item->id)}}">收藏</a></li>
        @endif
    @endforeach
    </ul>
@endsection