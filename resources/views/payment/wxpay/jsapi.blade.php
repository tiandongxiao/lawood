@extends('tpl.base.app')
@section('content')
    <div class="text-center"><p style="color:#3c3c3c;font-size:50px">{{$price/100}} 元</p></div>
    <br/>
    <div align="center">
        <button style="width:210px; height:50px; border-radius: 10px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                {!! $params !!},
                function(res){
                    WeixinJSBridge.log(res.err_msg);
                    alert('xixi'+res.err_code+res.err_desc+res.err_msg);
                }
            );
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }
    </script>
@endsection