<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $fillable = ['uid','sid','cat','time'];
    //在添加数据到数据库的时候，需要将模型字段进行额外的处理

}
