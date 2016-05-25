<?php

namespace App;

use Amsgames\LaravelShop\Traits\ShopUserTrait;


use App\Traits\CategoryDevTrait;
use App\Traits\UserAnalysisTrait;
use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;

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

use DraperStudio\Commentable\Contracts\Commentable;
use DraperStudio\Commentable\Traits\Commentable as CommentTrait;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    Ratingable,
                                    HasRoleAndPermissionContract,
                                    Commentable
{
    use Authenticatable, CanResetPassword, ShopUserTrait, RatingTrait, HasRoleAndPermission, Authorizable ,CommentTrait, UserAnalysisTrait{
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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    # 用户与通告消息是一对多的关系
    public function notifications()
    {
        return $this->hasMany(Notification::class);
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

        $this->locations->delete();
        $this->comments->delete();
        $this->timing->delete();
        $this->dressing->delete();
        $this->polite->delete();
        $this->profile->delete();

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
            $home->update(['address'=>$address]);
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
            $work->update(['address'=>$address]);
        }else{
            $work = Location::create([
                'type'    => 'work',
                'address' => $address
            ]);
            $this->locations()->save($work);
        }
    }

    public function getHomeAttribute()
    {
        $home = $this->locations()->where('type','home')->first();
        if($home)
            return $home->address;
        return null;
    }

    public function getWorkAttribute()
    {
        $work = $this->locations()->where('type','work')->first();
        if($work)
            return $work->address;
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
            UserDressing::create(['user_id',$this->id]);

        # build timing rating
        if(is_null($this->timing))
            UserTiming::create(['user_id',$this->id]);

        # build polite rating
        if(is_null($this->polite))
            UserPolite::create(['user_id',$this->id]);
    }

    # 增加一个新的业务类别
    public function bindCategory($id)
    {
        $count = $this->categories()->count();
        if( $count < 4) {
            $category = Category::findOrFail($id);
            if (!$this->hasCategory($category->id)) {
                $this->categories()->attach($category->id);
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
            $items = $this->items;
            if(!is_null($items)) {
                foreach ($items as $item) {
                    if ($item->category_id == $id)
                        $item->delete();
                }
                $this->categories()->detach($id);

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
        foreach ($range as $item){
            if(!$this->hasCategory($item)){
                $this->bindCategory($item);
            }
        }
    }

    # 律师获取自己所有的服务项
    public function getConsultsAttribute()
    {
        $goods = Item::where('class',null)->where('user_id',$this->id)->get();
        return $goods;
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
                    $item = Item::create([
                        'user_id'           => $this->id,
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

    # 开启服务
    public function start()
    {
        
    }

    # 关闭服务
    public function stop()
    {

    }
}
