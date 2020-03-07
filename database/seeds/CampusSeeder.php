<?php

use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1 - Campus 1
        // 2 - Campus 2
        // 3 - Campus 3
        // 4 - Campus 4
        // 5 - Campus 5
        // 6 - SERVIÇOS CENTRAIS

        DB::table('school_campus')->insert([
            'name' => 'Campus 1',
        ]);

        DB::table('school_campus')->insert([
            'name' => 'Campus 2',
        ]);

        DB::table('school_campus')->insert([
            'name' => 'Campus 3',
        ]);

        DB::table('school_campus')->insert([
            'name' => 'Campus 4',
        ]);

        DB::table('school_campus')->insert([
            'name' => 'Campus 5',
        ]);

        DB::table('school_campus')->insert([
            'name' => 'SERVIÇOS CENTRAIS',
        ]);

    }
}
