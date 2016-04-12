@extends('base.master')
@section('content')
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
                    <ul>
                    @foreach($node['nodes'] as $item)
                        <li><a class="btn btn-danger">{{$item['name']}}</a></li>
                    @endforeach
                    </ul>
                </div>
                @else
                <div class="tab-pane" id="{{$node['tab_name']}}">
                    <ul>
                        @foreach($node['nodes'] as $item)
                            <li><a class="btn btn-danger">{{$item['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            @endforeach
        </div>
        <!-- /.tab-content -->
    </div>
@endsection