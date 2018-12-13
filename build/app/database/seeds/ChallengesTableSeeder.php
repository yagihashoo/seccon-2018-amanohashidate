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
            'title' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip' => '10.0.1.1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56',
            'file_id' => Uuid::generate(4),
            'verified' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip' => '10.0.2.1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe57',
            'file_id' => Uuid::generate(4),
            'verified' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip' => '10.0.3.1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe58',
            'file_id' => Uuid::generate(4),
            'verified' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip' => '10.0.4.1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe59',
            'file_id' => Uuid::generate(4),
            'verified' => true,
            'solved' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
