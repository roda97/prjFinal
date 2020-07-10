<?php

namespace App\Http\Controllers\CienciaVitaeControllers;

use App\MemberRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use App\CienciaVitaeClasses\CV_Outputs;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\CienciaVitaeResources\CV_OutputsResource;

class CV_OutputsController extends Controller
{
    public function getAll()
    {
        $user = auth('api')->user()->science_id;
        $outputs = CV_OutputsResource::collection(CV_Outputs::where('user_science_id',$user)->get());

        return $outputs;
    }

    public function deleteDadosDatabase($id){
        $output = CV_Outputs::where('user_science_id' , $id)->delete();

        return 1;
    }

    public function saveCienciaVitaeToLocalDataBase(Request $request)
    {
        //$output = CV_Outputs::where('user_science_id' , $request->user_science_id)->delete();

        $output = CV_Outputs::updateOrCreate(
            [
                //'user_science_id' => auth('api')->user()->science_id,
                //'user_science_id' => null,
                'user_science_id' => $request->user_science_id,

                'id_row_entry' => $request->id_row_entry,
                'last_modified_date' => $request->last_modified_date,
                'output_category_value' => $request->output_category_value,
                'output_category_code' => $request->output_category_code,
                'output_type_value' => $request->output_type_value,
                'output_type_code' => $request->output_type_code,

                //PATENTE

                'patent_title' => $request->patent_title,
                'patent_date_issued_year' => $request->patent_date_issued_year,
                'patent_date_of_term_end_year' => $request->patent_date_of_term_end_year,
                'patent_country' => $request->patent_country,
                'patent_authors_citation' => $request->patent_authors_citation,

                //FIM PATENTE

                //CAPITULO LIVRO

                'book_chapter_chapter_title' => $request->book_chapter_chapter_title,
                'book_chapter_title' => $request->book_chapter_title,
                'book_chapter_volume' => $request->book_chapter_volume,
                'book_chapter_publication_year' => $request->book_chapter_publication_year,
                'book_chapter_publication_location_country' => $request->book_chapter_publication_location_country,
                'book_chapter_book_publisher' => $request->book_chapter_book_publisher,
                'book_chapter_url' => $request->book_chapter_url,
                'book_chapter_authors_citation' => $request->book_chapter_authors_citation,
                //FIM CAPITULO LIVRO

                //DISSERTATION (Tese)

                'dissertation_title' => $request->dissertation_title,
                'dissertation_number_of_volumes' => $request->dissertation_number_of_volumes,
                //'dissertation_institutions', // confirmar este
                'dissertation_degree_type_value' => $request->dissertation_degree_type_value,
                'dissertation_classification' => $request->dissertation_classification, 
                'dissertation_completion_date_year' => $request->dissertation_completion_date_year,
                'dissertation_url' => $request->dissertation_url,
                'dissertation_authors_citation' => $request->dissertation_authors_citation,

                //FIM DESSERTATION (Tese)

                //LICENCIAMENTO

                'license_title' => $request->license_title,
                'license_date_issued_year' => $request->license_date_issued_year,
                'license_end_date' => $request->license_end_date,
                'license_country' => $request->license_country,
                'license_authors_citation' => $request->license_authors_citation,

                //FIM LICENCIAMENTO

                //RELATORIO:

                'report_title' => $request->report_title,
                'report_volume' => $request->report_volume,
                'report_number_of_pages' => $request->report_number_of_pages,
                'report_institutions_institution_institution_name' => $request->report_institutions_institution_institution_name,
                'report_date_submitted_year' => $request->report_date_submitted_year, 
                'report_authoring_role_value' => $request->report_authoring_role_value,
                'report_url' => $request->report_url,
                'report_authors' => $request->report_authors, 
                //FIM RELATORIO

                'journal_article_title' => $request->journal_article_title,
                'journal_article_publication_date_year' => $request->journal_article_publication_date_year,
                'journal_article_publication_location' => $request->journal_article_publication_location,
                'journal_article_url' => $request->journal_article_url,
                'journal_article_authors_citation' => $request->journal_article_authors_citation,

                'book_title' => $request->book_title,
                'book_publication_year' => $request->book_publication_year,
                'book_publication_location_country' => $request->book_publication_location_country,
                'book_publisher' => $request->book_publisher,
                'book_url' => $request->book_url,

                'book_authors_citation' => $request->book_authors_citation,

                'conference_paper_paper_title' => $request->conference_paper_paper_title,
                'conference_paper_conference_date_year' => $request->conference_paper_conference_date_year,
                'conference_paper_conference_location_value' => $request->conference_paper_conference_location_value,
                'conference_paper_proceedings_publisher' => $request->conference_paper_proceedings_publisher,
                'conference_paper_authors' => $request->conference_paper_authors,

                'other_output_title' => $request->other_output_title,
                'other_output_url' => $request->other_output_url,
                'other_output_authors_citation' => $request->other_output_authors_citation,
                'other_output_identifiers_identifier_identifier' => $request->other_output_identifiers_identifier_identifier,
                'other_output_identifiers_identifier_identifier_type_code' => $request->other_output_identifiers_identifier_identifier_type_code,
                'other_output_identifiers_identifier_identifier_type_value' => $request->other_output_identifiers_identifier_identifier_type_value,
                'other_output_identifiers_identifier_relationship_type_code' => $request->other_output_identifiers_identifier_relationship_type_code,
                'other_output_identifiers_identifier_relationship_type_value' => $request->other_output_identifiers_identifier_relationship_type_value,
                'other_output_publication_date_year' => $request->other_output_publication_date_year,
            ]
        );

        return new CV_OutputsResource($output);
    }

