<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     *定义连接表
     */
    public $table = 'roles';

    /**
     *定义允许批量写入的字段
     *
     *@var array
     */
    protected $fillable = [
        'name','per_id'
    ];

    public function admins()
    {
        $this -> belongsToMany(Admin::class);
    }
}
