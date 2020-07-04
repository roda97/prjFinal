<?php

namespace App\CienciaVitaeClasses;

use Illuminate\Database\Eloquent\Model;

class CV_Outputs extends Model
{
    public $table = "cv_outputs";
    protected $fillable = [
        'user_science_id',

        'id_row_entry',
        'last_modified_date',
        'output_category_value',
        'output_category_code',
        'output_type_value',
        'output_type_code',

        //PATENTE

        'patent_title',
        'patent_date_issued_year',
        'patent_date_of_term_end_year',
        'patent_country',
        'patent_authors_citation',

        //FIM PATENTE

        //CAPITULO LIVRO

        'book_chapter_chapter_title',
        'book_chapter_title',
        'book_chapter_volume',
        'book_chapter_publication_year',
        'book_chapter_publication_location_country',
        'book_chapter_book_publisher',
        'book_chapter_url',
        'book_chapter_authors_citation',
        //FIM CAPITULO LIVRO

        //DISSERTATION (Tese)

        'dissertation_title',
        'dissertation_number_of_volumes',
        //'dissertation_institutions', // confirmar este
        'dissertation_degree_type_value',
        'dissertation_classification', 
        'dissertation_completion_date_year',
        'dissertation_url',
        'dissertation_authors_citation',

        //FIM DESSERTATION (Tese)

        //LICENCIAMENTO

        'license_title',
        'license_date_issued_year',
        'license_end_date',
        'license_country',
        'license_authors_citation',

        //FIM LICENCIAMENTO

        //RELATORIO:

        'report_title',
        'report_volume',
        'report_number_of_pages',
        'report_institutions_institution_institution_name',
        'report_date_submitted_year', 
        'report_authoring_role_value',
        'report_url',
        'report_authors',
        //FIM RELATORIO

        'journal_article_title',
        'journal_article_publication_date_year',
        'journal_article_publication_location',
        'journal_article_url',
        'journal_article_authors_citation',

        'book_title',
        'book_publication_year',
        'book_publication_location_country',
        'book_publisher',
        'book_url',
        'book_authors_citation',

        'conference_paper_paper_title',
        'conference_paper_conference_date_year',
        'conference_paper_conference_location_value',
        'conference_paper_proceedings_publisher',
        'conference_paper_authors',
        'other_output_title',
        'other_output_url',
        'other_output_authors_citation',
        'other_output_identifiers_identifier_identifier',
        'other_output_identifiers_identifier_identifier_type_code',
        'other_output_identifiers_identifier_identifier_type_value',
        'other_output_identifiers_identifier_relationship_type_code',
        'other_output_identifiers_identifier_relationship_type_value',
        'other_output_publication_date_year'
    ];

}
