@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    <section class="lszcdz-main">
        <form id="form" action="{{url('wechat/lawyer/config')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="key" value="home">
            <div class="mar-top-10 clearfix bg-fff-box">
                <div class="top">
                    <input type="tel" class="In-text" placeholder="请输入您的居住区域" id="In-lsdz" name="home">
                    <input type="button" value="取消" class="btn-but">
                </div>
            </div>
            <div class="bottom-btn">
                <div class="blank100"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="确定" id="In-btn" readonly />
                </div>
            </div>
        </form>
    </section>
@stop
@section('script')
    @include('wechat.base.service.gaode')
    <script>
        $(function(){
            var address={
                'type'  : 'input',
                'full'  : null
            };
            // 取消
            $('.btn-but').tap(function(){
                $('#In-lsdz').val('');
            });
            // 表单提交
            $('#In-btn').tap(function(){
                //区域
                if(!$('.In-text').val()){
                    alert('居住区域不能为空');
                    return	false;
                }

                if(address.type =='auto'){
                    $('.In-text').val(address.full);
                }

                $("#form").submit();
            });
            AMap.plugin(['AMap.Autocomplete','AMap.PlaceSearch'],function(){
                var autoOptions = {
                    input: "work-address"
                };
                autocomplete= new AMap.Autocomplete(autoOptions);
                AMap.event.addListener(autocomplete, "select", function(e){
                    var poi = e.poi;
                    address.type = 'auto';
                    address.full = poi.district+poi.address+poi.name;
                    console.log(e);
                });
            });
        })
    </script>
@stop