@extends('base.master')
@section('content')
    <h3>您已绑定的服务地址</h3>
    <ul class="nav">
        @foreach($locations as $location)
            <li>{{$location->address}}{{$location->type}}
                <a class="btn btn-danger" href="#">删除</a>
                <a class="btn btn-warning" href="">修改</a>
            </li>
            <br/>
        @endforeach
    </ul>
@endsection