    public function getLowestYearBook()
    {
        return CV_Outputs::min('book_publication_year');
    }

    public function getLowestYearArticle()
    {
        return CV_Outputs::min('journal_article_publication_date_year');
    }

    public function getLowestYearConference()
    {
        return CV_Outputs::min('conference_paper_conference_date_year');
    }

    public function getLowestYearOther()
    {
        return CV_Outputs::min('other_output_publication_date_year');
    }

    public function getHighestYearBook()
    {
        return CV_Outputs::all()
            ->where('book_publication_year', '<>', "Not defined.")
            ->sortByDesc('book_publication_year')
            ->first()->book_publication_year;
    }

    public function getHighestYearArticle()
    {
        return CV_Outputs::all()
            ->where('journal_article_publication_date_year', '<>', "Not defined.")
            ->sortByDesc('journal_article_publication_date_year')
            ->first()->journal_article_publication_date_year;
    }

    public function getHighestYearConference()
    {
        return CV_Outputs::all()
            ->where('conference_paper_conference_date_year', '<>', "Not defined.")
            ->sortByDesc('conference_paper_conference_date_year')
            ->first()->conference_paper_conference_date_year;
    }

    private function getHighestYearOther()
    {
        return CV_Outputs::all()
            ->where('other_output_publication_date_year', '<>', "Not defined.")
            ->sortByDesc('other_output_publication_date_year')
            ->first()->other_output_publication_date_year;
    }

    private function getHighestYearAll()
    {
        return date("Y");
    }

