<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('projects')->insert([
            'title' => 'SmartWalk: Smart Cities for Active Senior Citizens',
            'abstract' => 'SmartWalk aims at increasing the quality of life of the elder population by creating tools to monitor and help to preserve functional capacities. The increase of elderly population makes a pressing matter the promotion of healthy ageing, with autonomy and independence, and preserving functional capacities. Active Aging is a priority area of the Health 2020 policy of the EU. Additional to this concept exists the concept of Aging in Place that reflects the desire to be at home while ageing. SmartWalk proposes the creation of a physical activity monitoring system for smart cities (SC). It comprises mobile devices to acquire and transmit biometric data to a server via existing SC communication infrastructure, for a trustworthy and free service. A back-office application allows health professionals, and relevant institutions, to see the data and propose small routine changes to promote adequate physical condition, if necessary. The proposals are communicated to users via their mobile device.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => 118409.94,
            'ciic_budget' => 20264.39,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'CARE4VALUE',
            'abstract' => 'Develop and implement a model information system and management control, which maximizes value creation (health outcomes per euro spent) in the Integrated Integrated Health Care Units.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => 149485,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'OnTRACK: On Time to Rethink ACtivity Knowledge – a personalized health coaching platform to tackle physical inactivity in COPD',
            'abstract' => 'Physical inactivity is the 4th leading risk factor for death worldwide. In patients with chronic obstructive pulmonary disease (COPD), it is particularly serious as inactivity increases patients’ risk for hospitalizations, mortality and reduced quality of life. Improving patients’ PA is thus a global priority for governments, policy makers and clinicians. Mobile health (mHealth) applications are ubiquitous and may help patients be more physically active. However, previous studies yielded mixed results due to the lack of consideration of contextual factors. As a complex behaviour, PA is influenced by an interplay of individual, social and environmental factors and PA preferences that may act as barriers/facilitators. OnTRACK will develop, evaluate and disseminate a personalized health coaching platform which considers an individual’s preferences and contextual factors.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => 236275.62,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'AR WARE: Augmented Reality for intelligent WAREhouse management',
            'abstract' => 'The AR WARE project aims to develop a platform to support the organization, logistics management of operations and/or the choice of medium or large warehouses of companies, distributors and/or logistics operators, based on paradigms like Internet of Things (IoT), 4.0 Industry and technologies such as augmented reality, 2D/3D mapping, image processing and intelligent algorithms (based on artificial intelligence, heuristics and operational research).',
            'consortium' => '3 companies: In-centea – Management Technology; Codi – Trade and Industrial Design; Matcerâmica – Food & Beverage Outlets',
            'funding' => null,
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'BLON SCIENTIFICALLY',
            'abstract' => 'The ongoing project fits the scientific areas of CIIC, with practical activities in computer sciences and communication areas. The activities to be developed will be the use of tools and technologies in the field of information technology applied to various knowledge areas, from natural sciences (Biology) to Information and Communication Technologies (ICT). The activities will be based on the scientific method in a dynamic process. The aim is to stimulate practical activities in Schools and CIIC facilities, namely at three levels: (1) activities with students, in the classroom, (2) activities with teachers, giving them tools to streamline their classes, (3) activities with small groups of students and teachers, to explore technologies available at CIIC.',
            'consortium' => null,
            'funding' => 'Ministério da Educação, Ministério da Ciência, Tecnologia e Ensino Superior e Rede de Bibliotecas Escolares',
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'Leiria Newspaper',
            'abstract' => 'Creation of App “Reporter no Mundo” (Word Reporter) with a gamification system for mobile devices and front office to support the management of this app with the purpose of encouraging the creation of news by ordinary people with Portuguese nationality who are living in foreign countries.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'LINPOSYS: Low-cost Indoor Positioning System',
            'abstract' => 'The aim of Linposys is to carry out research, development and performance evaluation of a novel low-cost Indoor Positioning System (IPS) based on a small FM-TDM-WCDMA (Frequency Modulation – Time Division Multiplexing – Wide Code Division Multiple Access) network. The positioning process is performed with the help of an artificial neural network',
            'consortium' => null,
            'funding' => null,
            'proponent' => 'Instituto de Telecomunicações',
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'STRETCHTRONICS: Soft And Stretchable Mechatronics For Wearable Devices: Fabrication, Implementation And Applications',
            'abstract' => 'Stretchtronics is a project to investigate novel fabrication methods and show-case applications of Stretchable Electronics, including wearable systems for biomonitoring and active prosthetic hands. It also involves methods and materials for additive manufacturing (3D printing) of stretchable electronics. The interdisciplinary project joins experts from material and polymer science, electrical engineering, additive manufacturing and stretchable electronics.',
            'consortium' => null,
            'funding' => null,
            'proponent' => 'Institute of Systems and Robotics (project leader); Technology Center of the Mold Industry, Special Tools and Plastics (Centimfe); University of Coimbra',
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'MIMO: Moving Image Museum',
            'abstract' => 'The MIMO project-partnership is dedicated to the execution, updating and maintenance of the exhibition modules of the Museum and to study and propose didactic methodologies and art installations for the Permanent Exhibition of the Moving Image Museum (MIMO) of Leiria Municipal Council.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'Veggies4MyHeart: Creation Of A Digital Game To Promote Vegetable Consumption In Schools',
            'abstract' => 'Veggies4MyHeart aims to develop a 2D digital game to encourage preschoolers to eat more vegetables. In the promoting future, the team plans to extend the project to other ages promoting vegetable consumption in all ages.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'SFCoLAB: Smart Farm CoLAB',
            'abstract' => 'SMART FARM CoLAB is a Collaborative Laboratory for Digital Innovation in agriculture based in Portugal West Region which aim is to generate integrative high-tech solutions into the horticulture-viticulture -fruticulture production sectors. SFCoLAB will focus on sustainable production strategies, integrating resources use efficiency innovative techniques, digital and real-time monitoring systems with a high-tech farming management. A global strategy that aims to answer key regional questions and global issues raised by the sector. SFCoLAB will address the current challenges of climate change, farm digitalization and a circular economy at small- and medium-farm systems. The total amount of support requested to support scientific qualified employment, for 5 years, was € 2.390.145.',
            'consortium' => null,
            'funding' => 'FCT',
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

        DB::table('projects')->insert([
            'title' => 'TabMir: Miróbriga Taverns',
            'abstract' => 'TabMir is an interdisciplinary study of a Roman imperial city, with the possibility of extending to the Suevi-Visigoth period, from the second half of century I to the first half of century VI. It aims to approach in a stratigraphic way a type of urban sector barely known of the Roman Lusitania. In this sense, it is not only a study per si of architectural realities and their evolution, with Miróbriga as the case study, but an integrated study, including specialists of Imperial Roman Archeology and Late Antiquity, Archeometry, Zooarchaeology, Topography, Computer Engineering and Conservation and Restoration, involving 9 institutions from 2 countries.',
            'consortium' => null,
            'funding' => null,
            'proponent' => null,
            'total_budget' => null,
            'ciic_budget' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
        ]);

    }
}
