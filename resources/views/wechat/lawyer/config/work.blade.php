@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lszcdz-main">
        <form id="form" action="{{url('wechat/lawyer/config')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="key" value="work">
            <div class="mar-top-10 clearfix bg-fff-box">
                <div class="top">
                    <input type="text" class="In-text" placeholder="请输入您的单位所在区域" id="In-lsdz" name="work" style="width: 85%;text-align: left">
                    <input type="hidden" name="work-poi" id="work-poi">
                    <input type="button" value="取消" class="btn-but">
                </div>
            </div>
            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定" id="In-btn" readonly>
                </div>
            </div>
        </form>
    </section>
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        var address={
            'type'  : 'input',
            'full'  : null
        };
        $(function(){
            //取消
            $('.btn-but').tap(function(){
                $('#In-lsdz').val('');
            });
            //表单提交
            $('#In-btn').tap(function(){
                //区域
                if(!$('.In-text').val()){
                    alert('工作区域不能为空');
                    return	false;
                }
                if(address.type == 'auto'){
                    $('.In-text').val(address.full);
                }

                $("#form").submit();
            });
            AMap.plugin(['AMap.Autocomplete','AMap.PlaceSearch'],function(){
                var autoOptions = {
                    input: "In-lsdz"
                };
                autocomplete= new AMap.Autocomplete(autoOptions);
                AMap.event.addListener(autocomplete, "select", function(e){
                    var poi = e.poi;
                    address.type = 'auto';
                    address.full = poi.district+poi.address+poi.name;
                    $('#work-poi').val(poi.id);
                    console.log(e);
                });
            });
        })
    </script>
@stop