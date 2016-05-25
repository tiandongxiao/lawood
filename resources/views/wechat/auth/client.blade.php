@extends('wechat.base.app')
@section('css')
    <style>body{background:#f8f8f8}</style>
@endsection
@section('content')
        <section class="zc-main">
        			<div class="gr-tx te-cen">
                    <label class="label"><img src="/images/tx.png" width="70" height="70" class="tx" id="File_img"><input type="file" class="op-0" id="file_toget"></label>
                    </div>
                    <form  action="{{url('wechat/bind')}}" id="form" method="POST">
						{!! csrf_field() !!}
						<input type="hidden" name="uri" value="{{url('/')}}">
                        <div class="form">
                                <div class="itms">
                                	<div class="f-left">手机号码</div>
                                    <div class="right"><input type="tel" placeholder="有效手机号" class="In-text" id="mobile" name="phone"></div>
                                </div>
                                <div class="itms">
                                	<div class="f-left">验 证 码</div>
                                    <div class="right"><input type="text" placeholder="短信验证码" class="In-text" id="yzm" name="code"></div>
                                	<input type="button" value="获取验证码"  class="btn-yzm" id="btn-yzm"  fs="true" style="display: none">
                                </div>
                        </div>
                        <input type="button" class="In-btn In-btn-1 bg-hui fc-fff" value="立即注册" id="In-btn">
                    </form>
                	<div class="wjmm fc-d2d2d2 line-20 te-cen fs-12">点击［立即注册］代表您已阅读并同意<span  class="fc-03aaf0" id="yhyx">用户使用协议</span></div>
        </section>
        <section class="tc-main" id="zcxy" style="display:none;">
        	<div class="grxy-main">
            	<div class="top">　律屋用户协议</div>
                <div class="con fs-12 line-20">
                     <p>北京律屋有限公司（以下简称“律屋”）在此特别提醒您（用户）在注册成为用户之前，请认真阅读本《用户协议》（以下简称“协议”），确保您充分理解本协议中各条款。请您审慎阅读并选择接受或不接受本协议。除非您接受本协议所有条款，否则您无权注册、登录或使用本协议所涉服务。您的注册、登录、使用等行为将视为对本协议的接受，并同意接受本协议各项条款的约束。</p>
<p>本协议约定律屋与用户之间关于“律屋”软件服务（以下简称“服务”）的权利义务。“用户”是指注册、登录、使用本服务的个人。本协议可由律屋随时更新，更新后的协议条款一旦公布即代替原来的协议条款，恕不再另行通知，用户可在本网站查阅最新版协议条款。在陌陌科技修改协议条款后，如果用户不接受修改后的条款，请立即停止使用陌陌科技提供的服务，用户继续使用陌陌科技提供的服务将被视为接受修改后的协议。</p>
<p> </p>
<h3 class="fw-normal mar-top-10">一、帐号注册</h3>
<p>1、用户在使用本服务前需要注册一个“律屋”帐号。“律屋”帐号应当使用手机号码绑定注册，请用户使用尚未与“律屋”帐号绑定的手机号码，以及未被律屋根据本协议封禁的手机号码注册“律屋”帐号。律屋可以根据用户需求或产品需要对帐号注册和绑定的方式进行变更，而无须事先通知用户。</p>
                </div>
                <div class="bottom" id="xy-back">返回</div>
            </div>
        </section>
@endsection
@section('script')
	<script>
		$(function(){
			var form = false;
			//表单判断
			$('.In-text').bind('input propertychange', function() {
				//form = true;
				//姓名
				if(!$('#name').val()){
					form = false;
					$('#In-btn').removeClass('bg-lan1')
				}else{
					var re = /^.{2,20}$/
					if (!re.test($('#name').val())) {
						form = false;
						$('#In-btn').removeClass('bg-lan1')
					}
				}

				//手机号
				if(!$('#mobile').val()){
					form = false;
					$('#In-btn').removeClass('bg-lan1')
					$('#mobile').parents('.itms').removeClass('itms-ok')
					$('#btn-yzm').parents('.itms').removeClass('itms-ok')
					$('#yzm').val('');
					$('#btn-yzm').hide()
				}else{
					var re = /^1\d{10}$/
					if (!re.test($('#mobile').val())) {
						form = false;
						$('#In-btn').removeClass('bg-lan1')
						$('#mobile').parents('.itms').removeClass('itms-ok')
						$('#btn-yzm').parents('.itms').removeClass('itms-ok')
						$('#yzm').val('');
						$('#btn-yzm').hide()
						return false;
					}
					var address = $('input[name=uri]').val();
					function checkPhone(){
						$.ajax({
							type: 'POST',
							url: address+'/check/phone',
							data: {
								'phone':$('input[name=phone]').val(),
								'_token':$('input[name=_token]').val(),
							},
							success: function(data){
								if(data == 'Y'){
									$('#mobile').parents('.itms').addClass('itms-ok')
									if(!$('#btn-yzm').parents('.itms').hasClass('itms-ok'))
										$('#btn-yzm').show()
									return true;
								}
								form = false;
								$('#In-btn').removeClass('bg-lan1')
								if(!$('#mobile').parents('.itms').hasClass('itms-ok'))
									alert('此号码已被注册');
								return false;
							}
						});
					}
					checkPhone();
				}

				//判断验证码
				if(!$('#yzm').val()){
					form	= false;
					$('#In-btn').removeClass('bg-lan1')
					$('#btn-yzm').parents('.itms').removeClass('itms-ok')
					return false;
				}else{
					var re =  /\d{4}$/
					if (!re.test($('#yzm').val())) {
						form = false;
						$('#In-btn').removeClass('bg-lan1')
						$('#btn-yzm').parents('.itms').removeClass('itms-ok')
						return false;
					}

					var address = $('input[name=uri]').val();
					$.ajax({
						type: 'POST',
						url: address+'/check/code',
						data: {
							'type': 'reg',
							'code':$('input[name=code]').val(),
							'phone':$('input[name=phone]').val(),
							'_token':$('input[name=_token]').val(),
						},
						success: function(data){
							switch (data){
								case 'Y':
									$('#btn-yzm').hide()
									$('#btn-yzm').parents('.itms').addClass('itms-ok')
									form = true;
									$('#In-btn').addClass('bg-lan1')
									return true;
								case 'N':
								case 'E':
									form = false;
									$('#In-btn').removeClass('bg-lan1')
									$('#mobile').parents('.itms').removeClass('itms-ok')
									alert('验证码错误');
									$('#yzm').val('');
									return false;
							}
						}
					})
				}
			});

			//表单提交
			$('#In-btn').tap(function(){
				if(form){
					$("#form").submit();
				}
			})

			//发送验证码
			var	Time	=	60;
			var timer;

			$('#btn-yzm').tap(function(){
				if(!$('#mobile').parents('.itms').hasClass('itms-ok'))
					return false;

				if($('#btn-yzm').attr('fs') == 'true'){
					var address = $('input[name=uri]').val();
					function sendMsg(){
						$.ajax({
							url: address+'/communicate/phone_code',
							data: {
								'phone':$('input[name=phone]').val(),
								'_token':$('input[name=_token]').val(),
								'todo': 'reg'
							},
							success: function(data){
								Time = 60;
								clearTimeout(timer);
								$('#btn-yzm').attr({'fs':'true'})
								$('#btn-yzm').val('再发一次');
								$('#btn-yzm').removeClass('on');
								alert(data.info)
							}
						});
					}
					sendMsg()
					show_Time()
				}
			})

			function show_Time(){ //加时函数
				if(Time == 0){
					$('#btn-yzm').attr({'fs':'true'})
					$('#btn-yzm').val('再发一次');
					$('#btn-yzm').removeClass('on');
				}else{
					$('#btn-yzm').addClass('on');
					$('#btn-yzm').val(Time+'s后重新发送');
					Time--;
					timer = setTimeout(show_Time,1000);
					$('#btn-yzm').attr({'fs':'false'})
				}
			};

			//个人协议
			$('#yhyx').tap(function(){
				$('#zcxy').fadeIn();
			})
			$('#xy-back').tap(function(){
				$('#zcxy').fadeOut();
			})
		})
//H5图像	
$("#file_toget").change(function(){
	var objUrl = getObjectURL(this.files[0]) ;
	console.log("objUrl = "+objUrl) ;
	if (objUrl) {
		$('#File_img').attr({src:objUrl})
	}
}) ;
//建立一個可存取到該file的url
function getObjectURL(file) {
	var url = null ; 
	if (window.createObjectURL!=undefined) { // basic
		url = window.createObjectURL(file) ;
	} else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	} else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}
</script>
@endsection