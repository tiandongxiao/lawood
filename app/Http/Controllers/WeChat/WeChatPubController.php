<?php
namespace App\Http\Controllers\WeChat;


use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

# 微信公众平台相关操作

class WeChatPubController extends Controller
{
    private $app;    # 微信实例
    private $staff;  # 客服接口
    
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->staff = $app->staff;        
    }

    /**
     * 微信登陆页面,只有guest用户可访问
     *
     * @return mixed
     */
    public function register()
    {
        if(!Auth::check()){
            $account = $this->account();
            $user = User::where('wx_id', $account->union_id)->first();
            if(!$user){
                User::create([
                    'union_id' => $account->union_id,
                    'open_id'  => $account->open_id,
                    'role'     => 'none'
                ]);
            }
        }
        return redirect('/');
    }

    /**
     * 微信登陆页面,只有guest用户可访问
     *
     * @return mixed
     */
    public function login()
    {
        return  Socialite::driver('wechat')->redirect();
    }

    /**
     * 用户绑定微信入口，此方法只有auth用户可访问
     *
     * @return mixed
     */
    public function bind()
    {
        return  Socialite::driver('wechat')->redirect();
    }

    /**
     * 解除微信绑定
     *
     * @param Request $request
     */
    public function unBind(Request $request)
    {
        $user = $request->user();
        $user->wx_id = null;
        return back()->withErrors('微信已解除绑定');
    }

    # 微信信息处理中心
    public function serve()
    {
        $userApi = $this->app->user;
        $this->app->server->setMessageHandler(function($message) use($userApi){
            switch ($message->MsgType) {
                case 'event':
                    # 事件消息...
                    break;
                case 'text':
                    # return '你好! '.$userApi->get($message->FromUserName)->nickname;
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
                "url"  => url('consults')
            ],
            [
                "name"       => "服务中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "注册",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
            [
                "name"       => "个人中心",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "订单中心",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "消息中心",
                        "url"  => url('')
                    ],
                    [
                        "type" => "view",
                        "name" => "个人设置",
                        "url" => url('website/about')
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
    }

    public function account()
    {
        $user = session('wechat.oauth_user');
        $account = collect();
        $account->open_id = $user->getId();
        $account->union_id = $user->original['unionid'];
        return $user;
    }
}
