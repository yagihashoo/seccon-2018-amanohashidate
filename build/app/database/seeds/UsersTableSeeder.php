<?php

use Illuminate\Database\Seeder;

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
            'id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56', // Uuid::generate(4),
            'name' => env('APP_ADMIN_USER', 'admin'),
            'password' => bcrypt(env('APP_ADMIN_PASSWORD', 'password')),
            'role_id' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
