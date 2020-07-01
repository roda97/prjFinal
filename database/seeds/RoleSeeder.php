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
            'id' => 3,
            'name' => 'External Member',
            'function' => '-----------',
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'Collaborator Member',
            'function' => '-----------',
        ]);

        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'Full Member',
            'function' => '-----------',
        ]);

        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'Full Member',
            'function' => 'CIIC Coordinating Committee',
        ]);

        DB::table('roles')->insert([
            'id' => 7,
            'name' => 'Full Member',
            'function' => 'CIIC Coordinator',
        ]);

    }
}
