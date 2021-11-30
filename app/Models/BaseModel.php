<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Facades\Admin;

class BaseModel extends Model
{
    // use DefaultDatetimeFormat;

    public string $xxScene = '';


    // 获取当前登录用户（Laravel-admin体系下的用户, admin_users）
    public function getUser()
    {
        return Admin::user();
    }

    // 获取当前登录用户（XX体系下的用户, xx_user）
    public function getXxUser()
    {
        return XxUser::query()->find(Admin::user()->xx_uid) ?? null;
    }

    // 获取当前登录用户（XX体系下的用户Id, xx_user->uid）
    public function getXxUserId()
    {
        return $this->getXxUser() ? $this->getXxUser()->uid : 0;
    }


    // 静态获取当前登录用户（Laravel-admin体系下的用户, admin_users）
    public static function user()
    {
        return Admin::user();
    }

    // 静态获取当前登录用户（XX体系下的用户, xx_user）
    public static function xxUser()
    {
        // return self::getXxUser();
        return (new self())->getXxUser();
    }

    // 静态获取当前登录用户（XX体系下的用户Id, xx_user->uid）
    public static function xxUserId()
    {
        // return self::getXxUserId();
        return (new self())->getXxUserId();
    }
}
