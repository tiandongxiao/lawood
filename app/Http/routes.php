<?php

Route::group(['prefix' => 'wechat'], function(){
    Route::get('','WeChat\WeChatController@index');
    Route::get('search','WeChat\WeChatController@search');
    Route::get('user/{id}','WeChat\WeChatController@showUser');
    Route::get('logo','WeChat\WeChatController@logo');

    Route::get('order/place/{consult}','WeChat\OrderController@placeOrder');  # 下单返回地点选择列表
    Route::get('order/address/{id}','WeChat\OrderController@selectAddress');  # 绑定选择的地点
    Route::post('order/address','WeChat\OrderController@postSelectAddress');  # 绑定选择的地点
    Route::get('order/receipt/{id}','WeChat\OrderController@receipt');        # 绑定选择的地点
    Route::post('order/receipt','WeChat\OrderController@postReceipt');
    Route::get('order/confirm','WeChat\OrderController@confirm');

    Route::get('order/accept/{id}','WeChat\OrderController@accept');
    Route::get('order/reject/{id}','WeChat\OrderController@reject');
    Route::get('order/cancel/{id}','WeChat\OrderController@cancel');
    Route::get('order/sign/{id}','WeChat\OrderController@sign');
    Route::get('order/complete/{id}','WeChat\OrderController@complete');
    Route::get('order/abandon/{id}','WeChat\OrderController@abandon');

    Route::post('order/evaluate','WeChat\OrderController@evaluate');
    Route::post('order/evaluate/update','WeChat\OrderController@evaluateUpdate');
    Route::get('order/poi/{id}','WeChat\OrderController@showPOI');

    # begin 注册绑定
    Route::get('chose','WeChat\AuthController@chose');
    Route::get('bind/{role}','WeChat\AuthController@bind');
    Route::post('bind','WeChat\AuthController@postBind');
    Route::get('profile','WeChat\AuthController@profile');
    Route::post('profile','WeChat\AuthController@postProfile');
    Route::get('finish','WeChat\AuthController@finish');
    # end 注册绑定

    # begin 咨询用户
    Route::get('client/notifies','WeChat\ClientController@notifies');
    Route::get('client/orders','WeChat\ClientController@orders');
    Route::get('client/order/sign/{id}','WeChat\ClientController@signOrder');
    Route::get('client/setting','WeChat\ClientController@setting');
    Route::get('client/config/{key}','WeChat\ClientController@config');
    Route::post('client/config','WeChat\ClientController@postConfig');
    Route::get('client/collection','WeChat\ClientController@collection');
    # end 咨询用户

    # begin 律师
    Route::get('lawyer/notifies','WeChat\LawyerController@notifies');
    Route::get('lawyer/orders','WeChat\LawyerController@orders');
    Route::get('lawyer/wallet','WeChat\LawyerController@wallet');
    Route::get('lawyer/draw','WeChat\LawyerController@draw');
    Route::post('lawyer/draw','WeChat\LawyerController@postDraw');
    Route::get('lawyer/order/sign/{id}','WeChat\LawyerController@signOrder');
    Route::get('lawyer/setting','WeChat\LawyerController@setting');
    Route::get('lawyer/config/{key}','WeChat\LawyerController@config');
    Route::post('lawyer/config','WeChat\LawyerController@postConfig');
    Route::post('lawyer/start','WeChat\LawyerController@start');
    Route::post('lawyer/stop','WeChat\LawyerController@stop');
    # end 律师
});

Route::group(['prefix' => 'ajax'], function(){
    # 律师 启动||关闭 服务的操作
    Route::post('start','AjaxController@start');
    Route::post('stop','AjaxController@stop');

    # 验证性的 ajax 操作
    Route::post('phone','AjaxController@phone');
    Route::post('sms','AjaxController@sms');
    Route::post('code','AjaxController@code');

    # Notification 读取状态设置
    Route::post('read','NotificationController@read');
    Route::post('unread','NotificationController@unread');

    Route::post('price','AjaxController@price');        # 获取价格信息
    Route::post('evaluate','AjaxController@evaluate');  # 获取评价信息
    Route::post('consult_liked','AjaxController@consult_liked'); # 律师收藏取消收藏操作
    Route::post('receipt','AjaxController@receipt');    # 获取发票信息

});


Route::get('/', 'HomeController@index');
Route::get('flow', 'HomeController@flow');
Route::get('flow_edit', 'HomeController@editFlow');
Route::post('flow_edit', 'HomeController@postEditFlow');
Route::get('about', 'HomeController@about');

# 用户认证系统自带控制器处理
//Route::get('login', 'Auth\AuthController@getPhoneLogin');
//Route::post('login', 'Auth\AuthController@postPhoneLogin');

