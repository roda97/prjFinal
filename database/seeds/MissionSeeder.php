<?php

use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mission')->insert([
            'text' => 'The Computer Science and Communications Research Centre of the Polytechnic Institute of Leiria (CIIC-IPL) was created in October 2008, and has the mission of conducting high quality research in the areas of Information and Communications Technologies, promote the transfer of technology, as well as enabling the creation of spin-off companies and providing technical and scientific advice to both private and public entities. CIIC-IPL favours the following research areas: multimedia and cognitive systems; evolutionary and complex systems; systems and software engineering; network and communication services; web systems and information security.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }
}
