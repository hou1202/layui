<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     *定义连接表
     */
    public $table = 'permissions';

    /**
     *定义允许批量写入的字段
     *
     *@var array
     */
    protected $fillable = [
        'title','route','is_menu','type_id','icon'
    ];


}
