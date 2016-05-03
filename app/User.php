<?php

namespace App;

use Amsgames\LaravelShop\Traits\ShopUserTrait;

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

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    Ratingable,
                                    HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword, ShopUserTrait, RatingTrait, HasRoleAndPermission, Authorizable {
        # 为解决冲突的问题
        HasRoleAndPermission::can insteadof Authorizable;
        Authorizable::can as may;
    }

    protected $table = 'users';
    protected $fillable = ['name', 'phone', 'email', 'active', 'avatar', 'role', 'union_id', 'open_id', 'password'];
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
}
