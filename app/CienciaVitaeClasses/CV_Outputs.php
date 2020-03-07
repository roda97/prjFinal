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
        'conference_paper_publication_location_value',
        'conference_paper_proceedings_publisher',
        'conference_paper_authors',
        'conference_paper_conference_date_year',
        'conference_paper_publication_location_value',
        'conference_paper_proceedings_publisher',
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
