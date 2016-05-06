<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 06/05/2016
 * Time: 14:31
 */

namespace App\Traits;

use App\Item;
use App\Pois;

trait ConsultDevTrait
{
    /**
     * 律师提供的所有咨询项
     *
     * @return mixed
     */
    public function consults()
    {
        $consults = $this->user->items;
        return view('lawyer.consult.index',compact('consults'));
    }


    /**
     * 根据用户的选择的分类和地址信息创建所有咨询业务
     *
     * @return mixed
     */
    public function buildConsults()
    {
        $locations = $this->user->locations;
        $categories = $this->user->categories;

        foreach($locations as $location){
            foreach($categories as $category){
                if(!$this->isConsultExist($category->id,$location->id)){
                    $item = Item::create([
                        'user_id'           => $this->user->id,
                        'price' 			=> random_int(10,1000),
                        'sku'				=> uniqid('ITEM_',true),
                        'description'		=> str_random(500),
                        'category_id'       => $category->id,
                        'location_id'       => $location->id
                    ]);

                    $poi = new Pois();
                    $poi->build($location,$category,$item);
                    $item->poi()->save($poi);

                    # 为避免高德云图请求太快出现问题，故让其延迟一些
                    usleep(5);
                }
            }
        }
        return redirect('lawyer/overview');
        # return redirect('test/dc');
    }


    /**
     * 判断律师是否提供了此项咨询业务
     *
     * @param $category_id
     * @param $location_id
     * @return bool
     */
    public function isConsultExist($category_id, $location_id)
    {
        $items = $this->user->items;
        foreach($items as $item){
            if($item->category_id == $category_id && $item->location_id == $location_id)
                return true;
        }
        return false;
    }
}