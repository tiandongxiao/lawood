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
                    <input type="tel" class="In-text" placeholder="请输入您的居住区域" id="In-lsdz" name="work">
                    <input type="button" value="取消" class="btn-but">
                </div>
                <div class="con" id="btn-lsdz">
                    <div class="itms" data-sx="北京京师律师事务所1">
                        <h3 class="chaochu_1">北京京师律师事务所</h3>
                        <p class="chaochu_1">雍和宫大街于安定门东大街交叉口</p>
                    </div>
                    <div class="itms" data-sx="北京京师律师事务所2">
                        <h3 class="chaochu_1">北京京师律师事务所</h3>
                        <p class="chaochu_1">雍和宫大街于安定门东大街交叉口</p>
                    </div>
                    <div class="itms" data-sx="北京京师律师事务所3">
                        <h3 class="chaochu_1">北京京师律师事务所</h3>
                        <p class="chaochu_1">雍和宫大街于安定门东大街交叉口</p>
                    </div>
                    <div class="itms" data-sx="北京京师律师事务所4">
                        <h3 class="chaochu_1">北京京师律师事务所</h3>
                        <p class="chaochu_1">雍和宫大街于安定门东大街交叉口</p>
                    </div>
                    <div class="itms" data-sx="北京京师律师事务所5">
                        <h3 class="chaochu_1">北京京师律师事务所</h3>
                        <p class="chaochu_1">雍和宫大街于安定门东大街交叉口</p>
                    </div>
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
    <script>
        $(function(){
            //切换默认
            $('#btn-lsdz .itms').tap(function(){
                $('#In-lsdz').val($(this).attr('data-sx'));
            })
            //取消
            $('.btn-but').tap(function(){
                $('#In-lsdz').val('');
            })

            //表单提交
            $('#In-btn').tap(function(){
                //区域
                if(!$('.In-text').val()){
                    alert('居住区域不能为空')
                    return	false;
                }
                $("#form").submit();
            })
        })
    </script>
@stop