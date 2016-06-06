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

                        if(res.err_msg == "get_brand_wcpay_request:ok"){
                            window.location.href="{{url('/')}}";
                        }else{
                            alert('xixi'+res.err_code+res.err_desc+res.err_msg);
                        }
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