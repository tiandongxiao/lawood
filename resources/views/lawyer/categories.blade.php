@extends('tpl.lawyer.app')
@section('content')
    <div>
        <h3 class="page-header">目前提供的咨询业务</h3>
        @if(!is_null($binds))
            <ul class="nav-stacked">
                @foreach($binds as $bind)
                    <li><a href="#">{{$bind->name}}</a>  <a class="btn btn-danger" href="{{url('category/unbind/'.$bind->id)}}">X</a></li>
                @endforeach
            </ul>
        @endif
    </div>
    <div>
        <h3 class="page-header">您未提供的咨询业务</h3>
        @if(!is_null($unbinds))
            <ul>
                @foreach($unbinds as $unbind)
                    <li>{{$unbind->name}} <a class="btn btn-danger" href="{{url('category/bind/'.$unbind->id)}}">+</a></li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection