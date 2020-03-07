<?php

use Illuminate\Database\Seeder;

class AwardsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('awards')->insert([
            'title' => 'Best PhD Dissertation Proposal Award',
            'description' => 'Atribuído a Ana Filipa Nogueira pela proposta intitulada “On the Evaluation of Software
                            Maintainability Using Automatic Test Case Generation”, SEDES 2014 ­ 5th Portuguese Software
                            Engineering Doctoral Symposium,José Carlos Bregieiro Ribeiro, 2014.',           
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
            'title' => 'Projecto SoftHealth',
            'description' => 'Software for your health seleccionado como semi­finalista na 5.ª edição do
                            Angelini University Award,, Angelini,José Carlos Bregieiro Ribeiro, 2014.',           
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
            'title' => 'Best paper award',
            'description' => 'Twitter classification: are some examples better than others?; 22th
                            edition of the Portuguese Conference on Pattern Recognition (RecPad 16); Joana
                            Costa, Catarina Silva, Mário Antunes, Bernardete Ribeiro; October 2016; Aveiro,
                            Portugal',           
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
            'title' => '2nd place, ex-aqueo',
            'description' => 'Open Source Digital Forensics Conference (OSDFCon) 2017 -
                            Module Development Contest, Basis Technology, Miguel Monteiro de Sousa Frade,
                            2017.',           
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
