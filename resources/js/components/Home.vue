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

                                <td>
                                    <button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow(
                                       output.Title,
                                       output['Publication date'],
                                       output.Authors,
                                       output.Type
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                </td>

                                <td>{{ output.Title }}</td>
                                <td>{{ output['Publication date'] }}</td>
                                <td>{{ output.Authors }}</td>
                                <td>{{ output.Type }}</td>

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
            aux:'',
            page:1,
            total:1,
            lowest_year_of_checking_statistics: '',
            isbulkUpdateFailed: false,
            science_ids: [],
            cvoutput_s: [],
            text_to_copy: '',
            allOutputsWithoutDuplicateds: [],
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

        formatRow(title, publication_date, authors, type) {
            return "[" + publication_date + "] [" + type + "]: " + title + "." + "\nAuthors: " + authors;
        },

        formatAllRows() {
            let aux = [];

            for (let output of this.allOutputsWithoutDuplicateds) {
                aux = aux +
                    this.formatRow(
                        output.Title,
                        output['Publication date'],
                        output.Authors,
                        output.Type
                    ) + "\n----\n";
            }

            return aux;

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
                    console.log("O array recebido: " + this.science_ids);
                    console.log("O array Length: " + this.science_ids.length);
                });
        },

        show() {
            for (let row of this.science_ids) {
                console.log("this.science_name: " + row);
            }

        },

        bulkUpdateToDatabase() {
            for (let id of this.science_ids) {
                this.loadOutputandSave(id);
            }
        },

        loadOutputandSave(id) {
            axios.get('api/cv_outputs/getRemoteCienciaVitaeOutputs_By_Id/' + id)
                .then(response => {
                    this.cv_outputs = response.data.output;
                    console.log("output:")
                    console.log(response.data)
                     console.log(response.data.output)
                    this.saveCienciaVitaeToLocalDataBase(id);
                    this.removeDuplicatesFromAllOutputsAndAuthors(1);
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
                                cv_output['book']['publication-year'] : "Not defined",

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
                                cv_output['book']['url'] : "Not defined",

                            'conference_paper_paper_title': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['paper-title']) ?
                                cv_output['conference-paper']['paper-title'] : "Not defined",

                            'conference_paper_conference_date_year': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['conference-date'] &&
                                    cv_output['conference-paper']['conference-date']['year']) ?
                                cv_output['conference-paper']['conference-date']['year'] : "Not defined",

                            'conference_paper_publication_location_value': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['publication-location']['country'] &&
                                    cv_output['conference-paper']['publication-location']['country']['value']) ?
                                cv_output['conference-paper']['publication-location']['country']['value'] : "Not defined",

                            'conference_paper_proceedings_publisher': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['proceedings-publisher']) ?
                                cv_output['conference-paper']['proceedings-publisher'] : "Not defined",

                            'conference_paper_url': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['url']) ?
                                cv_output['conference-paper']['url'] : "Not defined",

                            'conference_paper_authors': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['authors'] && cv_output['conference-paper']['authors']['citation']) ?
                                cv_output['conference-paper']['authors']['citation'] : "Not defined",

                            'other_output_title': (cv_output['other-output'] &&
                                    cv_output['other-output']['title']) ?
                                cv_output['other-output']['title'] : "Not defined",

                            'other_output_url': (cv_output['other-output'] &&
                                    cv_output['other-output']['title']) ?
                                cv_output['other-output']['title'] : "Not defined",

                            'other_output_authors_citation': (cv_output['other-output'] &&
                                    cv_output['other-output']['authors'] &&
                                    cv_output['other-output']['authors']['citation']) ?
                                cv_output['other-output']['authors']['citation'] : "Not defined",

                            'other_output_identifiers_identifier_identifier': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['identifier'] : "Not defined",

                            'other_output_identifiers_identifier_identifier_type_code': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code'] : "Not defined",

                            'other_output_identifiers_identifier_identifier_type_value': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value'] : "Not defined",

                            'other_output_identifiers_identifier_relationship_type_code': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code'] : "Not defined",

                            'other_output_identifiers_identifier_relationship_type_value': (cv_output['other-output'] &&
                                    cv_output['other-output']['identifiers'] &&
                                    cv_output['other-output']['identifiers']['identifier'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type'] &&
                                    cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value']) ?
                                cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value'] : "Not defined",

                            'other_output_publication_date_year': (cv_output['other-output'] &&
                                    cv_output['other-output']['publication-date'] &&
                                    cv_output['other-output']['publication-date']['year']) ?
                                cv_output['other-output']['publication-date']['year'] : "Not defined",
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
        });
        this.removeDuplicatesFromAllOutputsAndAuthors(1);
        this.getSciences();
        this.checkIfthereAreStatistics();
    },
    mounted(){
        this.getSciences();
        this.removeDuplicatesFromAllOutputsAndAuthors(1);
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
