<?php

use Illuminate\Database\Seeder;

class ProjectResearchersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_researchers')->delete();
        $project_researchers = array(
            // NECESSARIO CORRIGIR OS IDS !
            array('project_id' => 1, 'user_id' => 4), //'name' => 'António Pereira'),

            array('project_id' => 2, 'user_id' => 14), //'name' => 'Marisa Maximiano'),
            array('project_id' => 2, 'user_id' => 7), //'name' => 'Catarina Tavares Reis'),

            array('project_id' => 3, 'user_id' => 9), //'name' => 'Fernando Silva'),
            array('project_id' => 3, 'user_id' => 10), //'name' => 'José Ribeiro'),

            array('project_id' => 4, 'user_id' => 2), //'name' => 'Alexandrino Gonçalves'),
            array('project_id' => 4, 'user_id' => 17), //'name' => 'Nuno Carlos Rodrigues'),
            array('project_id' => 4, 'user_id' => 24), //'name' => 'Anabela Marto'),

            array('project_id' => 5, 'user_id' => 20), //'name' => 'Rita Ascenso'),

            array('project_id' => 6, 'user_id' => 33), //'name' => 'Maria Eduarda Abrantes'),

            array('project_id' => 7, 'user_id' => 31), //'name' => 'João Pereira'),

            array('project_id' => 8, 'user_id' => 29), //'name' => 'Henrique Almeida'),

            array('project_id' => 9, 'user_id' => 2), //'name' => 'Alexandrino Gonçalves'),

            array('project_id' => 10, 'user_id' => 33), //'name' => 'Maria Eduarda Abrantes'),
            array('project_id' => 10, 'user_id' => 28), //'name' => 'Gustavo Reis'),

            array('project_id' => 11, 'user_id' => 6), //'name' => 'Carlos Rabadão'),

            array('project_id' => 12, 'user_id' => 2), //'name' => 'Alexandrino Gonçalves'),
        );
        DB::table('project_researchers')->insert($project_researchers);
    }
}
