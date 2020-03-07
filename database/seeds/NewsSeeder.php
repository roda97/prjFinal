<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            'author' => 'Miguel Frade',
            'title' => 'Funding awarded',
            'text' => '<p><img class="alignnone wp-image-74 size-large" src="https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-1024x240.png" alt="" width="640" height="150" srcset="https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-1024x240.png 1024w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-300x70.png 300w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-768x180.png 768w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-700x164.png 700w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-520x122.png 520w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-360x84.png 360w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-250x59.png 250w, https://sites.ipleiria.pt/ciic/files/2018/07/2016_FCCN_principal_color-100x23.png 100w" sizes="(max-width: 640px) 100vw, 640px"></p>
                        <p>As part of the FCT evaluation of R&amp;D units, the CIIC will receive the evaluation panel on 2018-12-06. </p>',
            'created_at' => date('2018-07-31 00:00:00'),
            'updated_at' => date('2018-07-31 00:00:00'),
            'description' => 'As part of the FCT evaluation of R&D units, the CIIC will receive the evaluation panel',
            //'status' => true,
            'new_img_path' => 'fct.jpg',
        ]);

        DB::table('news')->insert([
            'author' => 'Miguel Frade',
            'title' => 'BRIGHT FRIDAYS',
            'text' => '<p><img class="alignnone wp-image-268 size-full" src="https://sites.ipleiria.pt/ciic/files/2018/12/bright-fridays.jpg" alt="" width="516" height="271" srcset="https://sites.ipleiria.pt/ciic/files/2018/12/bright-fridays.jpg 516w, https://sites.ipleiria.pt/ciic/files/2018/12/bright-fridays-300x158.jpg 300w, https://sites.ipleiria.pt/ciic/files/2018/12/bright-fridays-360x189.jpg 360w, https://sites.ipleiria.pt/ciic/files/2018/12/bright-fridays-250x131.jpg 250w, https://sites.ipleiria.pt/ciic/files/2018/12/bright-fridays-100x53.jpg 100w" sizes="(max-width: 516px) 100vw, 516px"></p>
            <p style="font-weight: 400"><strong>October 26<sup>th</sup></strong><strong>&nbsp;– School of Tourism and Maritime Technology (Peniche)</strong></p>
            <p style="font-weight: 400"><strong><em>“Brightening strategies: Intellectual property</em></strong></p>
            <p style="font-weight: 400"><strong><em>– how to patent and publish (without perish)”</em></strong></p>
            <p style="font-weight: 400">By: “Knowledge Transfer Unit &amp; IP Consultant”</p>
            <p><a href="https://www.ipleiria.pt/blog/bright-fridays-the-science-of-making-science-2018-hands-on-sessions/">+ info</a></p>
            <p style="font-weight: 400">
            </p>',
            'created_at' => date('2018-10-05 00:00:00'),
            'updated_at' => date('2018-07-31 00:00:00'),
            'description' => 'Brightening strategies: Intellectual property: how to patent and publish (without perish)',
           // 'status' => false,
           'new_img_path' => 'bright.jpg',
        ]);

        DB::table('news')->insert([
            'author' => 'Miguel Frade',
            'title' => 'FCT: Evaluation of R&D Units',
            'text' => '

            <h1>Funding awarded for the Collaborative Laboratory SFCoLAB</h1>
<div>
   <p>FCT has awarded funding for the&nbsp;Collaborative Laboratory SFCoLAB were CIIC participates.</p>
   <p>«This COLAB is proposed by the Municipality of Torres Vedras, supported by an impressive team of collaborating institutes and businesses. It is proposed to locate the central COLAB facility in the city of Torres Vedras.<br>
      It has the strategic vision to generate integrative cutting-edge high-tech solutions into the horticulture-viticulture-fruticulture production sectors. SMART FARM intends to focus on sustainable production strategies, integrating resources use, efficiency, innovative techniques, digital and real-time monitoring systems, with high-tech farming management. This aims to answer to key regional questions and global issues raised by the sector and to address current challenges of climate change, farm digitalization and the circular economy at small and medium farm systems levels. A user-friendly SMART FARM System is proposed to be created and tested, leading to the socio-economic development and capacity building.»
   </p>
</div>
                       ',
            'created_at' => date('2018-12-05 00:00:00'),
            'updated_at' => date('2018-07-31 00:00:00'),
            'description' => 'This COLAB is proposed by the Municipality of Torres Vedras',
           // 'status' => true,
           'new_img_path' => 'cif.jpg',
        ]);
    }
}
