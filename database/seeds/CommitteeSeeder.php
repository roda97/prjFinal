<?php

use Illuminate\Database\Seeder;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scientific_committees')->insert([
            'room' => 'AS 1.2',
            'description' => 'Reuniao sobre o CIIC',
            'datereunion' => date('2018-01-01 00:00:00'),
            'ata' => '1593593420_sample.pdf',
        ]);

        DB::table('scientific_committees')->insert([
            'room' => 'AS 2.2',
            'description' => 'Reuniao sobre o  futuro do CIIC',
            'datereunion' => date('2018-01-01 00:00:00'),
            'ata' => '1593593420_sample.pdf',
        ]);

        DB::table('scientific_committees')->insert([
            'room' => 'AS 1.3',
            'description' => 'Reuniao sobre metodologias',
            'datereunion' => date('2018-01-01 00:00:00'),
            'ata' => '1593593420_sample.pdf',
        ]);

        // esta segunda comissao é meramente exemplo para aparecer numa Lista do backoffice
        /*DB::table('scientific_committees')->insert([
            'start_date' => date('Y-m-d H:i:s'),
            'end_date' => date('2222-11-22 11:11:11'),
        ]);*/

        DB::table('members_scientific_committees')->delete();
        $members_scientific_committees = array(
            ## Scientific Committee
            array('user_id' => 9, 'scientific_committees_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('user_id' => 12, 'scientific_committees_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('user_id' => 15, 'scientific_committees_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
            array('user_id' => 18, 'scientific_committees_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
        );
        DB::table('members_scientific_committees')->insert($members_scientific_committees);

    }
}
