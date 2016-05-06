@extends('tpl.lawyer.app')
@section('content')
    <div>
        <h4 class="page-header">目前提供的咨询业务 <span>{{\Illuminate\Support\Facades\Auth::user()->categories()->count()}}/4</span></h4>
        @if(!is_null($binds))
            <ul class="nav-stacked">
                @foreach($binds as $bind)
                    <li><a href="#">{{$bind->name}}</a>  <a class="btn btn-danger" href="{{url('lawyer/category/unbind/'.$bind->id)}}">X</a></li>
                @endforeach
            </ul>
        @endif
    </div>
    <hr/>
    <br/>
    <div>
        <h4 class="page-header">您未提供的咨询业务</h4>
        @if(!is_null($unbinds))
            <ul>
                @foreach($unbinds as $unbind)
                    <li>{{$unbind->name}} <a class="btn btn-danger" href="{{url('lawyer/category/bind/'.$unbind->id)}}">+</a></li>
                @endforeach
            </ul>
        @endif
    </div>
    @if(\Illuminate\Support\Facades\Auth::user()->locations()->count())
        <a class="btn btn-success" href="{{url('lawyer/consult/build')}}">生成地图数据</a>
    @else
        <a class="btn btn-success" href="{{url('lawyer/location/create')}}">添加地址</a>
    @endif
@endsection