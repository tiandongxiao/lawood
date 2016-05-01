<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Pois;

class ConsultController extends Controller
{
    # 律师所有私有咨询业务
    public function index()
    {
        $items = Auth::user()->items;        
        return view('consult.index',compact('items'));
    }

    # 创建新的咨询业务
    public function create()
    {
        $locations = Auth::user()->locations;
        $categories = Auth::user()->categories;

        return view('consult.create',compact('locations','categories'));
    }

    # 保存逻辑
    public function store(Request $request)
    {
        $category =  Category::find($request->get('category'));
        $location =  Location::find($request->get('location'));

        $item = Item::create([
            'user_id'           => Auth::user()->id,
            'price' 			=> random_int(100,200),
            'sku'				=> str_random(15),
            'description'		=> str_random(500),
            'category_id'       => $category->id,
            'location_id'       => $location->id
        ]);

        $poi = new Pois();
        $poi->build($location,$category,$item);

        $item->poi()->save($poi);
    }

    # 显示一条consult详细信息
    public function show($id)
    {
        $consult = Item::findOrFail($id);
        return view('consult.show');
    }

    # 编辑律师咨询
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('consult.update',compact($item));
    }

    # 更新律师咨询
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
    }

    # 删除律师咨询
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
    }

    # 根据用户的选择的分类和地址信息创建所有咨询业务
    public function build()
    {
        $user  = Auth::user();

        $locations = $user->locations;
        $categories = $user->categories;

        foreach($locations as $location){
            foreach($categories as $category){
                # 如果不存在此咨询服务项时，创建此服务项
                if(!$this->isExist($category->id,$location->id))
                {
                    $item = Item::create([
                        'user_id'           => $user->id,
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
                    usleep(10);
                }
            }
        }
        return redirect('test/dc');
    }

    # 判断律师是否提供了此项咨询业务
    public function isExist($category_id,$location_id)
    {
        # 在当前律师所有服务项中查找有没有提供此项服务
        $items = Auth::user()->items;

        foreach($items as $item){
            if($item->category_id == $category_id && $item->location_id == $location_id){
                Log::info('This item is EXIST ');
                return true;
            }
        }

        Log::info('This item is NOT-EXIST ');
        return false;
    }
}
