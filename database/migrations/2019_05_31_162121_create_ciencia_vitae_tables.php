<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCienciaVitaeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_degrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('degree_id')->nullable();          
            $table->string('degree_type_value')->nullable();
            $table->string('degree_type_code')->nullable();
            $table->string('degree_code_value')->nullable();
            $table->string('degree_code_speciality_code')->nullable();
            $table->string('degree_name')->nullable();

            $table->string('institution_name')->nullable();
            $table->string('institution_city')->nullable();
            $table->string('institution_country')->nullable();
            $table->string('degree_major')->nullable();
            $table->string('degree_status_value')->nullable();
            $table->string('degree_status_code')->nullable();
            $table->string('description')->nullable();

            $table->string('degree_end_date')->nullable();
            $table->string('privacy_level')->nullable();
            $table->string('research_classifications')->nullable();
            $table->string('source_name')->nullable();
            $table->string('start_date')->nullable();
            $table->string('thesis')->nullable();
            $table->string('last_modified_date')->nullable();
            

            $table->timestamps();
        });

        Schema::create('cv_authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('identifier_type_code')->nullable();
            $table->string('identifier_type_value')->nullable();
            $table->string('identifier')->nullable();
            $table->string('id_row_entry')->nullable();
            $table->string('privacy_level')->nullable();
            $table->string('source_name')->nullable();
            //$table->string('last_modified_date')->nullable();
            $table->dateTime('last_modified_date')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_citations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('value')->nullable();
            $table->string('id_row_entry')->nullable();
            $table->string('privacy_level')->nullable();
            $table->string('source_name')->nullable();
            $table->string('last_modified_date')->nullable();
            $table->string('preferred_citation_name')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_employments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('employment_category_value')->nullable();
            $table->string('employment_category_other_value')->nullable();
            $table->string('employment_category_code')->nullable();
            $table->string('institution_institution_name')->nullable();
            $table->string('institution_institution_address_city')->nullable();
            $table->string('institution_institution_address_region')->nullable();
            $table->string('institution_institution_address_country_code')->nullable();
            $table->string('institution_institution_address_country_value')->nullable();
            $table->string('institution_institution_sector_code')->nullable();
            $table->string('institution_institution_sector_value')->nullable();
            $table->string('institution_institution_identifier_type')->nullable();
            $table->string('institution_institution_identifier_identifier')->nullable();
            $table->string('other_identifiers_institution_identifier_type_0')->nullable();
            $table->string('other_identifiers_institution_identifier_type_1')->nullable();
            $table->string('position_type_value')->nullable();
            $table->string('position_type_other_value')->nullable();
            $table->string('position_type_code')->nullable();
            $table->string('position_title_code')->nullable();
            $table->string('position_title_value')->nullable();
            $table->string('position_title_group_code')->nullable();
            $table->string('position_title_group_value')->nullable();
            $table->string('start_date_year')->nullable();
            $table->string('end_date_year')->nullable();
            $table->string('id_row_entry')->nullable();
            $table->string('privacy_level')->nullable();
            $table->string('source_name')->nullable();
            $table->string('last_modified_date')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('fundings_outputs')->nullable();
            $table->string('employments_services')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_language_competencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('language_code')->nullable();
            $table->string('language_value')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('read_value')->nullable();
            $table->string('read_code')->nullable();
            $table->string('write_value')->nullable();
            $table->string('write_code')->nullable();
            $table->string('speak_value')->nullable();
            $table->string('speak_code')->nullable();
            $table->string('understand_spoken_value')->nullable();
            $table->string('understand_spoken_code')->nullable();
            $table->string('privacy_level')->nullable();
            $table->string('peer_review')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_mailingaddresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('address_type_value')->nullable();
            $table->string('address_type_code')->nullable();
            $table->string('street_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('province_state')->nullable();
            $table->string('country_value')->nullable();
            $table->string('country_code')->nullable();
            $table->string('last_modified_date')->nullable();
            $table->string('preferred_mailing_address')->nullable();
            $table->string('privacy_level')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('id_row_entry')->nullable();
            $table->string('last_modified_date')->nullable();
            $table->string('output_category_value')->nullable();
            $table->string('output_category_code')->nullable();
            $table->string('output_type_value')->nullable();
            $table->string('output_type_code')->nullable();

            $table->string('journal_article_title')->nullable();
            $table->string('journal_article_publication_date_year')->nullable();
            $table->string('journal_article_publication_location')->nullable();
            $table->string('journal_article_url')->nullable();
            $table->string('journal_article_authors_citation')->nullable();

            $table->string('book_title')->nullable();
            $table->string('book_publication_year')->nullable();
            $table->string('book_publication_location_country')->nullable();
            $table->string('book_publisher')->nullable();
            $table->string('book_url')->nullable();
            $table->string('book_authors_citation')->nullable();

            //PATENTE

            $table->text('patent_title')->nullable();
            $table->text('patent_date_issued_year')->nullable();
            $table->text('patent_date_of_term_end_year')->nullable();
            $table->text('patent_country')->nullable();
            $table->text('patent_authors_citation')->nullable();

            //FIM PATENTE

            //CAPITULO LIVRO

            $table->string('book_chapter_chapter_title')->nullable();
            $table->string('book_chapter_title')->nullable();
            $table->string('book_chapter_volume')->nullable();
            $table->string('book_chapter_publication_year')->nullable();
            $table->string('book_chapter_publication_location_country')->nullable();
            $table->string('book_chapter_book_publisher')->nullable();
            $table->string('book_chapter_url')->nullable();
            $table->string('book_chapter_authors_citation')->nullable();
            //FIM CAPITULO LIVRO

            //DISSERTATION (Tese)

            $table->string('dissertation_title')->nullable();
            $table->string('dissertation_number_of_volumes')->nullable();
            //$table->string('dissertation_institutions', // confirmar este
            $table->string('dissertation_degree_type_value')->nullable();
            $table->string('dissertation_classification')->nullable(); 
            $table->string('dissertation_completion_date_year')->nullable();
            $table->string('dissertation_url')->nullable();
            $table->string('dissertation_authors_citation')->nullable();

            //FIM DESSERTATION (Tese)

            //LICENCIAMENTO

            $table->string('license_title')->nullable();
            $table->string('license_date_issued_year')->nullable();
            $table->string('license_end_date')->nullable();
            $table->string('license_country')->nullable();
            $table->string('license_authors_citation')->nullable();

            //FIM LICENCIAMENTO

            $table->string('report_title')->nullable();
            $table->string('report_volume')->nullable();
            $table->string('report_number_of_pages')->nullable();
            $table->string('report_institutions_institution_institution_name')->nullable();
            $table->string('report_date_submitted_year')->nullable(); 
            $table->string('report_authoring_role_value')->nullable();
            $table->string('report_url')->nullable();
            $table->string('report_authors')->nullable();

            $table->string('conference_paper_paper_title')->nullable();
            $table->string('conference_paper_conference_date_year')->nullable();
            $table->string('conference_paper_conference_location_value')->nullable();
            $table->string('conference_paper_proceedings_publisher')->nullable();
            $table->string('conference_paper_authors')->nullable();

            $table->string('other_output_title')->nullable();
            $table->string('other_output_url')->nullable();
            $table->string('other_output_authors_citation')->nullable();
            $table->string('other_output_identifiers_identifier_identifier')->nullable();
            $table->string('other_output_identifiers_identifier_identifier_type_code')->nullable();
            $table->string('other_output_identifiers_identifier_identifier_type_value')->nullable();
            $table->string('other_output_identifiers_identifier_relationship_type_code')->nullable();
            $table->string('other_output_identifiers_identifier_relationship_type_value')->nullable();
            $table->string('other_output_publication_date_year')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_person_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('full_name')->nullable();
            $table->string('names')->nullable();
            $table->string('surnames')->nullable();
            $table->string('presented_name')->nullable();
            $table->string('date_of_birth_year')->nullable();
            $table->string('date_of_birth_month')->nullable();
            $table->string('date_of_birth_day')->nullable();
            $table->string('gender_value')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('usage_type_code')->nullable();
            $table->string('usage_type_value')->nullable();
            $table->string('phone_type_code')->nullable();
            $table->string('phone_type_value')->nullable();
            $table->string('country_code')->nullable();
            $table->string('local_number')->nullable();
            $table->string('id_row_entry')->nullable();
            $table->string('preferred_phone_number')->nullable();
            $table->string('last_modified_date')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('api_user_name')->nullable();
            $table->string('api_user_privacy_level_code')->nullable();
            $table->string('api_user_privacy_level_value')->nullable();
            $table->string('api_user_role_code')->nullable();
            $table->string('api_user_role_value')->nullable();

            $table->string('api_user_url')->nullable();
            $table->string('privilege_ciencia_id')->nullable();
            $table->string('privilege_effective_privacy_level_code')->nullable();
            $table->string('privilege_effective_privacy_level_value')->nullable();
            $table->string('privilege_effective_role_code')->nullable();
            $table->string('privilege_effective_role_value')->nullable();

            $table->timestamps();

        });

        Schema::create('cv_webs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_science_id')->nullable();

            $table->string('site_type_code')->nullable();
            $table->string('site_type_value')->nullable();
            $table->string('url')->nullable();
            $table->string('id_row_entry')->nullable();
            $table->string('last_modified_date')->nullable();

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
        Schema::dropIfExists('cv_degrees');
        Schema::dropIfExists('cv_authors');
        Schema::dropIfExists('cv_citations');
        Schema::dropIfExists('cv_employments');
        Schema::dropIfExists('cv_groups');
        Schema::dropIfExists('cv_language_competencies');
        Schema::dropIfExists('cv_mailingaddresses');
        Schema::dropIfExists('cv_outputs');
        Schema::dropIfExists('cv_person_infos');
        Schema::dropIfExists('cv_phones');
        Schema::dropIfExists('cv_privileges');
        Schema::dropIfExists('cv_webs');
        Schema::enableForeignKeyConstraints();
    }
}
