<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->create([
            'account'=>'admin',
            'password'=>bcrypt('111111'),
            'name'=>'admin',
            'status'=>1,
            'role'=>1,
            'remarks'=>'admin',
            'create_at'=>date('Y-m-d H:i:s'),
            'update_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
