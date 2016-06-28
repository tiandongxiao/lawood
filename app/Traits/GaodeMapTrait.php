<?php
namespace App\Traits;
/**
 *
 * 高德云存储和高德云检索接口调用
 *
 * User: 王国营
 * Date: 2016/3/29
 * Time: 13:48
 *
 */
use GuzzleHttp\Client;

trait GaodeMapTrait
{
    use RequestDevTrait;

    # 高德地图开发密钥
    private $key = '7c9c55a9631a4a9f64a1e858e81bb2e9';

    # 高德地图操作映射
    private $URI=[
        ################################## 云存储API ####################################
        'create_table'  => 'http://yuntuapi.amap.com/datamanage/table/create',
        'create_item'   => 'http://yuntuapi.amap.com/datamanage/data/create',
        'delete_item'   => 'http://yuntuapi.amap.com/datamanage/data/delete',
        'update_item'   => 'http://yuntuapi.amap.com/datamanage/data/update',

        ################################# 云检索API #####################################
        'search_local'   => 'http://yuntuapi.amap.com/datasearch/local? parameters',
        'search_around'  => 'http://yuntuapi.amap.com/datasearch/around? parameters',
        'search_polygon' => 'http://yuntuapi.amap.com/datasearch/polygon? parameters',
        'search_id'      => 'http://yuntuapi.amap.com/datasearch/id? parameters',
        'search_filter'  => 'http://yuntuapi.amap.com/datamanage/data/list?parameters',

        ################################## URI API #####################################
        'uri_search'   => 'http://m.amap.com/? parameters',
    ];
    
    # 高德地图表格映射
    private $tables =[
        'front' => '56fa40c9305a2a3288363151', //用户网站前段显示的地图
        'admin' => '' //用于后台显示统计律师的地图
    ];

    ######################################### 云存储API ##########################################
    /**
     * 高德云图云存储 --- 添加数据项
     *
     * @param $name
     * @param $address
     * @param $category
     */
    public function addPOI($data)
    {
        $params = [
            'key'=>$this->key,
            'tableid'=>$this->tables['front'],
            'loctype' =>2,
            'data'=>json_encode($data)
        ];
        $result = $this->makePostRequest($this->URI['create_item'],$params);

        if($result->status == 1){
            #成功返回新数据项的id
            return $result->_id;
        }
        dd($result);
        return null;
    }

    /**
     * 高德云图云存储 --- 删除数据项
     *
     * @param $ids
     */
    public function deletePOI($ids)
    {
        $params = [
            'key'=>$this->key,
            'tableid'=>$this->tables['front'],
            'ids' =>$ids
        ];
        $result = $this->makePostRequest($this->URI['delete_item'],$params);

        if($result->status == 1){
            #成功返回删除的条数
            return $result->success;
        }
        return null;
    }

    /**
     * 高德云图云存储 --- 更新数据项
     *
     */
    public function updatePOI($data)
    {
        $params = [
            'key'=>$this->key,
            'tableid'=>$this->tables['front'],
            'loctype' =>2,
            'data'=>json_encode($data)
        ];
        $result = $this->makePostRequest($this->URI['update_item'],$params);

        if($result->status == 1){
            return true;
        }
        return false;
    }

    /**
     * 高德云图云存储 --- 创建新表
     *
     * @param $table_name
     */
    public function createTable($table_name)
    {
        $params = [
            'key'=>$this->key,
            'name'=>$table_name
        ];
        $result = $this->makePostRequest($this->URI['create_table'],$params);

        if($result->status == 1){
            #创建成功，返回新表id
            return $result->_id;
        }
        return null;
    }

    ############################################## 云检索API #########################################
    /**
     * 高德云图云检索 --- ID检索
     *
     * @param $id
     */
    public function searchPOIById($id)
    {
        $params = [
            'key'     => $this->key,
            'tableid' => $this->tables['front'],
            '_id'     => $id
        ];
        $result = $this->makeGetRequest($this->URI['search_id'],$params);

        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }

    /**
     * 高德云图云检索 --- 附近检索
     *
     * 示例说明 keywords=阜通东大街&center=116.481471,39.990471&radius=500&filter=type:写字楼&limit=10&page=1
     *
     */
    public function searchAround($condition)
    {
        $params = [
            'key'      => $this->key,
            'tableid'  => $this->tables['front'],
            'center'   => $condition['center'],
            'redius'   => isset($condition['redius'])?$condition['redius']:null,
            'keywords' => isset($condition['keywords'])?$condition['keywords']:null,
            'filter'   => isset($condition['filter'])?$condition['filter']:null,
            'sortrule' => isset($condition['sortrule'])?$condition['sortrule']:null,
            'limit'    => isset($condition['limit'])?$condition['limit']:null,
            'page'     => isset($condition['page'])?$condition['page']:null
        ];
        $result = $this->makeGetRequest($this->URI['search_around'],$params);

        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }

    /**
     * 高德云图云检索 --- 本地检索
     *
     * 示例说明 city=北京市&keywords= &filter=type:写字楼&limit=50&page=1&key=<用户key>
     *
     */
    public function searchLocal($condition)
    {
        $params = [
            'key'      => $this->key,
            'tableid'  => $this->tables['front'],
            'city'     => $condition['city'],
            'keywords' => isset($condition['keywords'])?$condition['keywords']:'',//必填项
            'filter'   => isset($condition['filter'])?$condition['filter']:null,
            'sortrule' => isset($condition['sortrule'])?$condition['sortrule']:null,
            'limit'    => isset($condition['limit'])?$condition['limit']:null,
            'page'     => isset($condition['page'])?$condition['page']:null
        ];
        $result = $this->makeGetRequest($this->URI['search_local'],$params);

        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }

    /**
     *  高德云图云检索 --- 多边形检索
     *
     *  @param $condition 检索条件
     */
    public function searchPolygon($condition)
    {
        $params = [
            'key'      => $this->key,
            'tableid'  => $this->tables['front'],
            'polygon'  => $condition['polygon'],
            'keywords' => isset($condition['keywords'])?$condition['keywords']:null,
            'filter'   => isset($condition['filter'])?$condition['filter']:null,
            'sortrule' => isset($condition['sortrule'])?$condition['sortrule']:null,
            'limit'    => isset($condition['limit'])?$condition['limit']:null,
            'page'     => isset($condition['page'])?$condition['page']:null
        ];
        $result = $this->makeGetRequest($this->URI['search_polygon'],$params);

        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }

    /**
     * 高德云图云检索 --- 条件过滤检索
     *
     * 示例说明 filter=_name:颐和园+type:公园&limit=10&page=1&key= <用户key>
     */
    public function searchByFilter($condition)
    {
        $params = [
            'key'      => $this->key,
            'tableid'  => $this->tables['front'],
            'filter'   => isset($condition['filter'])?$condition['filter']:null,
            'sortrule' => isset($condition['sortrule'])?$condition['sortrule']:null,
            'limit'    => isset($condition['limit'])?$condition['limit']:null,
            'page'     => isset($condition['page'])?$condition['page']:null
        ];
        $result = $this->makeGetRequest($this->URI['search_filter'],$params);

        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }

    public function searchUri($condition)
    {
        $params = [
            'filter'   => isset($condition['key'])?$condition['key']:null,
            'sortrule' => isset($condition['sortrule'])?$condition['sortrule']:null,
            'limit'    => isset($condition['limit'])?$condition['limit']:null,
            'page'     => isset($condition['page'])?$condition['page']:null
        ];
        $result = $this->makeGetRequest($this->URI['search_filter'],$params);

        if($result->status == 1){
            return $result->datas;
        }
        return null;
    }
}