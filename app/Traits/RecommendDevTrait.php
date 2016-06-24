<?php
/**
 * Created by PhpStorm.
 * User: roger
 * Date: 2016/6/24
 * Time: 15:01
 */

namespace App\Traits;

use App\Item as Consult;


trait RecommendDevTrait
{
    public function enableRecommend($value)
    {
        $this->update([
            'recommend' => true,
            'recommend_value' => $value
        ]);
        $this->updatePOI();
    }

    public function disableRecommend()
    {
        $this->update([
            'recommend' => false,
            'recommend_value' => 0
        ]);
        $this->updatePOI();
    }

    public function setRecommendValue($value)
    {
        
    }
    
}