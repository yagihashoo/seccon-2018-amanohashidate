<?php

use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class ChallengesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'test',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip' => '10.0.1.1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56',
            'file_id' => Uuid::generate(4),
            'verified' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
