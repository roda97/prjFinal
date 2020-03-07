<?php

use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
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

        DB::table('school')->insert([
            //'school_campus_id' => 2,
            'school_campus_name' => 'Campus 1',
            'address_id' => 1,
            'name' => 'ESTG',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 1,
            'school_campus_name' => 'Campus 1',
            'address_id' => 2,
            'name' => 'ESECS',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'address_id' => 3,
            'name' => 'ESSLEI',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'address_id' => 4,
            'name' => 'UED',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 3,
            'school_campus_name' => 'Campus 3',
            'address_id' => 5,
            'name' => 'ESAD.CR',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 4,
            'school_campus_name' => 'Campus 4',
            'address_id' => 6,
            'name' => 'ESTM',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 5,
            'school_campus_name' => 'Campus 5',
            'address_id' => 7,
            'name' => 'UNID. INVESTIGAÇÃO',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 6,
            'school_campus_name' => 'Serviços Centrais',
            'address_id' => 8,
            'name' => 'IPLEIRIA',
        ]);

        DB::table('school')->insert([
            //'school_campus_id' => 6,
            'school_campus_name' => 'Serviços Centrais',
            'address_id' => 9,
            'name' => 'SAS',
        ]);

    }
}
