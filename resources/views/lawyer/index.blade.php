@extends('tpl.lawyer.app')
@section('content')
    <div>
        <h4>{{$user->email}}</h4>
        <blockquote>被约见次数：{{$num}}</blockquote>
    </div>
    <div>
        @if($categories)
            @foreach($categories as $category)
                <span class="btn btn-danger"> {{$category->name}} </span>
            @endforeach
        @endif
    </div>
    <hr/>
    <div>
        <h3 class="page-header" style="font-family: '微软雅黑 Light';padding-left: 15px">客户评价</h3>
        @if($comments)
            @foreach($comments as $comment)
                <div class="bg-blue" style="padding: 10px; margin: 10px;">
                <h4 >{{$comment->creator->email}}</h4>
                <p class="pull-right"> {{$comment->created_at}} </p>
                <blockquote>{{$comment->body}}</blockquote>
                </div>
            @endforeach
        @endif
    </div>

@endsection