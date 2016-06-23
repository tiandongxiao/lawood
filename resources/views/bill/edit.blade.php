@extends('tpl.admin.app')
@section('content')
    <h2>设置账单是否完成: {{$bill->name}}律师的提款申请</h2>
    <p>提款金额：{{$bill->amount}}</p>
    <form action="/bill/{{$bill->id}}" method="post">
        {{ csrf_field() }}
        {{ method_field("PUT") }}
        {!! \Nvd\Crud\Form::input('done','bool')->model($bill)->show() !!}
        <button type="submit" class="btn btn-default">设置</button>
    </form>
@endsection