@extends('wechat.base.app')
@section('content')
@stop
@section('script')
    <script>
        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
                    {!! $params !!},
                    function(res){
                        WeixinJSBridge.log(res.err_msg);
                        switch (res.err_msg){
                            //支付成功
                            case "get_brand_wcpay_request:ok":
                                window.location.href="/wechat/client/orders";
                                break;
                            //取消支付
                            case "get_brand_wcpay_request:cancel":
                                window.location.href="/wechat";
                                break;
                            default:
                                alert("支付失败");
                                window.location.href="/wechat";
                                break;
                        }
                        return null;
                    }
            );
        }

        function pay()
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

        $(function(){
            pay();
        });
    </script>
@stop