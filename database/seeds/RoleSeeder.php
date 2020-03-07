<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'External Member',
            'function' => 'No Function',
        ]);

        DB::table('roles')->insert([
            'name' => 'External Member',
            'function' => 'Collaborator',
        ]);

        DB::table('roles')->insert([
            'name' => 'Integrated Member',
            'function' => 'No Function',
        ]);

        DB::table('roles')->insert([
            'name' => 'Effective Member',
            'function' => 'Collaborator',
        ]);

        DB::table('roles')->insert([
            'name' => 'Full Member',
            'function' => 'No Function',
        ]);

        DB::table('roles')->insert([
            'name' => 'Full Member',
            'function' => 'Scientific Committee',
        ]);

        DB::table('roles')->insert([
            'name' => 'Full Member',
            'function' => 'CIIC Coordinator',
        ]);
    }
}
