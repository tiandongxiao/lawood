<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 24/04/2016
 * Time: 15:26
 */

namespace App\Traits;

use Bican\Roles\Models\Role;

/*************************************************************************************
 *
 * 系统权限相关辅助方法说明
 * <1> 任何权限被创建成功后，超级管理员(admin)会被授予此权限。
 * <2> 编辑权限授予原则：超级管理员，拥有者。
 * <3> 删除权限授予原则：超级管理员，拥有者。
 * <4> 查看权限授予原则：非私密信息，皆可查看；私密信息，拥有者及其授权者可查看
 *
 *************************************************************************************/

trait PermissionDevTrait
{
    /**
     * 判断某角色是否拥有指定权限
     *
     * @param $role 角色实例句柄
     * @param $permission 权限实例句柄
     */
    public function hasPermission($role,$permission)
    {
        $result = $role->permissions->find($permission->id);

        if(is_object($result)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 将某权限赋予一组指定的角色
     *
     * @param $perm 权限实例句柄
     * @param $role_array 角色名称数组
     */
    public function authPermission($perm,$role_array)
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            if($role_array && in_array($role->name, $role_array)){
                if(!$this->hasPermission($role,$perm)){
                    $role->attachPermission($perm);
                }
            }else{
                if($this->hasPermission($role,$perm)){
                    $role->detachPermission($perm);
                }
            }
        }
    }

    /**
     * 将某权限赋予一个指定的角色
     *
     * @param $permission 权限实例句柄
     * @param $role_name 角色机器名称
     */
    public function authToRole($permission,$slug)
    {
        $role = Role::where('slug',$slug)->firstOrFail();

        if(is_object($role)){
            $role->attachPermission($permission);
        }

        return $this->hasPermission($role,$permission);
    }

    /**
     * 将某权限赋予超级管理员
     *
     * @param $permission 权限实例句柄
     */
    public function authToAdmin($permission)
    {
        return $this->authToRole($permission,'admin');
    }

    /**
     * 将某权限赋予付费用户
     *
     * @param $permission 权限实例句柄
     */
    public function authToPaymentUser($permission)
    {
        return $this->authToRole($permission,'payment_user');
    }

    /**
     * 将某权限赋予注册用户
     *
     * @param $permission 权限实例句柄
     */
    public function authToRegUser($permission)
    {
        return $this->authToRole($permission,'reg_user');
    }

    /**
     * 将指定权限从指定角色中撤销
     *
     * @param $permission 权限实例句柄
     * @param $role_name 角色机器名称
     */
    public function removeAuthFromRole($permission,$slug)
    {
        $role = Role::where('slug',$slug)->firstOrFail();

        if(is_object($role)){
            $role->detachPermission($permission);
        }

        return !$this->hasPermission($role,$permission);
    }
}