Route::get('login/email', 'Auth\AuthController@getEmailLogin');
Route::post('login/email', 'Auth\AuthController@postEmailLogin');

Route::get('logout', 'Auth\AuthController@getLogout');

# 用户注册及密码重置
//Route::get('chose', 'Auth\AuthController@getChoseRegRole');
//Route::post('chose', 'Auth\AuthController@postChoseRegRole');
//
//Route::get('register/{role}', 'Auth\AuthController@getPhoneRegister');
//Route::post('register', 'Auth\AuthController@postPhoneRegister');

//Route::get('reset', 'Auth\PasswordController@getPhoneReset');
//Route::post('reset', 'Auth\PasswordController@postPhoneReset');
//
//Route::get('reset/confirm', 'Auth\PasswordController@getPhoneResetConfirm');
//Route::post('reset/confirmed', 'Auth\PasswordController@postPhoneResetConfirm');

//Route::get('email/active/{token}','Auth\AuthController@getActiveEmail');
//Route::get('email/bind/{token}','Auth\BindController@getBindEmailHandler');
//
//Route::get('reg/email', 'Auth\AuthController@getEmailRegister');
//Route::post('reg/email', 'Auth\AuthController@postEmailRegister');
//
//Route::get('reset/email', 'Auth\PasswordController@getEmail');
//Route::post('reset/email', 'Auth\PasswordController@postEmail');
//
//Route::get('reset/email/{token}', 'Auth\PasswordController@getEmailReset');
//Route::post('reset/email/confirmed', 'Auth\PasswordController@postEmailReset');

//Route::group(['prefix' => 'bind'], function(){
//    Route::get('chose','Auth\BindController@getChoseRole');
//    Route::post('chose','Auth\BindController@postChoseRole');
//
//    Route::get('select','Auth\BindController@getBindUser');
//    Route::post('select','Auth\BindController@postBindUser');
//
//    Route::get('exist','Auth\BindController@getBindExistUser');
//    Route::post('exist','Auth\BindController@postBindExistUser');
//
//    Route::get('new','Auth\BindController@getBindNewUser');
//    Route::post('new','Auth\BindController@postBindNewUser');
//
//    Route::get('email', 'Auth\BindController@getBindEmail');
//    Route::post('email', 'Auth\BindController@postBindEmail');
//});

# 微信相关服务接口
Route::group(['prefix' => 'wx'], function() {
    # 微信 <开放平台> 服务接口
    Route::get('reg','WeChat\WeChatOpenController@register');
    Route::get('login','WeChat\WeChatOpenController@login');
    //Route::any('callback','WeChat\WeChatOpenController@callback');
    Route::any('callback','HomeController@callback');

    Route::get('bind','WeChat\WeChatOpenController@bind');
    Route::get('unbind','WeChat\WeChatOpenController@unBind');

    # 微信 <公众平台> 服务接口
    Route::any('serve','WeChat\WeChatPubController@serve');
    Route::get('menu','WeChat\WeChatPubController@menu');
    Route::get('pub/reg','WeChat\WeChatPubController@register');
    Route::get('pub/login','WeChat\WeChatPubController@login');
    Route::get('pub/chose','WeChat\WeChatPubController@chose');
    Route::get('pub/unbind','WeChat\WeChatPubController@unbind');

    Route::get('find', 'WeChat\WeChatPubController@find');
    Route::get('orders', 'WeChat\WeChatPubController@orders');
    Route::get('settings', 'WeChat\WeChatPubController@settings');
    Route::get('messages', 'WeChat\WeChatPubController@messages');
});

Route::group(['prefix' => 'tool'], function(){
    Route::post('cpt_check','ToolsController@captchaCheck');
    Route::get('cpt','ToolsController@getCaptcha');
});

Route::group(['prefix' => 'lawyer'], function(){
    Route::get('','User\LawyerController@board');
    Route::get('show/{id}','User\LawyerController@show');

    Route::get('consults','User\LawyerController@consults');
    Route::get('consult/build','User\LawyerController@buildConsults');

    Route::get('categories','User\LawyerController@categories');                 # 律师服务门类管理
    Route::get('category/bind/{id}','User\LawyerController@bindCategory');       # 绑定新的服务门类
    Route::get('category/unbind/{id}','User\LawyerController@unbindCategory');   # 解绑旧有服务门类

    Route::get('notifies','User\LawyerController@notifies');                     # 登录用户所有通告消息
    Route::get('notify/read','NotificationController@readNotifies');             # 登录用户所有已读通告消息
    Route::get('notify/unread','NotificationController@unreadNotifies');         # 登录用户所有未读通告消息
    
    # Route::resource('location','LocationController');
    Route::get('locations','User\LawyerController@locations');
    Route::get('location/create','User\LawyerController@createLocations');
    Route::post('location/create','User\LawyerController@postCreateLocations');

    Route::get('orders','User\LawyerController@orders');
    Route::get('order/pending','User\LawyerController@pendingOrders');
    Route::get('order/payed','User\LawyerController@payedOrders');
    Route::get('order/completed','User\LawyerController@completedOrders');

    Route::get('wallet','User\LawyerController@bills');
    Route::get('withdraw','User\LawyerController@withdraw');
    Route::get('on','User\LawyerController@startService');
    Route::get('off','User\LawyerController@stopService');
});


