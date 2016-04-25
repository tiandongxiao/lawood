@extends('tpl.base.app')
@section('content')
    <div class="text-center">
        <h3>扫码查看律师名片</h3>

        {!! QrCode::encoding('UTF-8')->size(400)->generate($url) !!}
        <hr/>
    </div>
@endsection