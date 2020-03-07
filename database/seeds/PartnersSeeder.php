<?php

use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partners')->delete();
        $partners = array(
            array('name' => 'Águeda City Council', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Águeda School of Technology and Management (project leader),', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Aveiro School of Health Sciences', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'CARME', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'CIGS (project leader)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'ciTechCare', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'ciTechCare (project leader)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'CITUR', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'ESTG - IPLeiria', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Globaltronic – Electronics and Telecommunications', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'INESCC - IPLeiria', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Jornal Região de Leiria', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Leiria Municipality', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'LSRE–LCM – IPLeiria', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Polytechnic Institute of Coimbra', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Universidade Nova de Lisboa (project leader)', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('name' => 'Torres Vedras Municipality', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),     
        );
        DB::table('partners')->insert($partners);

        DB::table('partners_projects')->delete();
        $partners_projects = array(
            array('project_id' => 1, 'partner_id' => 2),
            array('project_id' => 1, 'partner_id' => 3),
            array('project_id' => 1, 'partner_id' => 10),
            array('project_id' => 1, 'partner_id' => 1),
            array('project_id' => 1, 'partner_id' => 15),

            array('project_id' => 2, 'partner_id' => 5),

            array('project_id' => 3, 'partner_id' => 7),
            array('project_id' => 3, 'partner_id' => 4),
            array('project_id' => 3, 'partner_id' => 9),

            array('project_id' => 6, 'partner_id' => 12),

            array('project_id' => 9, 'partner_id' => 13),

            array('project_id' => 10, 'partner_id' => 6),
            array('project_id' => 10, 'partner_id' => 13),

            array('project_id' => 11, 'partner_id' => 11),
            array('project_id' => 11, 'partner_id' => 8),
            array('project_id' => 11, 'partner_id' => 14),
            array('project_id' => 11, 'partner_id' => 17),

            array('project_id' => 12, 'partner_id' => 16),
        );
        DB::table('partners_projects')->insert($partners_projects);
        
    }
}
