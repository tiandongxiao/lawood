@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    @inject('category','App\Category')
    <!--默认状态-->
    <section class="zc-main">
        <div class="scly-main pad-10 bg-fff-box">
            <div class="hd">
                @foreach($category->nodes as $node)
                    @if($node['tab_name']=='ms')
                        <div class="itms-hd on">{{$node['name']}}</div>
                    @else
                        <div class="itms-hd">{{$node['name']}}</div>
                    @endif
                @endforeach
            </div>

            <div class="bd">
                @foreach($category->nodes as $node)
                    @if($node['tab_name']=='ms')
                        <div class="itms-bd clearfix show">
                            @foreach($node['nodes'] as $item)
                                @if(Auth::user()->hasCategory($item['id']))
                                    <span class="list on" val="{{$item['id']}}">{{$item['name']}}</span>
                                @else
                                    <span class="list" val="{{$item['id']}}">{{$item['name']}}</span>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="itms-bd clearfix">
                            @foreach($node['nodes'] as $item)
                                @if(Auth::user()->hasCategory($item['id']))
                                    <span class="list on" val="{{$item['id']}}">{{$item['name']}}</span>
                                @else
                                    <span class="list" val="{{$item['id']}}">{{$item['name']}}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <form id="form" action="{{url('wechat/lawyer/config')}}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="key" value="major">
            <div id="select">
            </div>
        </form>
        <div class="bottom-btn">
            <div class="blank100"></div>
            <div class="con te-cen">
                <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定" id="In-btn">
            </div>
        </div>
    </section>
    <!--默认状态-->
@stop
@section('script')
    <script>
        $(function(){
            function updateSelect() {
                $('#select input').remove();
                $('.list.on').each(function () {
                    $('#select').append("<input type='hidden' name='range[]' value='"+$(this).attr('val')+"'/>");
                });
            }
            //切换擅长领域
            $('.itms-hd').tap(function(){
                $('.itms-hd').removeClass('on');
                $(this).addClass('on');
                $('.itms-bd').removeClass('show');
                $('.itms-bd').removeClass('on');
                $('.itms-bd').eq($(this).index()).addClass('on');

            })
            //个数
            $('.list').tap(function(){
                if($('.list.on').size()	> 3){
                    if($(this).attr('class')	==	'list on'){
                        $(this).removeClass('on');
                        $('#num').html($('.list.on').size())
                        updateSelect();
                    }else{
                        alert('最多只能选择4项')
                    }
                }else{
                    $(this).toggleClass('on');
                    $('#num').html($('.list.on').size())
                    updateSelect();
                }
            })

            //表单提交
            $('#In-btn').tap(function(){
                if(form){
                    $("#form").submit();
                }
            })
        })
    </script>
@stop