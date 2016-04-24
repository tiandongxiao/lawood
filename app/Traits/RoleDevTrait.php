<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 24/04/2016
 * Time: 15:24
 */

namespace App\Traits;

use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;


/**********************************************************************************
 *
 * 角色操作相关方法说明
 * <1> 当用户注册时，会自动赋予用户注册用户角色(reg_user role)
 * <2> 在用户编辑界面，默认支持的切换
 * <3> 如果用户为付费用户(payment_user)，其必然也拥有注册用户角色(reg_user)
 * <4> 如果用户为管理员用户(admin)，其必然也拥有注册用户角色(reg_user)
 *
 **********************************************************************************/
trait RoleDevTrait
{
    /**
     * 为指定用户分配一组角色
     * @param  App\User $user
     * @param  Array  $roles_array 指定的角色数组
     */
    public function setUserRoles($user, Array $roles_array)
    {
        $roles = Role::all();
        foreach ($roles as $role){
            //用户列表中都是注册用户，不可以将其设置为匿名用户，也不能将注册用户属性消除
            if($role->name != 'anony_user' && $role->name != 'regist_user'){
                if($roles_array && in_array($role->name, $roles_array)){
                    if(!$user->hasRole($role->name)){
                        $user->attachRole($role);
                    }
                }else{
                    if($user->hasRole($role->name)){
                        $user->detachRole($role);
                    }
                }
            }
        }
    }

    /**
     * 为指定用户分配一个角色
     * @param  App\User $user
     * @param  role_name 指定的角色机器名称
     */
    public function setUserRole($user,$role_name)
    {
        $role = Role::where('name',$role_name)->first();

        if(!is_null( $role )){
            if(!$user->hasRole($role->name)){
                $user->attachRole($role);
            }
        }
    }

    /**
     * 剥夺指定用户的某个角色身份
     * @param  App\User $user
     * @param  role_name 指定的角色机器名称
     */
    public function removeUserRole($user,$role_name)
    {
        $role = Role::where('name',$role_name)->first();
        if(is_object($role) && $user->hasRole($role->name)){
            $user->detachRole($role);
        }
    }

    /**
     * 为指定用户分配一个注册用户角色
     * @param  App\User $user
     *
     */
    public function setRegRole($user)
    {
        $this->setUserRole($user,'regist_user');
    }

    /**
     * 为指定用户分配一个付费用户角色
     * @param  App\User $user
     *
     */
    public function setPaymentRole($user)
    {
        $this->setRegRole($user);
        $this->setUserRole($user,'payment_user');
    }

    /**
     * 为指定用户分配一个超级管理员角色
     * @param  App\User $user
     *
     */
    public function setAdminRole($user)
    {
        $this->setRegRole($user);
        $this->setUserRole($user,'admin');
    }

    /**
     * 剥夺指定用户的管理员身份
     * @param  App\User $user
     *
     */
    public function removeAdminRole($user)
    {
        $this->removeUserRole($user,'admin');
    }

    /**
     * 剥夺指定用户的付费用户身份
     * @param  App\User $user
     *
     */
    public function removePaymentRole($user)
    {
        $this->removeUserRole($user,'payment_user');
    }
}