<?php

use Illuminate\Database\Seeder;

class LaboratoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laboratories')->insert([
            'laboratoy_real_id' => 'C1P0-15',
            //'campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'name' => 'LabCIF',
            'number_work_posts' => 4,
            'area_m2' => 24,
            'workgroup' => 'Cybersecurity and Digital Forensics',
            'lab_img_path' => 'lab_cif.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('laboratories')->insert([
            'laboratoy_real_id' => 'A.S.0.01',
            //'campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'name' => 'Communications Lab',
            'number_work_posts' => 8,
            'area_m2' => 55,
            'workgroup' => 'Internet of Things (IoT)',
            'lab_img_path' => 'iot.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        
        DB::table('laboratories')->insert([
            'laboratoy_real_id' => 'D.S.-1.01',
            //'campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'name' => 'Game Lab',
            'number_work_posts' => 8,
            'area_m2' => 70,
            'workgroup' => 'Virtual and Augmented Reality',
            'lab_img_path' => 'game_lab.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('laboratories')->insert([
            'laboratoy_real_id' => 'C1P1-C4',
            //'campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'name' => 'Room 1',
            'number_work_posts' => 11,
            'area_m2' => 51,
            'workgroup' => 'All',
            'lab_img_path' => 'room_1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('laboratories')->insert([
            'laboratoy_real_id' => 'C1P1-C4A',
            //'campus_id' => 2,
            'school_campus_name' => 'Campus 2',
            'name' => 'Room 2',
            'number_work_posts' => 6,
            'area_m2' => 45,
            'workgroup' => 'All',
            'lab_img_path' => 'room_2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);



    }
}
