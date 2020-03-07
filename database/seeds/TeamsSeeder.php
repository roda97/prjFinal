<?php

use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('teams')->insert([
            'title' => 'Communications and Telematics (CT)',
            'keywords' => 'Computer, devices and network communications; Network-centric computing; Network and information security; Software-defined networks',
            'scientific_domains' => 'IP mobility, intrusion detection/prevention systems, data loss prevention, authentication and access control, software-defined networks, quality of service and quality of experience, security in cloud computing networks',
            'application_domains' => 'e-Business, e-Commerce, Internet of Things, e-Security, Cybersecurity, Auditing and certification',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('teams')->insert([
            'title' => 'Computational Intelligence and Optimization (CIO)',
            'keywords' => 'Natural computing; Adaptive and complex systems; Optimization; Business intelligence',
            'scientific_domains' => 'Computational paradigms gleaned from nature, game theory and exact methods. Design, development and adaptation of algorithms for multimodal, dynamic, discrete, structural and multi-objective optimization',
            'application_domains' => 'Scientific discovery by unknown solution spaces exploration, quality improvement of business processes and services, innovation in product and services design, decision support systems and business intelligence',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('teams')->insert([
            'title' => 'Computer Graphics and Sound Research (CGSR)',
            'keywords' => 'Multimedia; Digital games; Computer graphics; Sound and music research',
            'scientific_domains' => 'Virtual worlds, virtual environments, augmented reality, tridimensional multimedia and stereoscopy, high dynamic range, procedural modeling, shape grammars',
            'application_domains' => 'Digital contents production and multimedia development (in tourism, cultural heritage protection, history and science dissemination), creative industries (digital video and sound based creativity), educational and entertainment multimedia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('teams')->insert([
            'title' => 'Health Informatics (HI)',
            'keywords' => 'Ambient assisted living; Gerontechnology; Mobile health; Healthcare information systems',
            'scientific_domains' => 'Healthy ageing, gerontechnology, predictive and prescriptive analysis, digital inclusion and accessibility',
            'application_domains' => 'e-Therapy, eHealth support services, clinical information and management integrated systems, collaborative, education and management tools',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