    private function getOutputsByYear()
    {

        $array_cv = [];
        $array_cv["lowest_year"] = 9999;

        $lowest_other = CV_Outputs::
            where('other_output_publication_date_year', '<>', "Not defined.")
            ->orderBy('other_output_publication_date_year', 'asc')->get();

        $years = [];

        for ($i = 0; $i < count($lowest_other); $i++) {
            array_push($years, $lowest_other[$i]->other_output_publication_date_year);

            if ($lowest_other[$i]->other_output_publication_date_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $array_cv["lowest_year"] + $lowest_other[$i]->other_output_publication_date_year;
            }
        }

        $lowest_reports = CV_Outputs::
        where('report_date_submitted_year', '<>', "Not defined.")
        ->orderBy('report_date_submitted_year', 'asc')->get();

        $years2 = $years;

        for ($i = 0; $i < count($lowest_reports); $i++) {
            array_push($years2, $lowest_reports[$i]->report_date_submitted_year);

            if ($lowest_reports[$i]->report_date_submitted_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $array_cv["lowest_year"] + $lowest_reports[$i]->report_date_submitted_year;
            }
        }

        $lowest_licenses = CV_Outputs::
        where('license_date_issued_year', '<>', "Not defined.")
        ->orderBy('license_date_issued_year', 'asc')->get();

        $years3 = $years2;

        for ($i = 0; $i < count($lowest_licenses); $i++) {
            array_push($years3, $lowest_licenses[$i]->license_date_issued_year);

            if ($lowest_licenses[$i]->license_date_issued_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $array_cv["lowest_year"] + $lowest_licenses[$i]->license_date_issued_year;
            }
        }

        $lowest_chapterBook = CV_Outputs::
        where('book_chapter_publication_year', '<>', "Not defined.")
        ->orderBy('book_chapter_publication_year', 'asc')->get();

        $years4 = $years3; 
        

        for ($i = 0; $i < count($lowest_chapterBook); $i++) {
            array_push($years4, $lowest_chapterBook[$i]->book_chapter_publication_year);

            if ($lowest_chapterBook[$i]->book_chapter_publication_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $array_cv["lowest_year"] + $lowest_chapterBook[$i]->book_chapter_publication_year;
            }
        }

        $lowest_dissertation = CV_Outputs::
        where('dissertation_completion_date_year', '<>', "Not defined.")
        ->orderBy('dissertation_completion_date_year', 'asc')->get();

        $years5 = $years4;

        for ($i = 0; $i < count($lowest_dissertation); $i++) {
            array_push($years5, $lowest_dissertation[$i]->dissertation_completion_date_year);

            if ($lowest_dissertation[$i]->dissertation_completion_date_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $array_cv["lowest_year"] + $lowest_dissertation[$i]->dissertation_completion_date_year;
            }
        }

        $lowest_patent = CV_Outputs::
        where('patent_date_issued_year', '<>', "Not defined.")
        ->orderBy('patent_date_issued_year', 'asc')->get();

        $years6 = $years5;

        for ($i = 0; $i < count($lowest_patent); $i++) {
            array_push($years6, $lowest_patent[$i]->patent_date_issued_year);

            if ($lowest_patent[$i]->patent_date_issued_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $array_cv["lowest_year"] + $lowest_patent[$i]->patent_date_issued_year;
            }
        }

        $n_occurrences_others = array_count_values($years6);
        $array_cv["others"] = $n_occurrences_others;

        /////////////////////////////

        $lowest_article = CV_Outputs::
            where('journal_article_publication_date_year', '<>', "Not defined.")
            ->orderBy('journal_article_publication_date_year', 'asc')->get();

        $years = [];

        for ($i = 0; $i < count($lowest_article); $i++) {
            array_push($years, $lowest_article[$i]->journal_article_publication_date_year);

            if ($lowest_article[$i]->journal_article_publication_date_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $lowest_article[$i]->journal_article_publication_date_year;
            }
        }

        $n_occurrences_articles = array_count_values($years);
        $array_cv["articles"] = $n_occurrences_articles;

        $lowest_conference = CV_Outputs::
            where('conference_paper_conference_date_year', '<>', "Not defined.")
            ->orderBy('conference_paper_conference_date_year', 'asc')->get();

        $years = [];

        for ($i = 0; $i < count($lowest_conference); $i++) {
            array_push($years, $lowest_conference[$i]->conference_paper_conference_date_year);

            if ($lowest_conference[$i]->conference_paper_conference_date_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $lowest_conference[$i]->conference_paper_conference_date_year;
            }
        }

        $n_occurrences_conferences = array_count_values($years);
        $array_cv["conferences"] = $n_occurrences_conferences;

        $lowest_book = CV_Outputs::
            where('book_publication_year', '<>', "Not defined.")
            ->orderBy('book_publication_year', 'asc')->get();

        $years = [];

        for ($i = 0; $i < count($lowest_book); $i++) {
            array_push($years, $lowest_book[$i]->book_publication_year);

            if ($lowest_book[$i]->book_publication_year < $array_cv["lowest_year"]) {
                $array_cv["lowest_year"] = $lowest_book[$i]->book_publication_year;
            }
        }

        $n_occurrences_books = array_count_values($years);
        $array_cv["books"] = $n_occurrences_books;

        return $array_cv;
    }

    public function generateStatistics()
    {

        //$science_id = auth('api')->user()->science_id;

      //  $science_id = 1;
        $data["statistics"] = $this->getOutputsByYear();
        $data["statistics"]["highest_year"] = $this->getHighestYearAll();

        return response()->json($data);
    }

