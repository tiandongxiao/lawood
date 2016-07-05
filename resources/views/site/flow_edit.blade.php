<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>律屋</title>
        <meta name="keywords" content="律屋">
        <meta name="description" content="律屋">
        <link rel="shortcut fa" href="favfa.png">
        <LINK href="/css/pc_global.css" rel="stylesheet" type="text/css">
        <LINK href="/css/pc_css.css" rel="stylesheet" type="text/css">
    </head>
    <body style="background:#ececec">
    <div class="nav">
        <div class="w1250 ">
            <div class="logo"><img src="images/logo_pc.png" width="250" height="100"></div>
            <div class="f-right">
                <a href="/" class="itms">首页</a>
                <a href="/flow" class="itms on">律师人口</a>
                <a href="/about" class="itms">关于律屋</a>
            </div>
        </div>
    </div>
    <div class="banner-rk"></div>

    <div class="list-bj">
        <div class="w1250 relative">
            @if(Auth::check())
            <div class="tx"><img style="border-radius: 100%" src="{{Auth::user()->avatar}}" width="211" height="213"></div>
            <div class="name">{{Auth::user()->real_name}}</div>
            <div class="js">{{Auth::user()->office}}</div>
                @if($editable)
                    <form action="{{url('flow_edit')}}" method="post" style="margin-top: 40px;display: none" id="content">
                        {!! csrf_field() !!}
                        <textarea name="desc" style="width: 85%;min-height: 250px;border: dotted 1px chocolate" >{{Auth::user()->description}}</textarea>
                        <input type="submit"  class="btn-bj" value="提交" style="margin-top: 45px">
                    </form>
                @else
                    <div class="jj">{!! Auth::user()->description !!}</div>
                    <a href="{{url('flow_edit'.'?editable=y')}}" class="btn-bj">编辑资料</a>
                @endif
            @endif
            <a href="#" class="btn-prev huandong" style="display: none"></a>
            <a href="#" class="btn-next huandong" style="display: none"></a>
        </div>
    </div>
    <div class="footer">
        <p><span>Tel:123456789</span>　　<span>Emil:123456789@qq.com</span></p>
        <p>北京律屋网络服务有限公司</p>
    </div>
    @if($editable)
        <script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js" type="text/javascript"></script>
        <script>
            $(function(){
                tinymce.init({ selector:'textarea',language_url : '/js/zh_CN.js'});
                $('#content').show();
            })
        </script>
    @endif
    </body>
</html>
