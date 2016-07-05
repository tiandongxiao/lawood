<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>律屋</title>
        <meta name="keywords" content="律屋">
        <meta name="description" content="律屋">
        <link rel="shortcut fa" href="favfa.png">
        <link href="/css/pc_global.css" rel="stylesheet" type="text/css">
        <link href="/css/pc_css.css" rel="stylesheet" type="text/css">
        <style>
            .list-lc .itms .unblank {
                width: 127px;
                height: 1px;
                position: absolute;
                left: 166px;
                top: 75px;
                background: rgba(216, 134, 11, 0.81);
            }
            .list-zc-tie	P {
                font-size: 16px;
                color: rgba(226, 0, 0, 0.64);
                line-height: 50px;
            }
        </style>
    </head>
    <body>
        <div class="nav">
            <div class="w1250">
                <div class="logo"><img src="images/logo_pc.png" width="250" height="100"></div>
                <div class="f-right">
                    <a href="/" class="itms">首页</a>
                    <a href="/flow" class="itms on">律师人口</a>
                    <a href="/about" class="itms">关于律屋</a>
                </div>
            </div>
        </div>
        <div class="banner-rk">
        </div>
        <div class="list-zc-tie">
            <h3>律师注册流程</h3>
            <p>目前仅针对北京律师开放注册</p>
        </div>
        <div class="list-lc">
            <div class="itms">
                <img src="images/16.png" class="img2">
                <p>微信扫码</p>
                <i class="unblank"></i>
            </div>
            <div class="itms">
                <img src="images/17.png" class="img2">
                <p>填写基本资料</p>
                <i class="unblank"></i>
            </div>
            <div class="itms">
                <img src="images/18.png" class="img2">
                <p>律屋审核</p>
                <i class="unblank"></i>
            </div>
            <div class="itms">
                <img src="images/19.png" class="img2">
                <p>拍照</p>
                <i class="unblank"></i>
            </div>
            <div class="itms">
                <img src="images/200.png" class="img2">
                <p>上线</p>
            </div>
        </div>
        <div class="list-phone">
            <div class="itms">
                <p class="top">律师注册</p>
                <div class="ewm"><img src="images/lawood.jpg" width="226px" height="221px"></div>
                <div class="bottom">扫一扫，马上注册律师</div>
            </div>
            <div class="itms">
                <p class="top">修改简介</p>
                <div class="ewm btn-wx"><img src="images/click.png" width="226px" height="221px"></div>
                <div class="bottom btn-wx">点一点，扫码后改资料</div>
            </div>
        </div>
        <div class="footer">
            <p><span>Tel:123456789</span>　　<span>Emil:123456789@qq.com</span></p>
            <p>北京律屋网络服务有限公司</p>
        </div>
        <script src="//cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
        <script>
            $(function(){
                $('.btn-wx').click(function () {
                    @if(Auth::check())
                    window.location.href="/flow_edit";
                    @else
                    window.location.href="/wx/login";
                    @endif
                });
            })
        </script>
    </body>
</html>