Route::group(['prefix' => 'client'], function(){
    Route::get('','User\ClientController@board');

    Route::get('consults','User\ClientController@getConsults');
    Route::get('buy/{id}','User\ClientController@getPlaceOrder');

    Route::get('orders','User\ClientController@orders');
    Route::get('order/pending','User\ClientController@pendingOrders');
    Route::get('order/payed','User\ClientController@payedOrders');
    Route::get('order/completed','User\ClientController@completedOrders');
    Route::get('order/feedback/{id}','User\ClientController@feedback');
    Route::post('order/feedback','User\ClientController@postFeedback');
    Route::get('order/pay/{id}','User\ClientController@payPendingOrder');

    Route::get('notifies','User\ClientController@notifies');     # 登录用户所有通告消息
    Route::get('notify/read','NotificationController@read');     # 登录用户所有已读通告消息
    Route::get('notify/unread','NotificationController@read');   # 登录用户所有未读通告消息
});

Route::group(['prefix' => 'wxpay'], function(){
    Route::post('callback', 'WeChat\WxPayController@callback');    # 微信支付回调处理逻辑
    Route::get('native/{id}', 'WeChat\WxPayController@nativePay'); # 微信扫码支付

    Route::get('js/{id}', 'WeChat\WxPayController@JSPay')->middleware(['wechat.oauth']);  # 微信浏览器内部支付方式 ->middleware(['wechat.oauth'])
    Route::get('refund/{id}','WeChat\WxPayController@refundByOrderNo'); # 微信退款
});

Route::group(['prefix' => 'payment'], function(){
    Route::get('chose/{item_id}', 'User\ClientController@buy');  # 微信扫码支付方式
});

Route::group(['prefix' => 'order'], function(){

    Route::get('pta/{id}','OrderController@pendingToAccepted');  # 测试打桩
    Route::get('accept/{id}','OrderController@accept');
    Route::get('reject/{id}','OrderController@reject');
    Route::get('sign/{id}','OrderController@sign');
    Route::get('refund/{id}','OrderController@refund');

    Route::get('place/{id}','OrderController@placeOrder');  # 顾客下单
    Route::get('cancel/{id}','OrderController@cancel');     # 顾客取消订单
    Route::get('reminder/{id}','OrderController@reminder'); # 顾客催单
});

Route::get('consults','ConsultController@all');

Route::group(['prefix' => 'site'], function(){
    Route::get('','SiteController@board');
    Route::get('php','SiteController@phpInfo');

    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');

    Route::get('user','UserController@index');                                               # 所有用户
    Route::get('user/delete/{id}','UserController@destroy');                                 # 删除用户

    Route::get('perms/{user_id}','UserController@permissions');                              # 用户权限信息
    Route::get('perms/attach/{user_id}/{perm_id}','UserController@attachPermission');        # 授予用户权限
    Route::get('perms/detach/{user_id}/{perm_id}','UserController@detachPermission');        # 解除用户权限

    Route::get('roles/{user_id}','UserController@roles');                                    # 用户角色信息
    Route::get('roles/attach/{user_id}/{role_id}','UserController@attachRole');              # 首页用户角色
    Route::get('roles/detach/{user_id}/{role_id}','UserController@detachRole');              # 解除用户角色

    Route::get('logs', 'SiteController@logs');
    Route::get('settings','SiteController@settings');

    Route::get('lawyers','UserController@lawyers');                                     # 所有律师
    Route::get('lawyers/unapproved','UserController@unapprovedLawyers');                # 未通过审核的律师
    Route::get('lawyers/approved','UserController@approvedLawyers');                    # 通过审核的律师
    Route::get('approve/{id}','UserController@approve');
});

Route::resource('category','CategoryController');
Route::resource('notification', 'NotificationController');
Route::resource('price','PriceController');
Route::resource('receipt','ReceiptController');
Route::resource('bill','BillController');
# Route::resource('pois','PoisController');  # 不会对其直接进行操作，所以注释掉

Route::group(['prefix' => 'test'], function(){
    Route::get('blade','TestController@blade');
});


