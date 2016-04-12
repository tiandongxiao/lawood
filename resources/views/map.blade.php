@extends('base.map')
@section('css')
    body{padding:10px;}
    #iCenter{width:100%;height:400px;border:1px solid #F6F6F6;margin:10px 0 0;}
    h1,p{line-height:1.5em;}
    span{float:right;}
@endsection
@section('content')
    <strong>
        <form id="selecttype">
            <input type="radio" name="medicalspecialists" value="旅游" onclick="getType('旅游')"/> 旅游
            <input type="radio" name="medicalspecialists" value="家庭" onclick="getType('家庭')"/> 家庭
        </form>
    </strong>
    <div id="iCenter"></div>
@endsection

@section('script')
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b6f97a31076e886a1236312d87e8b35e"></script>
    <script src="{{URL::asset('/')}}js/app.min.js"></script>
    <script src="{{URL::asset('/')}}js/gd_yun_map.js"></script>
@endsection