@extends('tpl.admin.app')

@section('content')
    <h2>Bill: {{$bill->user_id}}</h2>
    <ul class="list-group">
        <li class="list-group-item">
            <h4>Id</h4>
            <h5>{{$bill->id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>用户ID</h4>
            <h5>{{$bill->user_id}}</h5>
        </li>
        <li class="list-group-item">
            <h4>是否处理</h4>
            <h5>{{$bill->done}}</h5>
        </li>
        <li class="list-group-item">
            <h4>创建时间</h4>
            <h5>{{$bill->created_at}}</h5>
        </li>
        <li class="list-group-item">
            <h4>更新时间</h4>
            <h5>{{$bill->updated_at}}</h5>
        </li>
    </ul>
@endsection