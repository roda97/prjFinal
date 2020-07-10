<template>

<div class="container">
    <div v-if="lowest_year_of_checking_statistics != 9999">
        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <h4 class="text-center">All members: Outputs Statistics</h4>
            </b-card-header>
            <b-card-body>
                <div class="row">
                    <div class="col">
                        <OutputsByYearChart></OutputsByYearChart>
                    </div>
                    <div class="col">
                        <OutputsByTypeChart />
                    </div>
                </div>

            </b-card-body>
        </b-card>
    </div>
    <div v-else>
        <b-card no-body class="mb-1">
            <b-card-header header-tag="header" class="p-1" role="tab">
                <h4 class="text-center" style="color:red;">Please update outputs for statistics!</h4>
            </b-card-header>
        </b-card>
    </div>

    <!-- *********************** SEARCH ***********************  -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="title" class="form-control" placeholder="Title" v-model="search.title">               
                                </td> 
                                <td>
                                    <input type="text" name="publication_date" class="form-control" placeholder="Publication date" v-model="search.publication_date">               
                                </td> 
                                <td>
                                    <input type="text" name="authors" class="form-control" placeholder="Authors" v-model="search.authors">               
                                </td>   
                                <td>
                                    <input type="text" name="type" class="form-control" placeholder="Type" v-model="search.type">               
                                </td> 
                                <td v-if="this.aux == 0">
                                    <select name="outputs" class="form-control" v-model="search.outputs">
                                        <option value="" selected disabled> -- Outputs -- </option>
                                        <option value="0" >All</option>
                                        <option value="1" >Mine</option>
                                    </select>             
                                </td> 
                                <td>
                                    <button type="submit" class="btn btn-primary" v-on:click="filterOuputsAndAuthors()">Search</button>
                                </td>  
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        
    </div>

    <!-- *********************** FIM SEARCH ***********************  -->

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" align="center">
                    <h4 class="text-center">Outputs and Authors</h4>
                    <download-csv class="btn btn-dark" :data="this.data_to_csv" name="CIIC_DB_Outputs.csv">

                        <font color="white">EXPORT CIIC ALL OUTPUTS</font>

                    </download-csv>
                    <button class="btn btn-success" @click="bulkUpdateToDatabase()">BULK UPDATE: EVERY USERS OUTPUTS</button>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>

                                <th>
                                    <button
                                      type="button"
                                      class="btn btn-warning"
                                      @click="text_to_copy = formatAllRows()"
                                      data-toggle="modal"
                                      data-target="#copyAllRowsModal">Copy All</button>
                                </th>

                                <th>Title</th>
                                <th>Publication date</th>
                                <th>Authors</th>
                                <th>Type</th>

                            </tr>

                            <tr v-for="output in allOutputsWithoutDuplicateds" :key="output.Title">
                            <!--<div v-for="cv_output in cv_outputs" :key="cv_output.id">-->

                                <td>
                                <!--<td v-for="cv_output in cv_outputs" :key="cv_output.id">-->
                                    <!--<button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow(
                                       output.Authors,
                                       output['Publication date'],
                                       output.Title,
                                       output.Type
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>-->

                                    <span v-if="output.Type == 'Conference paper' ||output.Type == 'Artigo em conferência'">
                                    <button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow_conferece(
                                        output.Authors,
                                        output['Publication date'],
                                        output.Title,
                                        (output['Conference Location'] != 'Not defined.' ? output['Conference Location'] : null),
                                        (output['Proceedings Publisher'] != 'Not defined.' ? output['Proceedings Publisher'] : null),
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="output.Type == 'Other output' || output.Type == 'Outra produção'">
                                    <button
                                      type="button"
                                      class="btn btn-info"
                                      @click="text_to_copy = 
                                      formatRow_others(
                                        output.Authors,
                                        output['Publication date'],
                                        output.Title,
                                        (output.Url != 'Not defined.' ? output.Url : null)
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="output.Type == 'Journal article' || output.Type == 'Artigo em revista'">
                                    <button
                                      type="button"
                                      class="btn btn-danger"
                                      @click="text_to_copy = 
                                      formatRow_magazine(
                                        output.Authors,
                                        output['Publication date'],
                                        output.Title,
                                        (output.Url != 'Not defined.' ? output.Url : null)
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="output.Type == 'Book' || output.Type == 'Livro'" >
                                    <button
                                      type="button"
                                      class="btn btn-dark"
                                      @click="text_to_copy = 
                                      formatRow_book(
                                        output.Authors,
                                        output['Publication date'],
                                        output.Title,
                                        (output['Publication Location']  != 'Not defined.' ? output['Publication Location'] : null),
                                        (output.Publisher != 'Not defined.' ? output.Publisher : null),
                                        (output.Url != 'Not defined.' ? output.Url : null)
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="output.Type == 'Report' || output.Type == 'Relatório'">
                                    <button
                                      type="button"
                                      class="btn btn-primary"
                                      @click="text_to_copy = 
                                      formatRow_report(
                                        output.Authors,
                                        output['Publication date'],
                                        output.Title,
                                        (output.Institution != 'Not defined.' ? output.Institution : null),
                                        (output.Authoring != 'Not defined.' ? output.Authoring : null),
                                        (output.Url != 'Not defined.' ? output.Url : null)
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>

                                    <span v-if="output.Type == 'Dissertation' || output.Type == 'Tese / Dissertação'">
                                    <button
                                      type="button"
                                      class="btn btn-warning"
                                      @click="text_to_copy = 
                                      formatRow_dissertation(
                                        output.Authors,
                                        (output['Publication date'] != 'Not defined.' ? output['Publication date'] : null),
                                        (output.Title != 'Not defined.' ? output.Title : null),
                                        (output.Degree != 'Not defined.' ? output.Degree : null),
                                        (output.Classification != 'Not defined.' ? output.Classification : null),
                                        (output.Url != 'Not defined.' ? output.Url : null)
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>

                                    <span v-if="output.Type == 'License' || output.Type == 'Licenciamento'">
                                    <button
                                      type="button"
                                      class="btn btn-secondary"
                                      @click="text_to_copy = 
                                      formatRow_license(
                                        output.Authors,
                                        (output['Date issued'] != 'Not defined.' ? output['Date issued'] : null),
                                        (output['End Date'] != 'Not defined.' ? output['End Date'] : null),
                                        (output.Title != 'Not defined.' ? output.Title : null),
                                        (output['License Country'] != 'Not defined.' ? output['License Country'] : null),
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>

                                    <span v-if="output.Type == 'Book Chapter' || output.Type == 'Capítulo de livro'" >
                                    <button
                                      type="button"
                                      class="btn btn-outline-danger"
                                      @click="text_to_copy = 
                                      formatRow_bookChapter(
                                        output.Authors,
                                        (output['Publication date'] != 'Not defined.' ? output['Publication date'] : null),
                                        (output.Title != 'Not defined.' ? output.Title : null),
                                        (output['Book Title'] != 'Not defined.' ? output['Book Title'] : null),
                                        (output['Publication Location'] != 'Not defined.' ? output['Publication Location'] : null),
                                        (output.Publisher != 'Not defined.' ? output.Publisher : null),
                                        (output.Url != 'Not defined.' ? output.Url : null)
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="output.Type == 'Patent' || output.Type == 'Patente'">
                                    <button
                                      type="button"
                                      class="btn btn-outline-success"
                                      @click="text_to_copy = 
                                      formatRow_patent(
                                        output.Authors,
                                        (output['Publication date'] != 'Not defined.' ? output['Publication date'] : null),
                                        (output['Date of term end'] != 'Not defined.' ? output['Date of term end'] : null),
                                        (output.Title != 'Not defined.' ? output.Title : null),
                                        (output.Country != 'Not defined.' ? output.Country : null),
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>
                                    </td>
                                <!--</td>-->

                                <td>{{ output.Title }}</td>
                                <td>{{ output['Publication date'] }}</td>
                                <td>{{ output.Authors }}</td>
                                <td>{{ output.Type }}</td>
                            <!--</div>-->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        
        <!-- Paginação -->
        <div>
            <b-pagination  align="left" size="md-c"  v-model="page" :total-rows="total" :per-page="5" @input="removeDuplicatesFromAllOutputsAndAuthors(page)"></b-pagination>
            <br>            
        </div>
        <!-- Fim Paginação -->
    </div>

    <!-- ************************* MODAL PARA CADA LINHA INDIVIDUAL ************************* -->
    <div class="modal fade" id="copyRowModal" tabindex="-1" role="dialog" aria-labelledby="copyRowModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyRowModalLabel">Formatted Row</h5>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">
                        {{ this.text_to_copy }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button"
               class="btn btn-default"
               data-dismiss="modal">Close</button>
                    <span class="pull-right">
               <div>
                  <button class="btn btn-success" v-clipboard:copy="text_to_copy" v-clipboard:success="onCopy">
                  Copy Text
                  </button>
               </div>
            </span>
                </div>
            </div>
        </div>
    </div>
    <!-- ********************************************************************************** -->

    <!-- ************************* MODAL PARA TODAS AS LINHAS ************************* -->
    <div class="modal fade" id="copyAllRowsModal" tabindex="-1" role="dialog" aria-labelledby="copyAllRowsModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyAllRowsModalLabel">Formatted Row</h5>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">
                        {{ this.text_to_copy }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button"
               class="btn btn-default"
               data-dismiss="modal">Close</button>
                    <span class="pull-right">
               <div>
                  <button class="btn btn-warning" v-clipboard:copy="text_to_copy" v-clipboard:success="onCopy">
                  Copy All
                  </button>
               </div>
            </span>
                </div>
            </div>
        </div>
    </div>
    <!-- ********************************************************************************** -->

</div>
</template>

<script>
import Visualisation from '../charts/Visualisation.vue';
import OutputsByYearChart from '../charts/OutputsByYearChart.vue';

// novos
import OutputsByTypeChart from '../charts/OutputsByTypeChart.vue';

export default {
    components: {
        Visualisation,
        OutputsByYearChart,
        OutputsByTypeChart,

    },
    data() {
        return {
            search:{
                title: "",
                publication_date: "",
                authors: "",
                type: "",
                outputs:""
            },
            data_to_csv: [],
            aux:'',
            page:1,
            total:1,
            lowest_year_of_checking_statistics: '',
            isbulkUpdateFailed: false,
            science_ids: [],
            cv_outputs: [],
            text_to_copy: '',
            allOutputsWithoutDuplicateds: [],
            allOutputsWithoutDuplicateds2: [],
            text: `
          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
          richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
          brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
          tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
          assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
          wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher
          vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic
          synth nesciunt you probably haven't heard of them accusamus labore VHS.
        `
        }
    },
    methods: {
        loadOutputs() {
            axios.get('api/cv_outputs/exportAllHome')
                .then(response => {
                    this.data_to_csv = response.data;
                });
        },

        searchPermission(){
            axios.get('api/searchPermission')
                .then(response => {
                    this.aux = response.data;
                    //this.$store.commit("setSearchPermission", response.data);
                });
        },

        onCopy: function (e) {
            Swal.fire({
                type: 'success',
                title: 'Text Copied!',
                showConfirmButton: true,
            })
            this.text_to_copy = e.text;
        },

        formatRow(authors, publication_date, title, type) {
            return "[" + publication_date + "] [" + type + "]: " + title + "." + "\nAuthors: " + authors;
        },

        /*formatAllRows() {
            let aux = [];

            for (let output of this.allOutputsWithoutDuplicateds) {
                aux = aux +
                    this.formatRow(
                        output.Authors,
                        output['Publication date'],
                        output.Title,
                        output.Type
                    ) + "\n----\n";
            }

            return aux;

        },*/ 
        formatRow_patent(patent_authors, patent_date_issued_year, patent_end_date, patent_title, patent_country){
            return (patent_authors ? patent_authors + ". " : '') +  
            (patent_date_issued_year ? patent_date_issued_year + ". " : '') + 
            (patent_end_date ? patent_end_date + ". " : '') + 
            (patent_title ? patent_title + ". " : '') + 
            (patent_country ? patent_country + ". " : '');
        },

        formatRow_bookChapter(book_chapter_authors_citation , book__chapter_publication_year, book_chapter_chapter_title, book_chapter_title, book_chapter_publication_location_country_value, book_chapter_publisher, book_chapter_url) {
            return (book_chapter_authors_citation ? book_chapter_authors_citation + ". " : '') +  
            (book__chapter_publication_year ? book__chapter_publication_year + ". " : '') + 
            (book_chapter_chapter_title ? book_chapter_chapter_title + ". " : '') + 
            (book_chapter_title ? book_chapter_title + ". " : '') + 
            (book_chapter_publication_location_country_value ? book_chapter_publication_location_country_value + ". " : '') + 
            (book_chapter_publisher ? book_chapter_publisher + ". " : '') + 
            (book_chapter_url ? book_chapter_url + ". " : ''); 
        },

        formatRow_dissertation(dissertation_authors, dissertation_date_year, dissertation_title, dissertation_degree, dissertation_classification, dissertation_url){
            return (dissertation_authors ? dissertation_authors + ". " : '') +  
            (dissertation_date_year ? dissertation_date_year + ". " : '') + 
            (dissertation_title ? dissertation_title + ". " : '') + 
            (dissertation_degree ? dissertation_degree + ". " : '') + 
            (dissertation_classification ? dissertation_classification + ". " : '') + 
            (dissertation_url ? dissertation_url + ". " : '');
        },

        formatRow_license(license_authors, license_date_issued_year, license_end_date, license_title, license_country){
            return (license_authors ? license_authors + ". " : '') +  
            (license_date_issued_year ? license_date_issued_year + ". " : '') + 
            (license_end_date ? license_end_date + ". " : '') + 
            (license_title ? license_title + ". " : '') + 
            (license_country ? license_country + ". " : '');
        },

        formatRow_report(report_authors, report_date_year, report_title, report_instituition_name, report_authoring_role, report_url){
            return (report_authors ? report_authors + ". " : '') +  
            (report_date_year ? report_date_year + ". " : '') + 
            (report_title ? report_title + ". " : '') + 
            (report_instituition_name ? report_instituition_name + ". " : '') + 
            (report_authoring_role ? report_authoring_role + ". " : '') + 
            (report_url ? report_url + ". " : '');
        },

        formatRow_conferece (authors, year, paper_title, country, proceedings_publisher) {
            return (authors ? authors + ". " : '') + 
            year + ".\n" + '"' +  
            (paper_title ? paper_title + '". ' : '') + 
            (country ? country + ". " : '') + 
            (proceedings_publisher ? proceedings_publisher : '');
        },

        formatRow_others(other_output_authors_citation, other_output_publication_date_year, other_output_title, other_output_url) {
            return (other_output_authors_citation ? other_output_authors_citation + ". " : '') + 
            (other_output_publication_date_year ? other_output_publication_date_year + ". " : '') + 
            (other_output_title ? other_output_title + ". " : '') + 
            (other_output_url ? other_output_url : '');
        },

        formatRow_magazine(journal_article_authors_citation, journal_article_publication_date_year, journal_article_title, journal_article_url) {
            return (journal_article_authors_citation ? journal_article_authors_citation + ". " : '') +
                journal_article_publication_date_year + "." + ' "' +  
                (journal_article_title ? journal_article_title + '". ' : '') + 
                (journal_article_url ? journal_article_url  + "." : '');
        },

        formatRow_book(book_authors_citation , book_publication_year, book_title, book_publication_location_country_value, book_publisher, book_url) {
            return (book_authors_citation ? book_authors_citation + ". " : '') +  
            (book_publication_year ? book_publication_year + ". " : '') + 
            (book_title ? book_title + ". " : '') + 
            (book_publication_location_country_value ? book_publication_location_country_value + ". " : '') + 
            (book_publisher ? book_publisher + ". " : '') + 
            (book_url ? book_url + ". " : ''); 
        },

        formatAllRows() {
            let aux = "------------------------------ Artigo em Conferência ---------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                 if (output.Type == "Conference paper" || output.Type == "Artigo em conferência") {

                    aux = aux +
                        this.formatRow_conferece(
                            output.Authors,
                            output['Publication date'],
                            output.Title,
                            (output['Conference Location'] != 'Not defined.' ? output['Conference Location'] : null),
                            (output['Proceedings Publisher'] != 'Not defined.' ? output['Proceedings Publisher'] : null),
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n------------------------------ Artigo em revista ---------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {
                if (output.Type == "Journal article" || output.Type == "Artigo em revista") {
                    aux = aux +
                        this.formatRow_magazine(
                            output.Authors,
                            output['Publication date'],
                            output.Title,
                            (output.Url != 'Not defined.' ? output.Url : null)
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n---------------------------- Livro -----------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {
                if (output.Type == "Book" || output.Type == "Livro") {
                    aux = aux +
                        this.formatRow_book(
                            output.Authors,
                            output['Publication date'],
                            output.Title,
                            (output['Publication Location']  != 'Not defined.' ? output['Publication Location'] : null),
                            (output.Publisher != 'Not defined.' ? output.Publisher : null),
                            (output.Url != 'Not defined.' ? output.Url : null)
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Outra Produção -------------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                if (output.Type == "Other output" || output.Type == "Outra produção") {
                    aux = aux +
                        this.formatRow_others(
                            output.Authors,
                            output['Publication date'],
                            output.Title,
                            (output.Url != 'Not defined.' ? output.Url : null)
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Relatório -------------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                if (output.Type == "Report" || output.Type == "Relatório") {
                    aux = aux +
                        this.formatRow_report(
                            output.Authors,
                            output['Publication date'],
                            output.Title,
                            (output.Institution != 'Not defined.' ? output.Institution : null),
                            (output.Authoring != 'Not defined.' ? output.Authoring : null),
                            (output.Url != 'Not defined.' ? output.Url : null)
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Tese -------------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                if (output.Type == "Dissertation" || output.Type == "Tese / Dissertação") {
                    aux = aux +
                        this.formatRow_dissertation(
                            output.Authors,
                            (output['Publication date'] != 'Not defined.' ? output['Publication date'] : null),
                            (output.Title != 'Not defined.' ? output.Title : null),
                            (output.Degree != 'Not defined.' ? output.Degree : null),
                            (output.Classification != 'Not defined.' ? output.Classification : null),
                            (output.Url != 'Not defined.' ? output.Url : null)
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Licenciamento -------------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                if (output.Type == "License" || output.Type == "Licenciamento") {
                    aux = aux +
                        this.formatRow_license(
                            output.Authors,
                            (output['Date issued'] != 'Not defined.' ? output['Date issued'] : null),
                            (output['End Date'] != 'Not defined.' ? output['End Date'] : null),
                            (output.Title != 'Not defined.' ? output.Title : null),
                            (output['License Country'] != 'Not defined.' ? output['License Country'] : null),
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Patente -------------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                if (output.Type == "Patent" || output.Type == "Patente") {
                    aux = aux +
                        this.formatRow_patent(
                            output.Authors,
                            (output['Publication date'] != 'Not defined.' ? output['Publication date'] : null),
                            (output['Date of term end'] != 'Not defined.' ? output['Date of term end'] : null),
                            (output.Title != 'Not defined.' ? output.Title :null),
                            (output.Country != 'Not defined.' ? output.Country :null),
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Capítulo de livro -------------------------------\n\n";

            for (let output of this.allOutputsWithoutDuplicateds2) {

                if (output.Type == "Book Chapter" || output.Type == "Capítulo de livro") {
                    aux = aux +
                        this.formatRow_bookChapter(
                            output.Authors,
                            (output['Publication date'] != 'Not defined.' ? output['Publication date'] : null),
                            (output.Title != 'Not defined.' ? output.Title : null),
                            (output['Book Title'] != 'Not defined.' ? output['Book Title'] : null),
                            (output['Publication Location'] != 'Not defined.' ? output['Publication Location'] : null),
                            (output.Publisher != 'Not defined.' ? output.Publisher : null),
                            (output.Url != 'Not defined.' ? output.Url : null)
                        ) + "\n\n";
                }
            }

            return aux;

        },

        AllOutputsAndAuthors(){
          axios.get('api/statistics/removeDuplicatesFromAllOutputsAndAuthors2')
            //antes era axios.get e passou a axios.post porque quando se fazia search e se queria ver as restantes página, aquilo atualizava para as totais como se não houvesse filtros ativos
                .then(response => {
                    this.allOutputsWithoutDuplicateds2 = response.data;

                });  
        },

        removeDuplicatesFromAllOutputsAndAuthors(page) {
            axios.post('api/statistics/removeDuplicatesFromAllOutputsAndAuthors?page='+page, this.search)
            //antes era axios.get e passou a axios.post porque quando se fazia search e se queria ver as restantes página, aquilo atualizava para as totais como se não houvesse filtros ativos
                .then(response => {
                    this.allOutputsWithoutDuplicateds = response.data.data;
                    //para a paginação:
                    this.page = response.data.current_page;
                    this.total = response.data.total;
                });
        },

        filterOuputsAndAuthors(){
            axios.post('api/filter/removeDuplicatesFromAllOutputsAndAuthors', this.search)
                .then(response => {
                    this.allOutputsWithoutDuplicateds = response.data.data;
                    //para a paginação:
                    this.page = response.data.current_page;
                    this.total = response.data.total;
                });
        },

        getSciences() {
            axios.get('api/getSciences')
                .then(response => {
                    this.science_ids = response.data;
                    //console.log("O array recebido: " + this.science_ids);
                    //console.log("O array Length: " + this.science_ids.length);
                });
        },

        show() {
            for (let row of this.science_ids) {
                console.log("this.science_name: " + row);
            }

        },

        bulkUpdateToDatabase() {
            for (let id of this.science_ids) {
                axios.delete('api/cv_outputs/deleteDadosDatabase/' + id)
                .then(response => {
                    console.log("sucesso!")
                })
                .catch(function (error) {

                    console.log(error);
                    });
                this.loadOutputandSave(id);
            }
        },

        loadOutputandSave(id) {
            axios.get('api/cv_outputs/getRemoteCienciaVitaeOutputs_By_Id/' + id)
                .then(response => {
                    this.cv_outputs = response.data.output;
                    this.saveCienciaVitaeToLocalDataBase(id);
                    this.removeDuplicatesFromAllOutputsAndAuthors(1);
                    this.AllOutputsAndAuthors();
                    if (this.isbulkUpdateFailed) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Some information did not synched.',
                        })
                        this.isbulkUpdateFailed = false;
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'Local Outputs Updated!',
                            text: 'Updating statistics...',
                            showConfirmButton: true,
                        })
                        /*
                        if (this.lowest_year_of_checking_statistics == 9999) {
                            window.location.href = "/home";
                        }
                        */

                    }
                });
        },

        checkIfthereAreStatistics() {
            axios.get('api/statistics/')
                .then(response => {
                    //console.log("statistics:")
                    //console.log(response.data)
                    this.lowest_year_of_checking_statistics = response.data.statistics.lowest_year;
                    // if == 9999 there are no statistics
                });
        },

        saveCienciaVitaeToLocalDataBase(id) {

            for (let cv_output of this.cv_outputs) {

                axios({

                        method: 'post',
                        url: 'api/cv_save_outputs/saveCienciaVitaeToLocalDataBase',
                        data: {

                            'user_science_id': id,

                            'id_row_entry': cv_output['id'],
                            'last_modified_date': cv_output['last-modified-date'],
                            'output_category_value': cv_output['output-category']['value'],
                            'output_category_code': cv_output['output-category']['code'],
                            'output_type_value': cv_output['output-type']['value'],
                            'output_type_code': cv_output['output-type']['code'],

                            //PATENTE

                            'patent_title': (cv_output['patent'] &&
                                    cv_output['patent']['patent-title']) ?
                                cv_output['patent']['patent-title'] : "Not defined.",

                            'patent_date_issued_year': (cv_output['patent'] &&
                                    cv_output['patent']['date-issued'] &&
                                    cv_output['patent']['date-issued']['year']) ?
                                cv_output['patent']['date-issued']['year'] : "Not defined.",

                            'patent_date_of_term_end_year': (cv_output['patent'] &&
                                    cv_output['patent']['date-of-term-end'] &&
                                    cv_output['patent']['date-of-term-end']['year']) ?
                                cv_output['patent']['date-of-term-end']['year'] : "Not defined.",

                            'patent_country': (cv_output['patent'] &&
                                    cv_output['patent']['country'] &&
                                    cv_output['patent']['country']['value']) ?
                                cv_output['patent']['country']['value'] : "Not defined.",

                            'patent_authors_citation': (cv_output['patent'] &&
                                    cv_output['patent']['authors'] &&
                                    cv_output['patent']['authors']['citation']) ?
                                cv_output['patent']['authors']['citation'] : "Not defined.",

                            //FIM PATENTE

                            //CAPITULO LIVRO

                            'book_chapter_chapter_title': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['chapter-title']) ?
                            cv_output['book-chapter']['chapter-title'] : "Not defined.",

                            'book_chapter_title': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['book-title']) ?
                                cv_output['book-chapter']['book-title'] : "Not defined.",

                            'book_chapter_volume': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['book-volume']) ?
                            cv_output['book-chapter']['book-volume'] : "Not defined.",

                            'book_chapter_authors_citation': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['authors'] &&
                                    cv_output['book-chapter']['authors']['citation']) ?
                                cv_output['book-chapter']['authors']['citation'] : "Not defined.",

                            'book_chapter_publication_year': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['publication-year']) ?
                                cv_output['book-chapter']['publication-year'] : "Not defined.",

                            'book_chapter_publication_location_country': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['publication-location'] &&
                                    cv_output['book-chapter']['publication-location']['country'] &&
                                    cv_output['book-chapter']['publication-location']['country']['value']) ?
                                cv_output['book-chapter']['publication-location']['country']['value'] : "Not defined.",

                            'book_chapter_book_publisher': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['book-publisher']) ?
                                cv_output['book-chapter']['book-publisher'] : "Not defined.",

                            'book_chapter_url': (cv_output['book-chapter'] &&
                                    cv_output['book-chapter']['url']) ?
                                cv_output['book-chapter']['url'] : "Not defined.",

                            //FIM CAPITULO LIVRO

                            //DISSERTATION (Tese)

                            'dissertation_title': (cv_output['dissertation'] && 
                                cv_output['dissertation']['title']) ? 
                                cv_output['dissertation']['title'] : "Not defined.",

                            'dissertation_number_of_volumes': (cv_output['dissertation'] && 
                                cv_output['dissertation']['number-of-volumes']) ? 
                                cv_output['dissertation']['number-of-volumes'] : "Not defined.",

                            //'dissertation_institutions', // confirmar este

                            'dissertation_degree_type_value': (cv_output['dissertation'] && 
                                cv_output['dissertation']['degree-type'] && 
                                cv_output['dissertation']['degree-type']['value']) ? 
                            cv_output['dissertation']['degree-type']['value'] : "Not defined.",

                            'dissertation_classification': (cv_output['dissertation'] && 
                                cv_output['dissertation']['classification']) ? 
                            cv_output['dissertation']['classification'] : "Not defined.",

                            'dissertation_completion_date_year': (cv_output['dissertation'] && 
                                cv_output['dissertation']['completion-date'] && 
                                cv_output['dissertation']['completion-date']['year']) ? 
                            cv_output['dissertation']['completion-date']['year'] : "Not defined.",

                            'dissertation_url': (cv_output['dissertation'] && 
                                cv_output['dissertation']['url']) ? 
                                cv_output['dissertation']['url'] : "Not defined.",

                            'dissertation_authors_citation': (cv_output['dissertation'] && 
                                cv_output['dissertation']['authors'] && 
                                cv_output['dissertation']['authors']['citation']) ?
                            cv_output['dissertation']['authors']['citation'] : "Not defined.",

                            //FIM DESSERTATION (Tese)

                            //LICENCIAMENTO

                            'license_title': (cv_output['license'] && 
                                cv_output['license']['license-title']) ? 
                            cv_output['license']['license-title'] : "Not defined.",

                            'license_date_issued_year': (cv_output['license'] && 
                                cv_output['license']['date-issued'] &&
                                cv_output['license']['date-issued']['year']) ? 
                            cv_output['license']['date-issued']['year'] : "Not defined.",
                            
                            'license_end_date': (cv_output['license'] && 
                                cv_output['license']['end-date'] &&
                                cv_output['license']['end-date']['year']) ? 
                            cv_output['license']['end-date']['year'] : "Not defined.",

                            'license_country':(cv_output['license'] && 
                                cv_output['license']['country'] &&
                                cv_output['license']['country']['value']) ? 
                            cv_output['license']['country']['value'] : "Not defined.",

                            'license_authors_citation': (cv_output['license'] && 
                                cv_output['license']['authors'] && 
                                cv_output['license']['authors']['citation']) ?
                            cv_output['license']['authors']['citation'] : "Not defined.",


                            //FIM LICENCIAMENTO

                            //RELATÓRIO:

                            'report_title': (cv_output['report'] &&
                                cv_output['report']['report-title']) ?
                                cv_output['report']['report-title'] : "Not defined.",

                            'report_volume': (cv_output['report'] &&
                                    cv_output['report']['volume']) ?
                                cv_output['report']['volume'] : "Not defined.",
                                
                            'report_number_of_pages': (cv_output['report'] &&
                                    cv_output['report']['number-of-pages']) ?
                                cv_output['report']['number-of-pages'] : "Not defined.",

                            'report_institutions_institution_institution_name': (cv_output['report'] &&
                                    cv_output['report']['institutions']) &&
                                    cv_output['report']['institutions']['institution'] &&
                                    cv_output['report']['institutions']['institution']['institution-name'] ?
                                cv_output['report']['institutions']['institution']['institution-name'] : "Not defined.",

                            'report_date_submitted_year': (cv_output['report'] &&
                                cv_output['report']['date-submitted'] &&
                                cv_output['report']['date-submitted']['year']) ?
                            cv_output['report']['date-submitted']['year'] : "Not defined.",

                            'report_authoring_role_value': (cv_output['report'] &&
                                cv_output['report']['authoring-role'] &&
                                cv_output['report']['authoring-role']['value']) ?
                            cv_output['report']['authoring-role']['value'] : "Not defined.",

                            'report_url': (cv_output['report'] &&
                                    cv_output['report']['url']) ?
                                cv_output['report']['url'] : "Not defined.",

                            'report_authors': (cv_output['report'] && 
                                    cv_output['report']['authors'] && 
                                    cv_output['report']['authors']['citation']) ?
                                cv_output['report']['authors']['citation'] : "Not defined.",
                            //////////////////FIM RELATÓRIO


                            'journal_article_title': (cv_output['journal-article'] &&
                                    cv_output['journal-article']['article-title']) ?
                                cv_output['journal-article']['article-title'] : "Not defined.",

                            'journal_article_publication_date_year': (cv_output['journal-article'] &&
                                    cv_output['journal-article']['publication-date'] &&
                                    cv_output['journal-article']['publication-date']['year']) ?
                                cv_output['journal-article']['publication-date']['year'] : "Not defined.",

                            'journal_article_publication_location': (cv_output['journal-article'] &&
                                    cv_output['journal-article']['publication-location'] &&
                                    cv_output['journal-article']['publication-location']['value']) ?
                                cv_output['journal-article']['publication-location']['value'] : "Not defined.",

                            'journal_article_url': (cv_output['journal-article'] &&
                                    cv_output['journal-article']['url']) ?
                                cv_output['journal-article']['url'] : "Not defined.",

                            'journal_article_authors_citation': (cv_output['journal-article'] &&
                                    cv_output['journal-article']['authors'] &&
                                    cv_output['journal-article']['authors']['citation']) ?
                                cv_output['journal-article']['authors']['citation'] : "Not defined.",

                            'book_title': (cv_output['book'] &&
                                    cv_output['book']['title']) ?
                                cv_output['book']['title'] : "Not defined.",

                            'book_authors_citation': (cv_output['book'] &&
                                    cv_output['book']['authors'] &&
                                    cv_output['book']['authors']['citation']) ?
                                cv_output['book']['authors']['citation'] : "Not defined.",

                            'book_publication_year': (cv_output['book'] &&
                                    cv_output['book']['publication-year']) ?
                                cv_output['book']['publication-year'] : "Not defined.",

                            'book_publication_location_country': (cv_output['book'] &&
                                    cv_output['book']['publication-location'] &&
                                    cv_output['book']['publication-location']['country'] &&
                                    cv_output['book']['publication-location']['country']['value']) ?
                                cv_output['book']['publication-location']['country']['value'] : "Not defined.",

                            'book_publisher': (cv_output['book'] &&
                                    cv_output['book']['publisher']) ?
                                cv_output['book']['publisher'] : "Not defined.",

                            'book_url': (cv_output['book'] &&
                                    cv_output['book']['url']) ?
                                cv_output['book']['url'] : "Not defined.",

                            'conference_paper_paper_title': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['paper-title']) ?
                                cv_output['conference-paper']['paper-title'] : "Not defined.",

                            'conference_paper_conference_date_year': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['conference-date'] &&
                                    cv_output['conference-paper']['conference-date']['year']) ?
                                cv_output['conference-paper']['conference-date']['year'] : "Not defined.",

                            'conference_paper_conference_location_value': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['conference-location'] &&
                                    cv_output['conference-paper']['conference-location']['country'] &&
                                    cv_output['conference-paper']['conference-location']['country']['value']) ?
                                cv_output['conference-paper']['conference-location']['country']['value'] : "Not defined.",

                            'conference_paper_proceedings_publisher': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['proceedings-publisher']) ?
                                cv_output['conference-paper']['proceedings-publisher'] : "Not defined.",

                            'conference_paper_url': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['url']) ?
                                cv_output['conference-paper']['url'] : "Not defined.",

                            'conference_paper_authors': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['authors'] && cv_output['conference-paper']['authors']['citation']) ?
                                cv_output['conference-paper']['authors']['citation'] : "Not defined.",

                            'other_output_title': (cv_output['other-output'] &&
                                    cv_output['other-output']['title']) ?
                                cv_output['other-output']['title'] : "Not defined.",

                            'other_output_url': (cv_output['other-output'] &&
                                    cv_output['other-output']['title']) ?
                                cv_output['other-output']['title'] : "Not defined.",

                            'other_output_authors_citation': (cv_output['other-output'] &&
                                    cv_output['other-output']['authors'] &&
                                    cv_output['other-output']['authors']['citation']) ?
                                cv_output['other-output']['authors']['citation'] : "Not defined.",

                            'other_output_identifiers_identifier_identifier': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['identifier'] : "Not defined.",

                            'other_output_identifiers_identifier_identifier_type_code': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code'] : "Not defined.",

                            'other_output_identifiers_identifier_identifier_type_value': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value'] : "Not defined.",

                            'other_output_identifiers_identifier_relationship_type_code': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code'] : "Not defined.",

                            'other_output_identifiers_identifier_relationship_type_value': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value'] : "Not defined.",

                            'other_output_publication_date_year': (cv_output['other-output'] &&
                                    cv_output['other-output']['publication-date'] &&
                                    cv_output['other-output']['publication-date']['year']) ?
                                cv_output['other-output']['publication-date']['year'] : "Not defined.",
                        },

                    }).then(function (response) {

                        //this.isbulkUpdateFailed = false;

                    })
                    .catch(function (error) {

                        this.isbulkUpdateFailed = true;

                        console.log(error);
                    });
            }
        },

    },
    created() {

        /*Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findUser?q=' + query)
                .then((response) => {
                    this.users = response.data;
                })
                .catch(() => {

                })
        })
        this.loadUsers();
        //this.getResults();*/
        Fire.$on('refresh', () => {
            this.removeDuplicatesFromAllOutputsAndAuthors(1);
            this.AllOutputsAndAuthors();
        });
        this.removeDuplicatesFromAllOutputsAndAuthors(1);
        this.AllOutputsAndAuthors();
        this.getSciences();
        this.checkIfthereAreStatistics();
    },
    mounted(){
        this.loadOutputs();
        this.getSciences();
        this.removeDuplicatesFromAllOutputsAndAuthors(1);
        this.AllOutputsAndAuthors();
        this.searchPermission();
    }
}
</script>

<style>
.Chart {
    height: 33%;
    width: 33%;
    background: #f4f1f1;
    border-radius: 15px;
    box-shadow: 0px 2px 15px rgba(25, 25, 25, 0.27);
    margin: 25px 0;
}

.Chart h2 {
    align-content: center;
    text-align: center;
    margin-top: 0;
    padding: 15px 0;
    color: rgba(255, 0, 0, 0.5);
    border-bottom: 1px solid #323d54;
}
</style>
