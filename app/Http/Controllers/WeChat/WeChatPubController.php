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

# 微信公众平台相关操作

class WeChatPubController extends Controller
{
    use WeChatDevTrait;

    private $app;        # 微信实例
    private $broadcast;  # 广播接口
    private $notice;     # 模板消息通知
    
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->broadcast = $app->broadcast;
        $this->notice = $app->notice;

        # 设置中间件
        $this->middleware('wechat.oauth', ['except' => ['serve','menu']]);
    }

    public function register()
    {
        $user = $this->account();
    }

    /**
     * 1 - 如果用户已登录，直接返回登陆用户信息
     * 2 - 如果用户未登录
     *     2.1 如果用户未注册，则注册之，并自动登录
     *     2.2 如果用户已注册，则自动登录此用户
     */
    public function loginUser()
    {
        if(Auth::check()){
            $user = Auth::user();
        }else{
            $user = $this->regIfNotExist();
            Auth::login($user);
        }
        return $user;
    }

    /**
     * 登录并自动导流用户至相关页面
     *
     * @return mixed
     */
    public function login()
    {
        $user = $this->loginUser();

        switch ($user->role){
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
                            $user = $this->regBySubscribe($account);
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
                    $url = '#';
                    $color = '#FF0000';
                    $data = array(
                        'first'      =>  "恭喜您完成注册的第一部分",
                        'keyword1'   =>  $account->nickname,
                        "keyword2"   =>  '刚刚',
                        "keyword3"   =>  $account->nickname,
                        "remark"     =>  "点击 个人中心->设置中心 进行下一步",
                    );

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

    private function sendTplMessage($open_id, $message)
    {
        $userId = $account->openid;
        $templateId = 'MCG5frr7twN4Wl8O8ZgRoMTB_hB61hUhIMeNTsKhJsc';
        $url = url('wx/orders');
        $color = '#FF0000';
        $data = array(
            'first'      =>  "恭喜您完成注册的第一部分",
            'keyword1'   =>  $account->nickname,
            "keyword2"   =>  Carbon::now(),
            "keyword3"   =>  $account->nickname,
            "remark"     =>  "<a href='".$url."'>下一步</a>",
        );
        $messageId = $this->notice->to($userId)->uses($templateId)->andUrl($url)->withColor($color)->data($data)->send();
    }

    # 生成微信公众号菜单
    public function menu()
    {
        $menu = $this->app->menu;

        $buttons = [
            [
                "type" => "view",
                "name" => "找律师",
                "url"  => url('consults')
            ],
            [
                "name"       => "服务中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "客服测试",
                        "url"  => url('wx/pub/reg')
                    ],
                    [
                        "type" => "view",
                        "name" => "一键登录",
                        "url"  => url('wx/pub/login')
                    ],
                    [
                        "type" => "view",
                        "name" => "支付测试",
                        "url"  => url('wxpay/js/1')
                    ],
                ],
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
    }

    
    public function orders()
    {
        $user = $this->loginUser();

        switch ($user->role){
            case 'lawyer':
                return redirect('lawyer/orders');

            case 'client':
                return redirect('client/orders');

            case 'none':
                return redirect('bind/chose');
        }
    }

    public function messages()
    {
        $user = $this->loginUser();

        switch ($user->role){
            case 'lawyer':
                return redirect('lawyer/messages');

            case 'client':
                return redirect('client/messages');

            case 'none':
                return redirect('bind/chose');
        }
    }

    public function settings()
    {
        $user = $this->loginUser();

        switch ($user->role){
            case 'lawyer':
                return redirect('lawyer/settings');

            case 'client':
                return redirect('client/settings');

            case 'none':
                return redirect('bind/chose');
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

    # 微信公众号模板方式进行下一步注册
    public function chose()
    {
        $user = $this->loginUser();
        return redirect('chose');
    }
}
