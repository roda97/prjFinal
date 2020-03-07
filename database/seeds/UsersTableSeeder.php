<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ## **************** Example User **************** ##
        
        DB::table('users')->insert([
            'name'              => 'Admin',
            'password'          => bcrypt('123456789'),
            'email'             => 'admin@admin.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => 'IPL',
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => 'Engenharia Informática',
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => true
        ]);

        ## ******************** Full Members ******************** ##

        DB::table('users')->insert([
            'name'              => 'Alexandrino José Marques Gonçalves',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Anabela Moreira Bernardino',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'António Manuel de Jesus Pereira',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Carlos Fernando Almeida Grilo',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Carlos Manuel da Silva Rabadão',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);


        DB::table('users')->insert([
            'name'              => 'Catarina Isabel Ferreira Viveiros Tavares Reis',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Eugénia Moreira Bernardino',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Fernando José Mateus da Silva',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'José Carlos Bregieiro Ribeiro',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Luís Alexandre Lopes Frazão',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Maria Beatriz Guerra da Piedade',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);
        
        DB::table('users')->insert([
            'name'              => 'Maria Micaela Pinto Dinis Esteves',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Marisa da Silva Maximiano',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Miguel Monteiro de Sousa Frade',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Nuno Alexandre Ribeiro Costa',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Nuno Carlos Sousa Rodrigues',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Paulo Jorge Gonçalves Loureiro',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Paulo Manuel Almeida Costa',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Rita Margarida Teixeira Ascenso',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Sílvio Priem Mendes',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        ## ******************** Collaborator Members ******************** ##
        DB::table('users')->insert([
            'name'              => 'Adaíl Domingues da Silva de Oliveira',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Ana Filipa Nogueira',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Anabela Gonçalves Rodrigues Marto',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'António Carlos Alves Urbano',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        
        DB::table('users')->insert([
            'name'              => 'Carlos Manuel Gonçalves Antunes',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Catarina Heleno Branco Simões Silva',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Gustavo Miguel Jorge dos Reis',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Henrique de Amorim Almeida',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Isabel Pereira Marcelino',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'João da Silva Pereira',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Leonel Filipe Simões Santos',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Maria Eduarda Abrantes Ferreira da Silva',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Mário João Gonçalves Antunes',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Nuno Miguel Afonso Veiga',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Patrício Rodrigues Domingues',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);
        
        DB::table('users')->insert([
            'name'              => 'Pedro Miguel Cardoso Gago',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Ricardo Manuel Marques Grilo',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Rolando Lúcio Germano Miragaia',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Rui Castanheira de Paiva',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Rosa Isabel Alves Cordeiro Matias',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Postgraduate Academic Degree',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);

        DB::table('users')->insert([
            'name'              => 'Rui Vasco Monteiro',
            'password'          => bcrypt('123456789'),
            'email'             => Str::random(20).'@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'institution_name'  => null,
            'academic_degree'   => 'Master of Science',
            'department'        => null,
            'science_id'        => '1019-2EC9-876A',
            'photo'             => 'man.png',
            'remember_token'    => str_random(10),
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
            'isActive'          => true,
            'isAdmin'          => false
        ]);
    }
}