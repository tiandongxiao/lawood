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
    {
        # 设置中间件
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
        $user = $this->regIfNotExist();
        if(is_null($user))
            return null;

        Auth::login($user);
        return $user;
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
                "type" => "view",
                "name" => "订单中心",
                "url"  => url('wx/orders')
            ],
            [
                "name"       => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "消息中心",
                        "url"  => url('wx/messages')
                    ]
                ],
            ],
        ];
        $menu->add($buttons);
        dd('setting menu OK');
    }

    public function routeUser()
    {
        switch ($this->user->role){
            case 'lawyer':
                if(!$this->user->phone)
                    return view('wechat.auth.basic');
                if(!$this->user->office)
                    return redirect('wechat/profile');
                break;
            case 'client':
                if(!$this->user->phone)
                    return view('wechat.auth.basic');
                break;
        }
        return null;
    }

    # 寻找律师
    public function find()
    {
        $route = $this->routeUser();
        if(!is_null($route))
            return $route;

        return redirect('wechat');
    }
   
    # 订单系统
    public function orders()
    {
        $route = $this->routeUser();
        if(!is_null($route))
            return $route;

        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/orders');
            case 'client':
                return redirect('wechat/client/orders');
            case 'none':
                return view('wechat.visitor.orders');
            default:
                return null;
        }
    }

    public function messages()
    {
        $route = $this->routeUser();
        if(!is_null($route))
            return $route;

        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/notifies');
            case 'client':
                return redirect('wechat/client/notifies');
            case 'none':
                return view('wechat.visitor.notifies');
            default:
                return null;
        }
    }

    public function settings()
    {
        $route = $this->routeUser();
        if(!is_null($route))
            return $route;

        switch ($this->user->role){
            case 'lawyer':
                return redirect('wechat/lawyer/setting');
            case 'client':
                return redirect('wechat/client/setting');
            case 'none':
                return view('wechat.visitor.setting');
            default:
                return null;
        }
    }

    private function regBySubscribe($account)
    {
        $user = User::where('union_id',$account->unionid)->first();

        if(!$user){
            $user = User::create([
                'union_id'  =>  $account->unionid,
                'open_id'   =>  $account->openid,
            ]);
        }

        if(!$user->open_id){
            $user->open_id = $account->openid;
            $user->save();
        }

        return $user;
    }
}
