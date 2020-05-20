<?php

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about')->insert([
            'text' => 'Created on October 2008 with five effective members, CIIC has adopted in its initial phase a 
                    project-based management approach. With more than thirty researchers enrolled in doctoral programs at national and 
                    international universities in the recent past years, research has been done mainly through collaboration with external units. 
                    While supported mainly by collaborations with varied external units, the interests and results of the research were kept 
                    within specific lines of study. These lines were strongly associated with the competencies and formative offer of 
                    the Department of Informatics Engineering of the Polytechnic Institute of Leiria. Following a natural growth process, 
                    CIIC has recently defined a form of organization and internal structure based on research groups. 
                    Each research group follows a specific theme of research, and there is naturally collaboration between research groups and 
                    between group members. Scientifically the CIIC is structured in four lines of research, Computational Intelligence and 
                    Optimization, Communications and Telematics, Research in Computer Graphics and Sound, Informatics Applied to Health, 
                    with a strong emphasis on applied research. The structure of the CIIC is aligned on the one hand with its past research and on 
                    the other with the research and innovation strategies for intelligent specialization defined at regional, national and European level.',           
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
