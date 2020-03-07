<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('initials');
        });*/

        // ipleiria
        /*Schema::create('school_campus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });*/

        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('function')->nullable();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('abstract', 5000);
            $table->string('consortium', 5000)->nullable();
            $table->string('funding')->nullable();
            $table->string('proponent')->nullable();
            $table->decimal('total_budget')->nullable();
            $table->decimal('ciic_budget')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('keywords');
            $table->string('scientific_domains');
            $table->string('application_domains');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        /*Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->string('street')->nullable();
            $table->string('door_number')->nullable();
        });*/

        Schema::create('laboratories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('laboratoy_real_id')->nullable();
            //$table->integer('campus_id')->unsigned();
            $table->string('school_campus_name')->nullable();
            $table->string('name');
            $table->integer('number_work_posts')->nullable();
            $table->decimal('area_m2')->nullable();
            $table->string('workgroup')->nullable();
            $table->string('lab_img_path')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        // confirmar se é do ciencia vitae ??
        /*Schema::create('institution_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city');
            $table->string('region');
            $table->integer('country_id')->unsigned();
        });*/

        // confirmar se é do ciencia vitae ??
        // foi adicionado o nome para a tabela events
        /*
        Schema::create('institution', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution_name');
            $table->integer('institution_address_id')->unsigned();
        });
        */

        /*Schema::create('school', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            //$table->integer('school_campus_id')->unsigned();
            $table->string('school_campus_name')->nullable();
            $table->integer('address_id')->unsigned();
        });*/

        /*Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('initials');
            $table->integer('school_id')->unsigned();
        });*/

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            //$table->dateTime('created_at');
            //$table->dateTime('updated_at')->nullable();
            $table->string('institution_name')->nullable();
            //$table->integer('address_id')->unsigned()->nullable();
            //$table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('academic_degree', ['Master of Science', 'Postgraduate Academic Degree'])->nullable();
            //$table->enum('role',['External Member', 'Integrated Member', 'Collaborator', 'Full member', 'CIIC Coordinator'])->nullable();
            $table->enum('department', ['Ciências Jurídicas', 'Ciências da Linguagem', 'Engenharia do Ambiente', 
            'Engenharia Civil','Engenharia Eletrotécnica','Engenharia Informática','Engenharia Mecânica',
            'Gestão e Economia','Matemática'])->nullable();
            $table->string('science_id')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('isActive')->default(true); // se pertence ao CIIC atualmente
            $table->boolean('isAdmin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_active_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->boolean('changed_to')->default(true);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('members_scientific_committees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('scientific_committees_id')->unsigned()->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

        });

        Schema::create('scientific_committees', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
           // $table->string('year');
        });

        /*Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_event_submited')->default(false);
            $table->string('event_name');
            $table->string('event_description');
            $table->string('event_type');
            $table->string('institution_sector');
            $table->string('administrative_role');
            $table->string('researchers_names');
            $table->string('institution_name');
            //$table->integer('institution_id')->unsigned();
            $table->date('startdate');
            $table->date('end_date');
            $table->integer('created_by_used_id')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->string('event_img_path')->nullable();
        });*/

        Schema::create('partners_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('partner_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('project_researchers', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('name');
            $table->integer('user_id')->unsigned()->nullable();;
            $table->integer('project_id')->unsigned()->nullable();;
            //$table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        /*Schema::create('user_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('phone_number');
        });*/

        /*Schema::create('users_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
        });*/

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('title');
            $table->string('text', 5000);
            $table->string('description', 90);
            
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('new_img_path')->nullable();
         //   $table->boolean('status')->default(false);
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        Schema::create('awards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description', 5000);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        /*Schema::create('patents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description', 5000);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });*/

        Schema::create('mission', function (Blueprint $table) {
            $table->increments('id');
            $table->LONGTEXT('text');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('countries');
        //Schema::drop('date');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('events');
        //Schema::drop('genders');
        //Schema::drop('institution');
        Schema::dropIfExists('laboratories');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('school_campus');
        Schema::dropIfExists('school');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('user_phones');
        Schema::dropIfExists('users_team');
        Schema::dropIfExists('partners_projects');
        Schema::dropIfExists('project_researchers');
        //Schema::dropIfExists('institution_address');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_active_histories');
        Schema::dropIfExists('members_scientific_committees');
        Schema::dropIfExists('scientific_committees');
        Schema::dropIfExists('news');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('patents');
        Schema::dropIfExists('mission');
        Schema::enableForeignKeyConstraints();
    }
}
