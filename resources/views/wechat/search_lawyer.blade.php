@extends('wechat.base.app')
@section('content')
    <section class="lstc-main wdsc-main">
        <div class="fjls-main">
            <div class="bg-fff c-main">
                <div class="con">
                    @if($lawyers->count())
                        @foreach($lawyers as $lawyer)
                            <div class="itms">
                                <div class="f-left"><img src="/images/ls.jpg"></div>
                                <div class="right">
                                    <h3 class="chaochu_1"><span class="fc-03aaf0" style="font-size: 16px">{{$lawyer->real_name}}</span>　[律师]</h3>
                                    <p></p>
                                    <p class="mar-top-10" style="font-size: 15px">{{$lawyer->office}}</p>
                                </div>
                                <a class="btn-ckmp" href="#">查看名片</a>
                            </div>
                        @endforeach
                    @else
                        <p class="te-cen mar-top-50">查无此律师</p>
                        <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff line-40 fs-16 margin-bottom"  value="返回" />
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
    <script>
        $('.In-btn').tap(function () {
            window.location.href="/wechat";
        });
    </script>
@stop