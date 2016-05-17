@extends('wechat.base.client')
@section('content')

<section class="lvzy-main">
    <h3 class="tie">您附近有<font class="fc-03aaf0">103</font>名律师</h3>
    <p class="sx">输入有<font class="fc-03aaf0">律师姓名</font>或者有<font class="fc-03aaf0">您的位置</font>即可快速查找</p>

    <form>
        <a class="itms-form" href="#">
            <span  class="In-text" >我的位置</span>
        </a>

        <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10 fs-16" value="找律师" id="In-btn">
    </form>

    <div class="line-30 pad-0-10 fc-909090 mar-top-30">推荐律师</div>
    <div class="tjls pad-0-10 clearfix">
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
        <div class="itms">
            <div class="img"><img src="/images/ls.jpg" width="100%"></div>
            <p>1.4km</p>
        </div>
    </div>

</section>
@stop
@section('script')
    <script>
        $(function(){

            $('#In-btn').click(function () {
                window.location.href="/wechat/client/search";
            });
        })
    </script>
@stop
