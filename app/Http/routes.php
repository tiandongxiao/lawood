<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('map', function () {
    return view('index');
});

Route::get('yun',function(){
    return view('map');
});

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
    Route::get('login','WeChat\AuthWeChatController@wxLogin');
    Route::any('callback','WeChat\AuthWeChatController@wxCallback');
    Route::get('check','WeChat\AuthWeChatController@wxCheck');
    Route::get('bind','WeChat\AuthWeChatController@wxBind');
    Route::get('unbind','WeChat\AuthWeChatController@wxUnBind');

    # 微信 <公众平台> 服务接口
    Route::any('serve','WeChat\AuthWeChatController@serve');
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

# 地图业务服务兴趣点
Route::resource('pois','PoisController');

Route::group(['prefix' => 'lawyer'], function(){
    Route::get('consults','LawyerController@getConsults');
    Route::get('consult/{consult}','LawyerController@displayConsultDetail');
    Route::get('categories','LawyerController@getCategories');
    Route::get('category/add','LawyerController@addCategory');
    Route::get('category/rm/{id}','LawyerController@deleteCategory');
    Route::get('category/new','LawyerController@getUnbindCategories');
    Route::get('locations','LawyerController@getBindLocations');

    Route::get('pending','LawyerController@pendingOrders');
    Route::get('payed','LawyerController@payedOrders');
    Route::get('completed','LawyerController@completedOrders');
});

//Route::resource('category','CategoryController');

Route::group(['prefix' => 'category'], function(){
    # 律师相关
    Route::get('/','LawyerController@getCategories');
    Route::get('bind/{id}','LawyerController@bindCategory');
    Route::get('unbind/{id}','LawyerController@unbindCategory');
});

Route::group(['prefix' => 'consult'], function(){
    Route::get('list','ConsultController@index');
    Route::get('build','ConsultController@building');
});


Route::group(['prefix' => 'client'], function(){
    Route::get('consults','ClientController@getConsults');
    Route::get('buy/{id}','ClientController@getPlaceOrder');

    Route::get('pending','ClientController@pendingOrders');
    Route::get('payed','ClientController@payedOrders');
    Route::get('completed','ClientController@completedOrders');
});

Route::group(['prefix' => 'wxpay'], function(){
    Route::post('callback', 'WeChat\WxPayController@callback');                             # 微信支付回调处理逻辑
    Route::get('native/{id}', 'WeChat\WxPayController@nativePay');
    Route::get('jsapi/{id}', 'WeChat\WxPayController@JSPay')
        ->middleware(['wechat.oauth']); # 微信浏览器内部支付方式

    Route::get('refund/{id}','WeChat\WxPayController@refundByOrderNo');
});

Route::group(['prefix' => 'payment'], function(){
    Route::get('chose/{item_id}', 'ClientController@buy');  # 微信扫码支付方式
});

Route::group(['prefix' => 'order'], function(){
    Route::get('refund/{id}','OrderController@refund');
});

Route::group(['prefix' => 'test'], function(){
    Route::get('put/{key}-{value}','TestController@putValue');
    Route::get('get/{key}','TestController@getValue');
    Route::get('uri','TestController@getUri');
    Route::get('format','TestController@getShopFormat');
    Route::get('pay','TestController@getPayMethod');
    Route::get('cart','TestController@getCart');
    Route::get('items','TestController@addItemIntoCart');
    Route::get('remove/{id}','TestController@removeItem');
    Route::get('place','TestController@getPlaceOrder');
    Route::get('cate','TestController@getMakeCategories');
    Route::get('dc','TestController@drawCategory');
    Route::get('http','TestController@getHttpLocation');
    Route::get('tran','TestController@node');

    Route::get('order','TestController@order');
});