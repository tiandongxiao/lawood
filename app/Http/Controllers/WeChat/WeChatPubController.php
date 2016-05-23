<?php
namespace App\Http\Controllers\WeChat;


use App\Traits\WeChatDevTrait;
use Carbon\Carbon;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use \Notify;

# 微信公众平台相关操作

class WeChatPubController extends Controller
{
    use WeChatDevTrait;

    private $app;        # 微信实例
    private $broadcast;  # 广播接口
    private $notice;     # 模板消息通知
    private $user;
    
    public function __construct(Application $app)
    {   # 设置中间件
        $this->middleware('wechat.oauth', ['except' => ['serve','menu']]);

        $this->app = $app;
        $this->broadcast = $app->broadcast;
        $this->notice = $app->notice;
        if(!is_null($this->loginUser()))
            $this->user = $this->loginUser();
    }

    /**
     * 1 - 如果用户已登录，直接返回登陆用户信息
     * 2 - 如果用户未登录
     *     2.1 如果用户未注册，则注册之，并自动登录
     *     2.2 如果用户已注册，则自动登录此用户
     */
    public function loginUser()
    {
        if(!Auth::check()){
            $user = $this->regIfNotExist();
            if(is_null($user))
                return null;
            Auth::login($user);
        }
        return Auth::user();
    }

    /**
     * 登录并自动导流用户至相关页面
     *
     * @return mixed
     */
    public function login()
    {
        switch ($this->user->role){
            case 'lawyer':
                break;
            case 'client':
                break;
        }
    }

    # 微信信息处理中心
    public function serve()
    {
        $userApi = $this->app->user;
        $this->app->server->setMessageHandler(function($message) use($userApi){
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    switch ($message->Event) {
                        case 'subscribe':   # 关注事件
                            $account = $userApi->get($message->FromUserName);
                            $this->regBySubscribe($account);
                            Log::info($account->nickname.'关注了我们的公众号');
                            return null;
                            break;

                        default:
                            # code...
                            break;
                    }

                    break;
                case 'text':

                    $time = Carbon::now()->addHour(1);
                    Cache::put('user',$userApi->get($message->FromUserName),$time);
                    $account = $userApi->get($message->FromUserName);

                    //dd($userApi->get($message->FromUserName));

                    $userId = $account->openid;
                    $templateId = 'MCG5frr7twN4Wl8O8ZgRoMTB_hB61hUhIMeNTsKhJsc';
                    $url = "www.baidu.com";
                    $color = '#FF0000';
                    $data = array(
                        'first'      =>  "恭喜您完成注册的第一部分",
                        'keyword1'   =>  $account->nickname,
                        "keyword2"   =>  '刚刚',
                        "keyword3"   =>  $account->nickname,
                        "remark"     =>  url('order/place/'.random_int(1, 5)),
                    );
                    $messageId = $this->notice->to($userId)->uses($templateId)->andUrl($url)->withColor($color)->data($data)->send();
                    return '你好! '.$userApi->get($message->FromUserName)->nickname;
                    break;
                case 'image':
                    # 图片消息...
                    break;
                case 'voice':
                    # 语音消息...
                    break;
                case 'video':
                    # 视频消息...
                    break;
                case 'location':
                    # 坐标消息...
                    break;
                case 'link':
                    # 链接消息...
                    break;
                default:
                    # 其它消息...
                    break;
            }
        });

        return $this->app->server->serve();
    }

//    private function sendTplMessage($open_id, $message)
//    {
//        $userId = $account->openid;
//        $templateId = 'MCG5frr7twN4Wl8O8ZgRoMTB_hB61hUhIMeNTsKhJsc';
//        $url = url('wx/orders');
//        $color = '#FF0000';
//        $data = array(
//            'first'      =>  "恭喜您完成注册的第一部分",
//            'keyword1'   =>  $account->nickname,
//            "keyword2"   =>  Carbon::now(),
//            "keyword3"   =>  $account->nickname,
//            "remark"     =>  "<a href='".$url."'>下一步</a>",
//        );
//        $messageId = $this->notice->to($userId)->uses($templateId)->andUrl($url)->withColor($color)->data($data)->send();
//    }

    # 生成微信公众号菜单
    public function menu()
    {
        $menu = $this->app->menu;

        $buttons = [
            [
                "type" => "view",
                "name" => "找律师",
                "url"  => url('wx/find')
            ],
            [
                "name"       => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "订单中心",
                        "url"  => url('wx/orders')
                    ],
                    [
                        "type" => "view",
                        "name" => "消息中心",
                        "url"  => url('wx/messages')
                    ],
                    [
                        "type" => "view",
                        "name" => "设置中心",
                        "url" => url('wx/settings')
                    ],
                ],
            ],
        ];

        $menu->add($buttons);

        dd('OK');
    }

    public function routeUser()
    {
        switch ($this->user->role){
            case 'lawyer':
                if(is_null($this->user->phone))
                    return view('wechat.auth.lawyer');
                if(is_null($this->user->office))
                    return redirect('wechat/profile');
                break;
            case 'client':
                if(is_null($this->user->phone))
                    return view('wechat.auth.client');
                break;
            case 'none':
                return redirect('wechat/chose');
        }
    }

    public function find()
    {
        $this->routeUser();
        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer');
            case 'client':
                return redirect('wechat/client');
        }
    }
    
    public function orders()
    {
        $this->routeUser();
        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/orders');
            case 'client':
                return redirect('wechat/client/orders');
        }
    }

    public function messages()
    {
        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/notifies');
            case 'client':
                return redirect('wechat/client/notifies');
        }
    }

    public function settings()
    {
        $this->routeUser();
        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/setting');
            case 'client':
                return redirect('wechat/client/setting');
        }
    }

    private function regBySubscribe($account)
    {
        $user = User::where('union_id',$account->unionid)->first();

        if(!$user){
            $user = User::create([
                'union_id'  =>  $account->unionid,
                'open_id'   =>  $account->openid
            ]);
        }

        if(!$user->open_id){
            $user->open_id = $account->openid;
            $user->save();
        }

        return $user;
    }
}
