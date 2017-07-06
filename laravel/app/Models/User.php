<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //设置允许或者不允许添加的字符
//    protected $guarded = ['_token','repassword','phonecode','icon'];
    protected $fillable = ['regtime','name','password','phone','email','sex','birthday','icon','status','updated_at','created_at'];
    //在添加数据到数据库的时候，需要将模型字段进行额外的处理
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
