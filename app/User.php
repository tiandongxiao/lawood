<?php

namespace App;

use Amsgames\LaravelShop\Traits\ShopUserTrait;

use App\Traits\UserAnalysisTrait;


use DraperStudio\Commentable\Contracts\Commentable;
use DraperStudio\Commentable\Traits\Commentable as CommentTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;




class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    HasRoleAndPermissionContract,
                                    Ratingable,
                                    Commentable

{
    use Authenticatable, CanResetPassword, ShopUserTrait, HasRoleAndPermission, Authorizable , RatingTrait,CommentTrait, UserAnalysisTrait{
        # 为解决冲突的问题
        HasRoleAndPermission::can insteadof Authorizable;
        Authorizable::can as may;
    }

    protected $table = 'users';
    protected $fillable = ['name', 'real_name', 'phone', 'email', 'active', 'enable' ,'avatar', 'role', 'union_id', 'open_id', 'password'];
    protected $hidden = ['password', 'remember_token'];

    # 一个律师可以拥有多个地址，以便于其扩展业务，地址信息独有不共享
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    # 一个律师可以拥有多个执业范围
    public function categories()
    {
        return $this->belongsToMany(Category::class,'user_category');
    }

    # 律师个人档案
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    # 用户与通告消息是一对多的关系
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    # 价格策略，为提升效率权宜之法
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public static function findRequested()
    {
        $query = User::query();
        
        # 根据用户输入搜索信息
        Request::input('name') and $query->where('name','like','%'.Request::input('name').'%');
        Request::input('phone') and $query->where('phone',Request::input('phone'));
        Request::input('email') and $query->where('email','like','%'.Request::input('email').'%');
        Request::input('union_id') and $query->where('union_id','like','%'.Request::input('union_id').'%');
        Request::input('open_id') and $query->where('open_id','like','%'.Request::input('open_id').'%');

        # 对结果进行分页
        return $query->paginate(15);
    }

    public function delete()
    {
        foreach ($this->categories as $category){
            $this->categories()->detach($category->id);
        }

        foreach ($this->consults as $consult){
            $consult->deletePOI();
        }

        $this->prices()->delete();
        $this->notifications()->delete();

        $this->locations()->delete();
        $this->comments()->delete();
        $this->timing()->delete();
        $this->dressing()->delete();
        $this->polite()->delete();
        $this->profile()->delete();

        parent::delete();
    }

    public function getOfficeAttribute()
    {
        if (is_null($this->profile))
            return null;
        return $this->profile->office;
    }

    public function setOfficeAttribute($office)
    {
        $this->profile->office = $office;
        $this->profile->save();
    }

    public function getDescriptionAttribute()
    {
        if (is_null($this->profile))
            return null;
        return $this->profile->description;
    }
    
    public function setIntroductionAttribute($desc)
    {
        $this->profile->description = $desc;
        $this->profile->save();
    }

    public function setHomeAttribute($address)
    {
        $home = $this->locations()->where('type','home')->first();

        if($home){
            $home->updateInfo(['address'=>$address]);
        }else{
            $home = Location::create([
                'type'    => 'home',
                'address' => $address
            ]);
            $this->locations()->save($home);
        }
    }

    public function setWorkAttribute($address)
    {
        $work = $this->locations()->where('type','work')->first();

        if($work){
            $work->updateInfo(['address'=>$address]);
        }else{
            $work = Location::create([
                'type'    => 'work',
                'address' => $address
            ]);
            $this->locations()->save($work);
        }
    }

    public function getHomeAddressAttribute()
    {
        $home = $this->locations()->where('type','home')->first();
        if($home)
            return $home->address;
        return null;
    }

    public function getWorkAddressAttribute()
    {
        $work = $this->locations()->where('type','work')->first();
        if($work)
            return $work->address;
        return null;
    }

    public function getHomeAttribute()
    {
        $home = $this->locations()->where('type','home')->first();
        if($home)
            return $home;
        return null;
    }

    public function getWorkAttribute()
    {
        $work = $this->locations()->where('type','work')->first();
        if($work)
            return $work;
        return null;
    }

    public function getLicenceAttribute()
    {
        if (is_null($this->profile))
            return null;
        return $this->profile->licence;
    }

    public function setLicenceAttribute($licence)
    {
        $this->profile->licence = $licence;
        $this->profile->save();
    }

    # 构建律师建模信息
    public function buildLawyer()
    {
        # building the profile
        if(is_null($this->profile))
            Profile::create(['user_id'=>$this->id]);

        # build dressing rating
        if(is_null($this->dressing))
            UserDressing::create(['user_id'=>$this->id]);

        # build timing rating
        if(is_null($this->timing))
            UserTiming::create(['user_id'=>$this->id]);

        # build polite rating
        if(is_null($this->polite))
            UserPolite::create(['user_id'=>$this->id]);
    }

    # 增加一个新的业务类别
    public function bindCategory($id)
    {
        $count = $this->categories()->count();
        if( $count < 4) {
            $category = Category::findOrFail($id);
            if (!$this->hasCategory($category->id)) {
                $this->categories()->attach($category->id);
                $this->buildPrice($category->id); # 增加价格调整策略
                return 'SUCCESS';
            }
            return 'REPEAT';
        }
        return 'FAIL';
    }

    # 删除某个业务类别
    public function unbindCategory($id)
    {
        if($this->hasCategory($id)){
            # 当律师删除一个业务门类时，将相关的业务咨询服务都删除
            $consults = $this->consults;
            if(!is_null($consults)) {
                foreach ($consults as $consult) {
                    if ($consult->category_id == $id)
                        $consult->delete();
                }
                $this->categories()->detach($id);
                $this->deletePrice($id);   # 删除价格策略
                return true;
            }
        }
        return false;
    }

    # 判断是否有某个业务类别
    public function hasCategory($cate_id)
    {
        foreach($this->categories as $category){
            if($category->id == $cate_id)
                return true;
        }
        return false;
    }

    # 获取当前律师没有提供的业务范围
    public function getUnbindCategories()
    {
        $unbinds = [];
        $categories = Category::all();

        foreach($categories as $category){
            if($category->level == 3 && !$this->hasCategory($category->id)){
                $unbinds[] = $category;
            }
        }
        return $unbinds;
    }

    public function updateCategories($range)
    {
        foreach ($this->categories as $category){
            if(!in_array($category->id, $range)){
                $this->unbindCategory($category->id);
            }
        }
        foreach ($range as $cate_id){
            if(!$this->hasCategory($cate_id)){
                $this->bindCategory($cate_id);
                foreach($this->locations as $location){
                    if(!$this->isConsultExist($cate_id,$location->id)){
                        Item::createConsult([
                            'user_id'           => $this->id,
                            'price' 			=> 500,
                            'sku'				=> uniqid('ITEM_'),
                            'description'		=> str_random(500),
                            'category_id'       => $cate_id,
                            'location_id'       => $location->id
                        ]);
                    }
                }
            }
        }
    }

    # 律师获取自己所有的服务项
    public function getConsultsAttribute()
    {
        # 卖方商品项是不从属于任何Order订单的,没有这个属性
        $consults = Item::where('order_id',null)->where('user_id',$this->id)->get();
        return $consults;
    }

    public function getConsultByCategory($cate_id)
    {
        foreach ($this->consults as $consult){
            if ($consult->category->id == $cate_id)
                return $consult;
        }
    }

    /**
     * 根据用户的选择的分类和地址信息创建所有咨询业务
     */
    public function buildConsults()
    {
        foreach($this->locations as $location){
            foreach($this->categories as $category){
                if(!$this->isConsultExist($category->id,$location->id)){
                    Item::createConsult([
                        'user_id'           => $this->id,
                        'price' 			=> 500,
                        'sku'				=> uniqid('ITEM_'),
                        'description'		=> str_random(500),
                        'category_id'       => $category->id,
                        'location_id'       => $location->id
                    ]);
                }
            }
        }
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
        $consults = $this->consults;
        foreach($consults as $consult){
            if($consult->category_id == $category_id && $consult->location_id == $location_id)
                return true;
        }
        return false;
    }

    # 判断是否有此类别价格策略
    public function hasPrice($cate_id)
    {
        foreach ($this->prices as $price){
            if($price->category_id == $cate_id)
                return true;
        }
        return false;
    }

    public function getPrice($cate_id)
    {
        foreach ($this->prices as $price){
            if($price->category_id == $cate_id)
                return $price;
        }
        return null;
    }

    # 构建类别的价格策略
    public function buildPrice($cate_id)
    {
        if(!$this->hasPrice($cate_id)){
            $price = Price::create([
                'category_id' => $cate_id,
                'price'       => 500
            ]);
            $this->prices()->save($price);
        }
    }


    public function updatePrice($cate_id,$value)
    {
        $price = $this->getPrice($cate_id);
        if($price){
            foreach ($this->consults as $consult){
                if($consult->category->id == $cate_id && $consult->price != (int)$value){
                    $consult->updatePrice($value);
                    $price->update(['price'=>$value]);
                }
            }
        }
    }

    # 删除类别的价格策略
    public function deletePrice($cate_id)
    {
        if($this->hasPrice($cate_id)){
            foreach ($this->prices as $price) {
                if ($price->category_id == $cate_id)
                    $price->delete();
            }
        }
    }

    # 开启服务
    public function start()
    {
        if(!$this->active || !$this->consults)
            return false;

        # 设置启动标志位
        $this->update(['enable'=>true]);

        # 更新所有consults，将其信息推送至高德地图
        foreach ($this->consults as $consult){
            $consult->buildPOI();
            # 为避免高德云图请求太快出现问题，故让其延迟一些
            usleep(1);
        }

        return true;
    }

    # 关闭服务
    public function stop()
    {
        if(!$this->active || !$this->consults)
            return false;

        # 设置启动标志位
        $this->update(['enable'=>false]);

        # 更新所有consults，将其信息从高德地图中清除
        foreach ($this->consults as $consult){
            $consult->deletePOI();
            # 为避免高德云图请求太快出现问题，故让其延迟一些
            usleep(1);
        }

        return true;
    }

    public function getStatusAttribute()
    {
        switch ($this->role){
            case 'lawyer':
                return $this->active?'认证律师':'审核中';
            case 'client':
                return '咨询用户';
            case 'none':
                return '游客';
        }
    }

    public function getSellerOrdersAttribute()
    {
//        $orders = []; # 定义存储容器

//        $items = $this->consults; # 获取律师所有服务项
//
//        foreach($items as $item){    # 搜索Item数据库中所有购买了律师服务的条目
//            $services = Item::where('reference_id',$item->id)->get();
//            foreach($services as $service){
//                $order = $service->order;  # 每一个条目对应一个Order订单
//                $orders[] = $order;
//            }
//        }
//        $orders = collect($orders);        
        $orders = Order::where('seller_id',$this->id)->get();
        return $orders;
    }

    public function getServiceCountAttribute()
    {
        $result = Order::where('seller_id',$this->id)->where('statusCode','completed')->count();
        return $result?$result:0;
    }

    public function getIncomingAttribute()
    {
        $orders = Order::where('seller_id',$this->id)
            ->where('statusCode','completed')
            ->where('withdrew',false)->get();
        if($orders->count()){
            $sum = 0;
            foreach ($orders as $order){
                $sum += $order->drawAmount();
            }
            return $sum;
        }
        return 0;
    }

    public function getNotDrewOrdersAttribute()
    {
        $orders = Order::where('seller_id',$this->id)
            ->where('statusCode','completed')
            ->where('withdrew',false)->get();
        if($orders->count()){
            return $orders;
        }
        return null;
    }

    public function getOrdersByStatus($statusCode)
    {
        $orders = Order::where('seller_id',$this->id)
            ->where('statusCode',$statusCode)->get();
        if($orders->count())
            return $orders;
        return null;
    }

    public function withdraw($bank_account)
    {
        if($this->role == 'lawyer'){
            $orders = $this->not_drew_orders;
            if($orders){
                $sum = 0;
                foreach ($orders as $order){
                    $order->update([
                        'withdrew' => true
                    ]);
                    $sum += $order->total;
                }
                # 判断是否所有订单状态都为提款成功，失败的集体回滚
                $result = 'success';
                foreach ($orders as $order){
                    if($order->withdrew == false){
                        $result = 'fail';
                        break;
                    }
                }
                if($result == 'success'){
                    $bill = Bill::create([
                        'user_id'  => $this->id,
                        'name'     => $this->real_name,
                        'amount'   => $sum,
                        'account'  => $bank_account,
                    ]);
                    foreach ($orders as $order){
                        $order->update([
                            'bill_id' => $bill->id
                        ]);
                    }
                }else{
                    # 如果失败，重置所有订单相关提款状态为[未提款]
                    foreach ($orders as $order){
                        $order->update([
                            'withdrew' => false
                        ]);
                    }
                }
                return $result;
            }
        }

        return 'invalid';
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    # 获取已收藏的项目
    public function getCollectsAttribute()
    {
        # highly suggested to allow eager load
        $consults = Item::whereLiked($this->id)->with('likeCounter')->get();

        if($consults->count())
            return $consults;
        return null;
    }
}
