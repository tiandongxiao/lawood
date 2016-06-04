@extends('wechat.base.app')
@section('css')
    <style>
        body{background:#f8f8f8}
        .lstc-main {
            background: rgba(88, 88, 88, 0.92);
        }
    </style>
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
            @if(Auth::check() && Auth::user()->role != 'lawyer')
            <span class="sc" id="sc"><i>收藏</i></span>
            @endif
        </div>
        <div class="itms te-cen bg-lan1 fc-fff" href="#" id="In-btn">预约咨询</div>
    </footer>

    <section class="lstc-main" style="display: none">
        <!--律师咨询费-->
        <div class="tc-m lszx-main" style="top: 120px; display: block;">
            <div class="bg-fff c-main" style="overflow: hidden;max-height: 420px;">
                <div class="top">
                    <div class="tie">
                        <span style="font-size: 20px;font-weight: lighter;padding-left: 20px;">咨询费</span>
                        <i class="btn-fjls btn-gb"></i>
                    </div>
                    <div class="xx">
                        <div style="font-size:30px;font-weight: lighter" id="price">{{$user->prices[0]->price}} 元</div>
                        <p class="fs-12 line-15 mar-top-15">见面咨询90分钟</p>
                        <p class="fs-12 line-15 mar-top-5">电话咨询不超过60分钟</p>
                    </div>
                </div>
                <div class="bottom pad-10">
                    <div class="line-35 fc-505050">选择地区</div>
                    <div class="itms-select">
                        <div class="f-left">
                            <select>
                                <option value="local">北京地区</option>
                                <option value="other">其他地区</option>
                            </select>
                        </div>
                        <div class="right chaochu_1">其他地区只能电话咨询</div>
                    </div>
                    <div class="line-35 fc-505050">选择咨询领域</div>
                    <div class="itms-bd-1 clearfix" style="margin-top: -10px;">
                        {!! csrf_field() !!}
                        <input type="hidden" name="uri" value="{{url('/')}}">
                        @foreach($user->prices as $price)
                            @if($price == $user->prices[0])
                                <span class="list-1 on" style="margin-right: 5px" data-price="{{$price->id}}">{{$price->category->name}}</span>
                            @else
                                <span class="list-1" style="margin-right: 5px" data-price="{{$price->id}}">{{$price->category->name}}</span>
                            @endif
                        @endforeach
                    </div>
                    <div class="In-btn In-btn-1 bg-lan1 fc-fff line-40 fs-16 mar-top-20 btn-yjdd">立即咨询</div>
                </div>
            </div>
        </div>
        <!--律师咨询费-->
    </section>
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
            //律师咨询
            $('#In-btn').tap(function(){
                $('.lsjs-main').hide();
                window.location.href="#";
                $('.lstc-main').show();
                $('.tc-m').fadeIn();
            });
            //切换咨询栏目
            $('.list-1').tap(function(){
                $('#price').text("...");
                $('.list-1').removeClass('on');
                $(this).addClass('on');

                var select = $(this).data('price');
                var address = $('input[name=uri]').val();

                $.ajax({
                    type: 'POST',
                    url: address+'/ajax/price',
                    data: {
                        'price' : select,
                        '_token':$('input[name=_token]').val(),
                    },
                    success: function(result){
                        if(result.code == 'Y'){
                            $('#price').text(result.data+" 元");
                            $('#price').fadeIn();
                            return true;
                        }
                        $('#price').text("获取数据失败");
                        $('#price').fadeIn();
                        return false;
                    }
                });
            });
            //
            $('.btn-yjdd').tap(function(){
                $('.lszx-main').css({display:'none'});
                $('.yjdd-main').fadeIn();
            });
            $('.btn-gb').tap(function(){
                $('.lstc-main').fadeOut();
                $('.tc-m').fadeOut();
                $('.lsjs-main').show();
            });
        })
    </script>
@stop