    public function countOutputsByType()
    {

        $others = CV_Outputs::
            where('other_output_publication_date_year', '<>', "Not defined.")
            ->get();

        $articles = CV_Outputs::
            where('journal_article_publication_date_year', '<>', "Not defined.")
            ->get();

        $books = CV_Outputs::
            where('book_publication_year', '<>', "Not defined.")
            ->get();

        $conferences = CV_Outputs::
            where('conference_paper_conference_date_year', '<>', "Not defined.")
            ->get();
        
        $reports = CV_Outputs::
            where('report_date_submitted_year', '<>', "Not defined.")
            ->get();
        
        $licenses = CV_Outputs::
            where('license_date_issued_year', '<>', "Not defined.")
            ->get();
        
        $chapterBook = CV_Outputs::
            where('book_chapter_publication_year', '<>', "Not defined.")
            ->get();

        $dissertation = CV_Outputs::
            where('dissertation_completion_date_year', '<>', "Not defined.")
            ->get();
        
        $patent = CV_Outputs::
            where('patent_date_issued_year', '<>', "Not defined.")
            ->get();
        
        $othersTotal = count($others) + count($reports) + count($licenses) + count($chapterBook) + count($dissertation) + count($patent);

        //return response()->json($othersTotal,402);
        $array_cv["number_of_others"] = $othersTotal;
        $array_cv["number_of_articles"] = count($articles);
        $array_cv["number_of_books"] = count($books);
        $array_cv["number_of_conferences"] = count($conferences);

        return response()->json($array_cv);
    }

    public function getAllOutputsAndAuthors()
    {

        $books = CV_Outputs::
            where('output_type_code', '=', "P103") // livro
            ->get();

        $number_of_books = count($books);

        $outputs = [];

        for ($i = 0; $i < $number_of_books; $i++) {
            array_push($outputs, array('User Science Id' =>$books[$i]->user_science_id,
                'Title' => $books[$i]->book_title,
                'Publication date' => $books[$i]->book_publication_year,
                'Authors' => $books[$i]->book_authors_citation,
                'Type' => $books[$i]->output_type_value,
                //só para o copy:
                'Publication Location' => $books[$i]->book_publication_location_country,
                'Publisher' => $books[$i]->book_publisher));
        }

        //----------- articles

        $articles = CV_Outputs::
            where('output_type_code', '=', "P101") // artigo
            ->get();

        $number_of_articles = count($articles);

        for ($i = 0; $i < $number_of_articles; $i++) {
            array_push($outputs, array('User Science Id' =>$articles[$i]->user_science_id,
                'Title' => $articles[$i]->journal_article_title,
                'Publication date' => $articles[$i]->journal_article_publication_date_year,
                'Authors' => $articles[$i]->journal_article_authors_citation,
                'Type' => $articles[$i]->output_type_value,
                //só para o copy:
                'Url' => $articles[$i]->journal_article_url));
        }

        //----------- conferences

        $conferences = CV_Outputs::
            where('output_type_code', '=', "P122") // conferences
            ->get();

        $number_of_conferences = count($conferences);

        for ($i = 0; $i < $number_of_conferences; $i++) {
            array_push($outputs, array('User Science Id' =>$conferences[$i]->user_science_id,
                'Title' => $conferences[$i]->conference_paper_paper_title,
                'Publication date' => $conferences[$i]->conference_paper_conference_date_year,
                'Authors' => $conferences[$i]->conference_paper_authors,
                'Type' => $conferences[$i]->output_type_value,
                //só para o copy:
                'Conference Location' => $conferences[$i]->conference_paper_conference_location_value,
                'Proceedings Publisher' => $conferences[$i]->conference_paper_proceedings_publisher));
        }

        //----------- others

        $others = CV_Outputs::
            where('output_type_code', '=', "P508") // others
            ->get();

        $number_of_others = count($others);

        for ($i = 0; $i < $number_of_others; $i++) {
            array_push($outputs, array('User Science Id' =>$others[$i]->user_science_id,
                'Title' => $others[$i]->other_output_title,
                'Publication date' => $others[$i]->other_output_publication_date_year,
                'Authors' => $others[$i]->other_output_authors_citation,
                'Type' => $others[$i]->output_type_value,
                //só para o copy:
                'Url' => $others[$i]->other_output_url));
        }

        //----------- relatorio

        $relatorios = CV_Outputs::
            where('output_type_code', '=', "P115") // relatorios
            ->get();
        
        $number_of_relatorios = count($relatorios);

        for ($i = 0; $i < $number_of_relatorios; $i++) {
            array_push($outputs, array('User Science Id' =>$relatorios[$i]->user_science_id,
                'Title' => $relatorios[$i]->report_title,
                'Publication date' => $relatorios[$i]->report_date_submitted_year,
                'Authors' => $relatorios[$i]->report_authors,
                'Type' => $relatorios[$i]->output_type_value,
                //só para o copy:
                'Institution' => $relatorios[$i]->report_institutions_institution_institution_name,
                'Authoring' => $relatorios[$i]->report_authoring_role_value,
                'Url' => $relatorios[$i]->report_url));
        }    

        //----------- tese / dissertação

        $teses = CV_Outputs::
        where('output_type_code', '=', "P108") // teses
        ->get();
    
        $number_of_teses = count($teses);

        for ($i = 0; $i < $number_of_teses; $i++) {
            array_push($outputs, array('User Science Id' =>$teses[$i]->user_science_id,
                'Title' => $teses[$i]->dissertation_title,
                'Publication date' => $teses[$i]->dissertation_completion_date_year,
                'Authors' => $teses[$i]->dissertation_authors_citation,
                'Type' => $teses[$i]->output_type_value,
                //só para o copy:
                'Degree' => $teses[$i]->dissertation_degree_type_value,
                'Classification' => $teses[$i]->dissertation_classification,
                'Url' => $teses[$i]->dissertation_url));
        }  

        //----------- license / licenciamento

        $licenciamentos = CV_Outputs::
        where('output_type_code', '=', "P402") // licenciamentos
        ->get();
    
        $number_of_licenciamentos = count($licenciamentos);

        for ($i = 0; $i < $number_of_licenciamentos; $i++) {
            array_push($outputs, array('User Science Id' =>$licenciamentos[$i]->user_science_id,
                'Title' => $licenciamentos[$i]->license_title,
                'Publication date' => $licenciamentos[$i]->license_date_issued_year,
                'Authors' => $licenciamentos[$i]->license_authors_citation,
                'Type' => $licenciamentos[$i]->output_type_value,
                //só para o copy:
                'Date issued' => $licenciamentos[$i]->license_date_issued_year,
                'End Date' => $licenciamentos[$i]->license_end_date,
                'License Country' => $licenciamentos[$i]->license_country));
        }  

        //----------- Patente

        $patentes = CV_Outputs::
        where('output_type_code', '=', "P401") // patentes
        ->get();
    
        $number_of_patentes = count($patentes);

        for ($i = 0; $i < $number_of_patentes; $i++) {
            array_push($outputs, array('User Science Id' =>$teses[$i]->user_science_id,
                'Title' => $patentes[$i]->patent_title,
                'Publication date' => $patentes[$i]->patent_date_issued_year,
                'Authors' => $patentes[$i]->patent_authors_citation,
                'Type' => $patentes[$i]->output_type_value,
                //só para o copy:
                'Date of term end' => $patentes[$i]->patent_date_of_term_end_year,
                'Country' => $patentes[$i]->patent_country
            ));
        }  

        //----------- Capitulo de livro

        $capitulos = CV_Outputs::
        where('output_type_code', '=', "P105") // capitulos
        ->get();
    
        $number_of_capitulos = count($capitulos);

        for ($i = 0; $i < $number_of_capitulos; $i++) {
            array_push($outputs, array('User Science Id' =>$capitulos[$i]->user_science_id,
                'Title' => $capitulos[$i]->book_chapter_chapter_title,
                'Publication date' => $capitulos[$i]->book_chapter_publication_year,
                'Authors' => $capitulos[$i]->book_chapter_authors_citation,
                'Type' => $capitulos[$i]->output_type_value,
                //só para o copy:
                'Book Title' => $capitulos[$i]->book_chapter_title,
                'Publication Location' => $capitulos[$i]->book_chapter_publication_location_country,
                'Publisher' => $capitulos[$i]->book_chapter_book_publisher,
                'Url'=> $capitulos[$i]->book_chapter_url));
        }  
        //$json = json_encode($outputs);

        return $outputs;
    }

