<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('projects')->delete();
        DB::table('laboratories')->delete();
        //DB::table('countries')->delete();
        //DB::table('school')->delete();
        //DB::table('school_campus')->delete();
        //DB::table('departments')->delete();
        DB::table('teams')->delete();
        //DB::table('addresses')->delete();
        DB::table('roles')->delete();
        DB::table('scientific_committees')->delete();
        DB::table('partners')->delete();
        DB::table('partners_projects')->delete();
        DB::table('user_roles')->delete();
        DB::table('user_active_histories')->delete();
        DB::table('awards')->delete();
        DB::table('mission')->delete();

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE projects AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE laboratories AUTO_INCREMENT = 0');
        //DB::statement('ALTER TABLE countries AUTO_INCREMENT = 0');
        //DB::statement('ALTER TABLE school AUTO_INCREMENT = 0');
        //DB::statement('ALTER TABLE school_campus AUTO_INCREMENT = 0');
        //DB::statement('ALTER TABLE departments AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE teams AUTO_INCREMENT = 0');
        //DB::statement('ALTER TABLE addresses AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE project_researchers AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE scientific_committees AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE partners AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE partners_projects AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE user_roles AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE user_active_histories AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE awards AUTO_INCREMENT = 0');
        DB::statement('ALTER TABLE mission AUTO_INCREMENT = 0');

        $this->call(RoleSeeder::class);
        //$this->call(CountriesSeeder::class);
        //$this->call(AddressSeeder::class);
        //$this->call(CampusSeeder::class);
       //$this->call(SchoolSeeder::class);
        $this->call(LaboratoriesSeeder::class);
        //$this->call(DepartmentsSeeder::class);
        $this->call(TeamsSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ProjectResearchersSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CommitteeSeeder::class);
        $this->call(PartnersSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(AwardsSeeder::class);
        $this->call(MissionSeeder::class);

    }
}
