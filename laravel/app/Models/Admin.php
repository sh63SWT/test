<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //protected $table = 'test';//自定义表名
    //protected $fillable = ['name', 'password', 'email','status'];
    //设置允许或者不允许添加的字符
    protected $guarded = ['_token'];
    //在添加数据到数据库的时候，需要将模型字段进行额外的处理
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
