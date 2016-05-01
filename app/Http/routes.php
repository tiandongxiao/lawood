<?php

Route::get('/', 'WebsiteController@index');
Route::get('map', 'WebsiteController@map');
Route::get('about', 'WebsiteController@about');
Route::get('qr_code', 'WebsiteController@regByQrCode');

# 用户认证系统自带控制器处理
Route::get('login', 'Auth\AuthController@getPhoneLogin');
Route::post('login', 'Auth\AuthController@postPhoneLogin');

Route::get('login/email', 'Auth\AuthController@getEmailLogin');
Route::post('login/email', 'Auth\AuthController@postEmailLogin');

Route::get('logout', 'Auth\AuthController@getLogout');

# 用户注册及密码重置
Route::get('chose', 'Auth\AuthController@getChoseRegRole');
Route::post('chose', 'Auth\AuthController@postChoseRegRole');

Route::get('register/{role}', 'Auth\AuthController@getPhoneRegister');
Route::post('register', 'Auth\AuthController@postPhoneRegister');

Route::get('reset', 'Auth\PasswordController@getPhoneReset');
Route::post('reset', 'Auth\PasswordController@postPhoneReset');

Route::get('reset/confirm', 'Auth\PasswordController@getPhoneResetConfirm');
Route::post('reset/confirmed', 'Auth\PasswordController@postPhoneResetConfirm');

Route::get('email/active/{token}','Auth\AuthController@getActiveEmail');
Route::get('email/bind/{token}','Auth\BindController@getBindEmailHandler');

Route::get('reg/email', 'Auth\AuthController@getEmailRegister');
Route::post('reg/email', 'Auth\AuthController@postEmailRegister');

Route::get('reset/email', 'Auth\PasswordController@getEmail');
Route::post('reset/email', 'Auth\PasswordController@postEmail');

Route::get('reset/email/{token}', 'Auth\PasswordController@getEmailReset');
Route::post('reset/email/confirmed', 'Auth\PasswordController@postEmailReset');

Route::group(['prefix' => 'bind'], function(){
    Route::get('chose','Auth\BindController@getChoseRole');
    Route::post('chose','Auth\BindController@postChoseRole');

    Route::get('select','Auth\BindController@getBindUser');
    Route::post('select','Auth\BindController@postBindUser');

    Route::get('exist','Auth\BindController@getBindExistUser');
    Route::post('exist','Auth\BindController@postBindExistUser');

    Route::get('new','Auth\BindController@getBindNewUser');
    Route::post('new','Auth\BindController@postBindNewUser');

    Route::get('email', 'Auth\BindController@getBindEmail');
    Route::post('email', 'Auth\BindController@postBindEmail');
});

# 微信相关服务接口
Route::group(['prefix' => 'wx'], function() {
    # 微信 <开放平台> 服务接口
    Route::get('reg','WeChat\WeChatOpenController@register');
    Route::get('login','WeChat\WeChatOpenController@login');
    Route::any('callback','WeChat\WeChatOpenController@callback');

    Route::get('bind','WeChat\WeChatOpenController@bind');
    Route::get('unbind','WeChat\WeChatOpenController@unBind');

    # 微信 <公众平台> 服务接口
    Route::any('serve','WeChat\WeChatPubController@serve');
    Route::get('menu','WeChat\WeChatPubController@menu');
    Route::get('pub/reg','WeChat\WeChatPubController@register');
    Route::get('pub/login','WeChat\WeChatPubController@login');
    Route::get('pub/chose','WeChat\WeChatPubController@chose');
    Route::get('pub/unbind','WeChat\WeChatPubController@unbind');

    Route::get('orders', 'WeChat\WeChatPubController@orders');
    Route::get('settings', 'WeChat\WeChatPubController@settings');
    Route::get('messages', 'WeChat\WeChatPubController@messages');
});

