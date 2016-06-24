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
    private $city;
    private $major;

    public function getCity()
    {

    }

    public function getMajor()
    {

    }

    public function getRecommendsAttribute()
    {

        Consult::where('city','');
    }
}