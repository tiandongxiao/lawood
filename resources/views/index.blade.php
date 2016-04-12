@extends('tpl.base.map')
@section('content')
<div style="position:absolute;top:15%;left: 0px;width:15%;z-index: 1000;">
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        @foreach($nodes as $node)
            @if($node['tab_name']=='ms')
                <li class="active"><a href="#{{$node['tab_name']}}" data-toggle="tab">{{$node['name']}}</a></li>
            @else
                <li><a href="#{{$node['tab_name']}}" data-toggle="tab">{{$node['name']}}</a></li>
            @endif
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($nodes as $node)
            @if($node['tab_name']=='ms')
                <div class="active tab-pane" id="{{$node['tab_name']}}">
                    <ul class="nav nav-divider">
                        @foreach($node['nodes'] as $item)
                            <li><a class="btn btn-warning">{{$item['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="tab-pane" id="{{$node['tab_name']}}">
                    <ul class="nav nav-divider">
                        @foreach($node['nodes'] as $item)
                            <li><a class="btn btn-warning">{{$item['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
    <!-- /.tab-content -->
</div>
</div>
<div id="map" style="width:100%;height:850px;">
</div>
@endsection
@section('script')
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b6f97a31076e886a1236312d87e8b35e"></script>
    <script src="{{URL::asset('/')}}js/app.min.js"></script>
    <script src="{{URL::asset('/')}}js/map.js"></script>
@stop