Route::group(['prefix' => 'tool'], function(){
    Route::post('cpt_check','ToolsController@captchaCheck');
    Route::get('cpt','ToolsController@getCaptcha');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::group(['prefix' => 'communicate'], function(){
    Route::get('phone_code','CommunicationController@sendPhoneCode');
    Route::post('message','CommunicationController@sendMessageByRequest');
});

# 执业地址相关路由
Route::resource('location','LocationController');

Route::group(['prefix' => 'address'], function(){
    Route::get('bind','LocationController@getBindLocation')->middleware(['auth']);
    Route::post('bind','LocationController@postBindLocation');
});

Route::group(['prefix' => 'lawyer'], function(){
    Route::get('center','User\LawyerController@center');

    Route::get('consults','User\LawyerController@getConsults');
    Route::get('consult/{consult}','User\LawyerController@displayConsultDetail');

    Route::get('categories','User\LawyerController@getCategories');
    Route::get('category/add','User\LawyerController@addCategory');
    Route::get('category/rm/{id}','User\LawyerController@deleteCategory');
    Route::get('category/new','User\LawyerController@getUnbindCategories');

    Route::get('locations','User\LawyerController@getBindLocations');

    Route::get('pending','User\LawyerController@pendingOrders');
    Route::get('payed','User\LawyerController@payedOrders');
    Route::get('completed','User\LawyerController@completedOrders');
    Route::get('withdraw','User\LawyerController@withdraw');
});

Route::group(['prefix' => 'category'], function(){
    # 律师相关
    Route::get('/','User\LawyerController@getCategories');             # 律师服务门类管理
    Route::get('bind/{id}','User\LawyerController@bindCategory');      # 绑定新的服务门类
    Route::get('unbind/{id}','User\LawyerController@unbindCategory');  # 解绑旧有服务门类
});

Route::group(['prefix' => 'consult'], function(){
    Route::get('list','ConsultController@index');     # 查看律师所有服务条目
    Route::get('build','ConsultController@build');    # 生成律师所有服务项目
});

Route::group(['prefix' => 'client'], function(){
    Route::get('center','User\ClientController@center');
    Route::get('consults','UserClientController@getConsults');
    Route::get('buy/{id}','User\ClientController@getPlaceOrder');

    Route::get('pending','User\ClientController@pendingOrders');
    Route::get('payed','User\ClientController@payedOrders');
    Route::get('completed','User\ClientController@completedOrders');
});

//Route::resource('category','CategoryController');

Route::group(['prefix' => 'wxpay'], function(){
    Route::post('callback', 'WeChat\WxPayController@callback');    # 微信支付回调处理逻辑
    Route::get('native/{id}', 'WeChat\WxPayController@nativePay'); # 微信扫码支付

    Route::get('js/{id}', 'WeChat\WxPayController@JSPay')
        ->middleware(['wechat.oauth']);  # 微信浏览器内部支付方式

    Route::get('refund/{id}','WeChat\WxPayController@refundByOrderNo'); # 微信退款
});

Route::group(['prefix' => 'payment'], function(){
    Route::get('chose/{item_id}', 'ClientController@buy');  # 微信扫码支付方式
});

Route::group(['prefix' => 'order'], function(){
    Route::get('refund/{id}','OrderController@refund');
    Route::get('accept/{id}','OrderController@accept');
    Route::get('reject/{id}','OrderController@reject');
});

Route::group(['prefix' => 'test'], function(){
    Route::get('c_role/{name}','TestController@createRole');
    Route::get('blade','TestController@blade');
    Route::get('list','TestController@lists');
    Route::get('like/{id}','TestController@like');
    Route::get('unlike/{id}','TestController@unlike');
    Route::get('cate','TestController@getMakeCategories');
    Route::get('dc','TestController@drawCategory');
    Route::get('rate','TestController@ratingUser');
    Route::get('rate_item','TestController@ratingItem');
    Route::get('code','TestController@scanQrCode');
    Route::get('faker','TestController@faker');
    Route::get('cache','TestController@cache');
    Route::get('build','TestController@buildNotifications');
});

Route::group(['prefix' => 'website'], function(){
    Route::get('settings','WebController@settings');
});

// Route::resource('pois','PoisController');    # 地图业务服务兴趣点，不会对其直接进行操作，所以注释掉
Route::resource('role','RoleController');
Route::resource('permission','PermissionController');
Route::resource('place','PlaceController');
Route::resource('notification','NotificationController');

Route::group(['prefix' => 'user'], function(){
    Route::get('/','UserController@index');      # 登录用户所有权限
});

Route::group(['prefix' => 'notify'], function(){
    Route::get('all','NotificationController@all');      # 登录用户所有通告消息
    Route::get('read','NotificationController@read');    # 登录用户所有已读通告消息
    Route::get('unread','NotificationController@read');  # 登录用户所有未读通告消息
});