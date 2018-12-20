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
            'title' => 'verifiedaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '1',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'status' => \App\Challenge::$status_verified,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'noneaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '1',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'status' => \App\Challenge::$status_none,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'failaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '1',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'status' => \App\Challenge::$status_failed,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'solvedaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '1',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe56',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'status' => \App\Challenge::$status_solved,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '2',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe57',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '1',
            'from_ip3' => '3',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe58',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '4',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe59',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'status' => \App\Challenge::$status_solved,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        sleep(1);

        DB::table('challenges')->insert([
            'id' => Uuid::generate(4),
            'title' => 'jlfdsajflkjerlkfnlksdl',
            'model_answer' => 'alert(/XSS/.source)',
            'from_ip0' => '10',
            'from_ip1' => '0',
            'from_ip2' => '4',
            'from_ip3' => '1',
            'setter_id' => 'ad4fdc78-db6f-406b-86a4-adfeaa27fe59',
            'html' => '<script>eval(decodeURIComponent(location.search.substr(1)))</script>',
            'status' => \App\Challenge::$status_verified,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
