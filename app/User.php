<?php

namespace App;

use Amsgames\LaravelShop\Traits\ShopUserTrait;


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

    # 一个律师拥有多个Item项，这个关系在ShopUserTrait中已经绑定 #

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
        $this->checkProfile();
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
        $this->checkProfile();
        $this->profile->description = $desc;
        $this->profile->save();
    }

    public function checkProfile()
    {
        if(!$this->profile){
            $profile = Profile::create([]);
            $this->profile()->associate($profile);
        }
    }

    public function checkRatings()
    {
        if(is_null($this->dressing)){
            $dressing = UserDressing::create([]);
            $this->dressing()->associate($dressing);
        }

        if(is_null($this->timing)){
            $timing = UserTiming::create([]);
            $this->timing()->associate($timing);
        }

        if(is_null($this->polite)){
            $polite = UserPolite::create([]);
            $this->polite()->associate($polite);
        }
    }

    public function setHomeAttribute($address)
    {
        $home = $this->locations()->where('type','home')->get();
        if($home){
            $home->address = $address;
            $home->save();
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
        $work = $this->locations()->where('type','work')->get();
        if($work){
            $work->address = $address;
            $work->save();
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
        $home = $this->locations()->where('type','home')->get();
        if($home)
            return $home->address;
        return null;
    }

    public function getWorkAttribute()
    {
        $work = $this->locations()->where('type','work')->get();
        if($work)
            return $work->address;
        return null;
    }
}