    public function searchPermission(){
        $id = auth('api')->user()->id;

        $roles = array();
        $roles = (array)DB::table('user_roles as s')
        ->select('s.*')
        ->leftJoin('user_roles as s1', function ($join) {
              $join->on('s.user_id', '=', 's1.user_id')
                   ->whereRaw(DB::raw('s.updated_at < s1.updated_at'));
         })
        ->whereNull('s1.role_id')
        ->get();

        $collection = collect($roles)->values();

        $size = count($collection[0]);
        $collection = json_decode( json_encode($collection), true); // sem esta linha conseguia aceder a $collection[0][$i] mas não conseguia aceder a $collection[0][$i]['user_id'] porque dava erro "Cannot use object of type stdClass as array"
        $user_role = 0;

        for($i=0; $i<$size; $i++){
            if($collection[0][$i]['user_id'] == $id)
            {
                $user_role = $collection[0][$i]['role_id'];
            }
        }
        $aux = 1;

        if($user_role == 6 || $user_role == 7){
            $aux = 0;
        }else{
            $aux = 1;
        }
        return $aux;
    }

    public function removeDuplicatesFromAllOutputsAndAuthors(Request $request)
    {
        $comissao_cientifica = $this->searchPermission();

        $id = auth('api')->user()->id;
        //$comissao_cientifica = MemberRoles::select('role_id')->where('user_id',$id)->get(); //vai buscar o membro com o id igual ao id que está logado
        $user = auth('api')->user()->science_id;
        $admin = auth('api')->user()->isAdmin;
        //return response()->json($comissao_cientifica[0]['role_id'],402);
        $outputs = $this->getAllOutputsAndAuthors();
        
        $collection = collect($outputs)->sortBy('Publication date')->keyBy('Title')->values();
        //return response()->json($collection[0]['Publication date'],402);
            if(count($request->except('page'))){
                //$collections = DB::table('cv_outputs')->get();
                //return response()->json($collections,402);

                if($request->filled('title')){
                    //$collection = collect($collection)->where('Title', $request->title);
                    $search = $request->title;
                    $collection = $collection->filter(function($item) use ($search) {
                        return stripos($item['Title'],$search) !== false;
                    });
                }

                if($request->filled('publication_date')){

                    $collection = $collection->where('Publication date', $request->publication_date);
                }

                if ($request->filled('type')){
                    $search = $request->type;
                    $collection = $collection->filter(function($item) use ($search) {
                        return stripos($item['Type'],$search) !== false;
                    });
                    //return response()->json($collection,402);
                }

                if ($request->filled('authors')){
                    //return response()->json(gettype($collection),402);
                    $search = $request->authors;
                    $collection = $collection->filter(function($item) use ($search) {
                        return stripos($item['Authors'],$search) !== false;
                    });
                }

                if ($request->filled('outputs')){
                    if($request->outputs == '0'){
                        $collection = $this->paginate($collection,5);
                    }
                    else{
                        $collection = $collection->where('User Science Id',$user);
                        $collection = $this->paginate($collection,5);
                    }
                }
                else{
                    //return response()->json($comissao_cientifica[0]['role_id'],402);
                    if($admin == 1 || $comissao_cientifica == 0){
                        $collection = $this->paginate($collection,5);
                        //return response()->json($comissao_cientifica[0]['role_id'],402);
                    }else{
                        $collection = $collection->where('User Science Id',$user);
                        $collection = $this->paginate($collection,5);
                    }
                }
                
                return $collection;
            }else{
                //return response()->json($comissao_cientifica[0]['role_id'],402);
                if($admin == 1 || $comissao_cientifica == 0){
                    $collection = $this->paginate($collection,5);
                }else{
                    $collection = $collection->where('User Science Id',$user);
                    $collection = $this->paginate($collection,5);
                }
                return $collection;
            }
        //}
            //se eu mudar o número "5" para outro, depois também tenho que alterar o número no vue para o mesmo que colocar aqui, se não, não assume as páginas necessárias
            //$collection = $this->paginate($collection,5); // é o que me permite ter paginação do outro lado, vai para a função paginate de baixo
            //teve que ser feito separado pois o comando da linha 315 não aceitava paginate no array e tirando o array

            //return $collection;

    }

