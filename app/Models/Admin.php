<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    /**
     *定义连接表
     */
    public $table = 'admins';

    /**
     *定义允许批量写入的字段
     *
     * @var array
     */
    protected $fillable = [
        'account', 'password', 'name', 'status', 'role_id', 'last_ip', 'last_at', 'log_count', 'remarks'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];


    /*public function role()
    {
        return $this -> hasOne(Role::class,'role_id');
    }*/
}



