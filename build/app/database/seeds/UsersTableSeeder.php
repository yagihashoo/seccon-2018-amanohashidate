<?php

use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Uuid::generate(4),
            'name' => env('APP_ADMIN_USER', 'admin'),
            'password' => bcrypt(env('APP_ADMIN_PASSWORD', 'password')),
            'role_id' => 2,
        ]);
    }
}
