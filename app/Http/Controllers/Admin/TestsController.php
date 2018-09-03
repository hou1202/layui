<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/3
 * Time: 20:48
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public function index()
    {
        DB::table('admins')->insert([
            'account'=>'admin',
            'password'=>bcrypt('111111'),
            'name'=>'admin',
            'status'=>1,
            'role_id'=>1,
            'remarks'=>'admin',
            'remember_token'=>str_random(20),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}