    public function paginate($items, $perPage, $page = null, $options = []) { 
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1); 
        $items = $items instanceof Collection ? $items : Collection::make($items); 
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options); 
    }

    public function removeDuplicatesFromAllOutputsAndAuthors2()
    {
        $comissao_cientifica = $this->searchPermission();

        $user = auth('api')->user()->science_id;
        $admin = auth('api')->user()->isAdmin;

        $outputs = $this->getAllOutputsAndAuthors();

        $collection = collect($outputs)->sortBy('Publication date')->keyBy('Title')->values();

        if($admin == 1 || $comissao_cientifica == 0 ){

        }else{
            $collection = $collection->where('User Science Id',$user)->values(); // sem o values() não devolve array e sem ser array precisava de ser iterable por ter paginação
        }

        return $collection;

    }

    public function exportAllHome(){
        $outputs = CV_Outputs::all();

        $comissao_cientifica = $this->searchPermission();

        $user = auth('api')->user()->science_id;
        $admin = auth('api')->user()->isAdmin;

        if($admin == 1 || $comissao_cientifica == 0 ){

        }else{
            $outputs = $outputs->where('user_science_id',$user)->values(); // sem o values() não devolve array e sem ser array precisava de ser iterable por ter paginação
        }

        return $outputs;
    }

    public function getScienceId(){
        $user = auth('api')->user()->science_id;
        
        return $user;
    }
  

}
