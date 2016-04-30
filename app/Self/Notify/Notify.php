<?php
namespace App\Self\Notify;

use App\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 30/04/2016
 * Time: 14:12
 */
class Notify
{
    private $app; # 微信应用实例

    public function __construct()
    {
        $this->app = app('wechat');
        $this->notice= $this->app->notice;
    }

    # 发送站内消息
    public function send($user,$data)
    {
        $this->sendNotice($user,$data);         # 发送微信模板消息
        $this->sendNotification($user,$data);   # 发送站内通知消息
    }

    # 构建站内消息
    public function sendNotification($user,$data)
    {
        Log::info('我是站内消息');
        $info = collect();

        switch ($data['type']){
            # 预约咨询通知
            case 'query':
                $info->title   = '预约通知';
                $info->content = '尊敬的咨询用户，预约律师将在12小时内拨打您电话确定此次法律咨询的具体事宜';
                $info->url = url('order/'.$data['order_id']);
                break;

            # 顾客取消预约
            case 'cancel':
                break;

            # 用户付款通知
            case 'payed':
                break;

            # 退款通知
            case 'refund':
                break;

            # 律师接单通知
            case 'accept':
                break;

            # 律师拒单通知
            case 'reject':
                break;

            # 订单完成通知
            case 'complete':
                break;
        }
//
//        $notification = Notification::create([
//            'user_id'  => $user->id,
//            'type'     => $data['type'],
//            'title'    => $data['title'],
//            'content'  => $data['content'],
//            'url'     =>  $data['url']
//        ]);
    }


    # 发送微信模板消息
    public function sendNotice($user,$data)
    {
        //$message = $this->buildNotice($user,$data);
        Log::info('我是微信模板消息');
    }

    # 构建微信模板消息
    public function buildNotice($user,$data)
    {
        $notice = null;

        switch ($data['type']){
            # 预约咨询通知
            case 'query':
                break;

            # 顾客取消预约
            case 'cancel':
                break;

            # 用户付款通知
            case 'payed':
                break;

            # 退款通知
            case 'refund':
                break;

            # 律师接单通知
            case 'accept':
                break;

            # 律师拒单通知
            case 'reject':
                break;

            # 订单完成通知
            case 'complete':
                break;
        }

        return $notice;
    }
}