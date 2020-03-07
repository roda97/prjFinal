<?php

use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();
        $departments = array(
            array('name' => 'Ciências Jurídicas', 'initials' => 'DCJ', 'school_id' => 1),
            array('name' => 'Ciências da Linguagem', 'initials' => 'DCL', 'school_id' => 1),
            array('name' => 'Engenharia do Ambiente', 'initials' => 'DEA', 'school_id' => 1),
            array('name' => 'Engenharia Civil', 'initials' => 'DEC', 'school_id' => 1),
            array('name' => 'Engenharia Eletrotécnica', 'initials' => 'DEE', 'school_id' => 1),
            array('name' => 'Engenharia Informática', 'initials' => 'DEI', 'school_id' => 1),
            array('name' => 'Engenharia Mecânica', 'initials' => 'DEM', 'school_id' => 1),
            array('name' => 'Gestão e Economia', 'initials' => 'DGE', 'school_id' => 1),
            array('name' => 'Matemática', 'initials' => 'DMAT', 'school_id' => 1),
        );
        DB::table('departments')->insert($departments);
    }
}
