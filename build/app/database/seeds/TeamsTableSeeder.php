<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'id' => '64',
            'name' => 'SECCON',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '192',
            'name' => 'dodododo',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '193',
            'name' => 'Bluemermaid',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '194',
            'name' => 'YOKARO-MON',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '195',
            'name' => 'Team Enu',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '196',
            'name' => 'yharima',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '197',
            'name' => 'ids-TeamCC',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '198',
            'name' => 'm1z0r3',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '199',
            'name' => 'katagaitai',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '200',
            'name' => 'killswitch',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '201',
            'name' => 'spookies',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '202',
            'name' => 'ICSCoE',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '203',
            'name' => '0x4556368625',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '204',
            'name' => 'insecure',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '205',
            'name' => 'ynuctf',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('teams')->insert([
            'id' => '206',
            'name' => 'Harekaze',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
