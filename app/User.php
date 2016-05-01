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
}
