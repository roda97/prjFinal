<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });*/

        /*Schema::table('laboratories', function (Blueprint $table) {
            //$table->foreign('campus_id')->references('id')->on('school_campus');
        });
        */

        /*Schema::table('institution_address', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });*/

        /*Schema::table('school', function (Blueprint $table) {
            $table->foreign('school_campus_id')->references('id')->on('school_campus');
            $table->foreign('address_id')->references('id')->on('addresses');
        });
        */

        /*Schema::table('departments', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('school');
        });*/

        /*Schema::table('users', function (Blueprint $table) {
            //$table->foreign('address_id')->references('id')->on('addresses');
            //$table->foreign('role_id')->references('id')->on('roles');
            //$table->foreign('department_id')->references('id')->on('departments');
        });*/

        /*Schema::table('events', function (Blueprint $table) {
            //$table->foreign('institution_id')->references('id')->on('institution');
            $table->foreign('created_by_used_id')->references('id')->on('users');
        });*/

        Schema::table('partners_projects', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('partner_id')->references('id')->on('partners');
        });

        Schema::table('project_researchers', function (Blueprint $table) {
           //$table->foreign('user_id')->references('id')->on('users');
           $table->foreign('project_id')->references('id')->on('projects');
        });

        /*Schema::table('user_phones', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });*/

        /*Schema::table('users_team', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('team_id')->references('id')->on('teams');
        });*/

        Schema::table('members_scientific_committees', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('scientific_committees_id')->references('id')->on('scientific_committees');
        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('all_relations');
        Schema::enableForeignKeyConstraints();
    }
}
