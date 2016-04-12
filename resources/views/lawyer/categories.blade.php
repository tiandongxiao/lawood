@extends('base.master')
@section('content')
    <ul class="nav-stacked">
    @foreach($categories as $category)
        <li><a href="#">{{$category->name}}</a>  <a href="{{url('lawyer/category/rm/'.$category->id)}}">X</a></li>
    @endforeach
    </ul>
    <div>
        <a class="btn btn-lg btn-warning" href="{{url('lawyer/category/add')}}">
            添加新的咨询业务
        </a>
    </div>
    <div>
        <h3>您未提供的咨询业务</h3>
        <ul>
        @foreach($unbinds as $unbind)
            <li>{{$unbind->name}}</li>
        @endforeach
        </ul>
    </div>
@endsection