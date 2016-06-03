@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@stop
@section('content')
    @if($user)
    <section class="lsjs-main" style="padding-bottom:50px;">
        <div class="lsimg te-cen">
            <img src="/images/banner.png" width="100%">
            <p class="name">{{$user->real_name}}</p>
            <p class="sx">律师</p>
        </div>
        <div class="xx">
            <div class="bq clearfix">
                @if($user->categories)
                @foreach($user->categories as $category)
                <span>{{$category->name}}</span>
                @endforeach
                @endif
            </div>
            <div class="fc-bcbcbc mar-top-20">{{$user->office}}</div>
            <div class="fc-bcbcbc line-30">执业证号：{{$user->licence}}</div>
            <div class="nf fc-bcbcbc bor-top">
                <span>执业年限：7年</span>
                <span>约见次数：130次</span>
            </div>
        </div>
        <div class="lsjj">
            <div class="bg-fff-box">
                <div class="te-cen line-40 fc-03aaf0 fs-16">律师简介</div>
                <div class="jj pad-10 fs-12 fc-909090" id="jj-con">    王树德,北京市京师律师事务所律师,全国律师协会会员、北京律师协会会员,北京房产纠纷专业律师。王树德律师曾在中铁房地产集团有限公司、中铁二十二局集团有限公司担任高管,深谙公司管理和运作程序,现仍担任王树德,北京市京师律师事务所律师,全国律师协会会员、北京律师协会会员,北京房产纠纷专业律师。王树德律师曾在中铁房地产集团有限公司、中铁二十二局集团有限公司担任高管,深谙公司管理和运王树德,北京市京师律师事务所律师,全国律师协会会员、北京律师协会会员,北京房产纠纷专业律师。王树德律师曾在中铁房地产集团有限公司、中铁二十二局集团有限公司担任高管,深谙公司管理和运。王树德,北京市京师律师事务所律师,全国律师协会会员、北京律师协会会员,北京房产纠纷专业律师。王树德律师曾在中铁房地产集团有限公司、中铁二十二局集团有限公司担任高管,深谙公司管理和运作程序,现仍担任王树德,北京市京师律师事务所律师,全国律师协会会员、北京律师协会会员,北京房产纠纷专业律师。王树德律师曾在中铁房地产集团有限公司、中铁二十二局集团有限公司担任高管,深谙公司管理和运王树德,北京市京师律师事务所律师,全国律师协会会员、北京律师协会会员,北京房产纠纷专业律师。王树德律师曾在中铁房地产集团有限公司、中铁二十二局集团有限公司担任高管,深谙公司管理和运</div>
            </div>
            <div class="btn-xl"></div>
        </div>

        <div class="khpj mar-top-10 bg-fff-box">
            <div class="te-cen line-40 fc-03aaf0 fs-16">客户评价</div>
            <div class="pad-0-10">
                <div class="itms">
                    <div class="f-left"><img src="/images/ls.jpg" width="50" height="50"></div>
                    <div class="right">
                        <div class="name">
                            <p>七匹狼</p>
                            <div class="pj"><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em></div>
                        </div>
                        <div class="fc-d2d2d2 line-25 fs-12">2016-02-20 14:03</div>
                        <div class="fc-909090 fs-12">王树德,北京市京师律师事务所律师,全国律师协会会员京律师协会会员,北京房产纠纷专业律师。</div>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left"><img src="/images/ls.jpg" width="50" height="50"></div>
                    <div class="right">
                        <div class="name">
                            <p>七匹狼</p>
                            <div class="pj"><em class="on"></em><em class="on"></em><em class="on"></em><em></em><em></em></div>
                        </div>
                        <div class="fc-d2d2d2 line-25 fs-12">2016-02-20 14:03</div>
                        <div class="fc-909090 fs-12">王树德,北京市京师律师事务所律师,全国律师协会会员京律师协会会员,北京房产纠纷专业律师。</div>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left"><img src="/images/ls.jpg" width="50" height="50"></div>
                    <div class="right">
                        <div class="name">
                            <p>七匹狼</p>
                            <div class="pj"><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em></div>
                        </div>
                        <div class="fc-d2d2d2 line-25 fs-12">2016-02-20 14:03</div>
                        <div class="fc-909090 fs-12">王树德,北京市京师律师事务所律师,全国律师协会会员京律师协会会员,北京房产纠纷专业律师。</div>
                    </div>
                </div>
                <div class="itms">
                    <div class="f-left"><img src="/images/ls.jpg" width="50" height="50"></div>
                    <div class="right">
                        <div class="name">
                            <p>七匹狼</p>
                            <div class="pj"><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em><em class="on"></em></div>
                        </div>
                        <div class="fc-d2d2d2 line-25 fs-12">2016-02-20 14:03</div>
                        <div class="fc-909090 fs-12">王树德,北京市京师律师事务所律师,全国律师协会会员京律师协会会员,北京房产纠纷专业律师。</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="yy-footer po-f">
        <div class="itms itms-left">
            <span class="fx"><i>分享</i></span>
            @if(Auth::check() && Auth::user()->role != 'lawyer'))
            <span class="sc" id="sc"><i>收藏</i></span>
            @endif
        </div>
        @if(Auth::check())
            @if(Auth::user()->role != 'lawyer')
                <a class="itms te-cen bg-lan1 fc-fff" href="#" id="In-btn">预约咨询</a>
            @else
                <a class="itms te-cen bg-lan1 fc-fff" href="{{url('wechat')}}">返回首页</a>
            @endif
        @else
        @endif
    </footer>
    @endif
@stop
@section('script')
    <script>
        $(function(){
            //下拉上升
            $(document).on('click','.btn-xl',function(){
                $('#jj-con').removeClass('on1');
                $('#jj-con').addClass('on');
                $(this).attr({class:'btn-ss'})
            });
            $(document).on('click','.btn-ss',function(){
                $('#jj-con').removeClass('on');
                $('#jj-con').addClass('on1');
                $(this).attr({class:'btn-xl'})
            });
            //收藏
            $('#sc').tap(function(){
                $(this).toggleClass('on');
            });
        })
    </script>
@stop