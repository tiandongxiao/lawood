<?php
/**
 * Created by PhpStorm.
 * User: roger
 * Date: 2016/6/5
 * Time: 22:12
 */

namespace App\Traits;


trait BaiduMapTrait
{
    use RequestDevTrait;

    # 百度地图开发密钥
    private $key = '7c9c55a9631a4a9f64a1e858e81bb2e9';

    # 百度地图操作映射
    private $URI=[
        # 检索API
        'search_around'  => 'http://api.map.baidu.com/place/search',
    ];

    # 百度地图表格映射
    private $tables =[
        'lawyer' => '56fa40c9305a2a3288363151', //用户网站前段显示的地图
        'coffee' => '' //用于后台显示统计律师的地图
    ];

    /**
     * URI公共数据检索 --- 附近检索
     *
     * 示例说明 keywords=阜通东大街&center=116.481471,39.990471&radius=500&filter=type:写字楼&limit=10&page=1
     *
     */
    public function searchPublicAround($condition)
    {
        $params = [
            'location' => $condition['location'],
            'radius'   => $condition['radius'],
            'query'    => $condition['query'],
            'region'   => $condition['region'],
            'output'   => 'html',
            'src'      => 'lawood'
        ];
        $result = $this->makeGetRequest($this->URI['search_around'],$params);
        dd($result);
        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }
}