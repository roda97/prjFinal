<template>
<div class="container">

    <div>

        <span>Start Year: </span>
        <select v-model="selectedStartYear">
            <option value="0"></option>
            <option v-for="year in years" v-bind:key="year" v-bind:value="{ begin: year }">
                {{ year }}
            </option>
        </select>

        <span>End Year: </span>
        <select v-model="selectedEndYear">
            <option value="0"></option>
            <option v-for="year in years" v-bind:key="year" v-bind:value="{ end: year }">
                {{ year }}
            </option>
        </select>

        <input type="checkbox" id="book" value="Book" v-model="checkedTypeFilters">
        <label for="book">Livro</label>

        <input type="checkbox" id="other" value="Other" v-model="checkedTypeFilters">
        <label for="other">Outra Produção</label>

        <input type="checkbox" id="article" value="Article" v-model="checkedTypeFilters">
        <label for="article">Artigo em revista</label>

        <input type="checkbox" id="conference" value="Conference" v-model="checkedTypeFilters">
        <label for="conference">Artigo em conferência</label>

        <br>

        <!-- <span>Checked filters: {{ checkedTypeFilters }}</span> -->

        <div class="filterButtons" align="right">
            <button class="btn btn-primary" @click="checkAllFilters()">CHECK ALL TYPES</button>
            <button class="btn btn-success" @click="loadOutputsByYearRange(selectedStartYear.begin, selectedEndYear.end)">FILTER</button>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ciencia Vitae Outputs</h3>
                    <!--
                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
                -->
                    <div class="card-tools">
                        <download-csv class="btn btn-dark" @:data="this.data_to_csv" name="CIIC_DB_Outputs.csv">

                            <font color="white">EXPORT CIIC TABLE</font>

                        </download-csv>

                        <download-csv class="btn btn-dark" :data="this.filtered_data_to_csv" name="CIIC_DB_Outputs_Filtered.csv">

                            <font color="white">EXPORT FILTERED</font>

                        </download-csv>
                        <button class="btn btn-danger" @click="deleteAll()">DELETE CIIC DATABASE</button>
                        <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                    </div>
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
                                <th>ID</th>
                                <th>Last Modified Date</th>
                                <th>Output Category(value)</th>
                                <th>Output Category(code)</th>
                                <th>Output Type(value)</th>
                                <th>Output Type(code)</th>
                                <th>Journal Article(Title)</th>
                                <th>Journal Article(Publication Date)</th>
                                <th>Journal Article(Publication Location)</th>
                                <th>Journal Article(URL)</th>
                                <th>Journal Article(Authors)</th>
                                <th>Book(Title)</th>
                                <th>Book(Publication Year)</th>
                                <th>Book(Publication Location Country)</th>
                                <th>Book(Publisher)</th>
                                <th>Book(URL)</th>
                                <th>Book(Authors)</th>
                                <th>Conference Paper(Paper Title)</th>
                                <th>Conference Paper(Conference Date Year)</th>
                                <th>Conference Paper(Publication Location)</th>
                                <th>Conference Paper(Proceedings Publisher)</th>
                                <th>Conference Paper(Authors)</th>
                                <th>Other Output(Title)</th>
                                <th>Other Output(URL)</th>
                                <th>Other Output(Authors)</th>
                                <th>Other Output(Identifier)</th>
                                <th>Other Output(Identifier Type Code)</th>
                                <th>Other Output(Identifier Type Value)</th>
                                <th>Other Output(Identifier Relationship Type Code)</th>
                                <th>Other Output(Identifier Relationship Type Value)</th>
                                <th>Publication Date(Year)</th>
                            </tr>
                            <tr v-for="cv_output in cv_outputs" :key="cv_output.id">

                                <td>
                                    <span v-if="cv_output['output-type']['value'] == 'Artigo em conferência'">
                                    <button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow_conferece(
                                        cv_output['conference-paper']['authors']['citation'],
                                        cv_output['conference-paper']['conference-date']['year'],
                                        cv_output['conference-paper']['paper-title'],
                                        cv_output['conference-paper']['publication-location']['country']['value'],
                                        cv_output['conference-paper']['proceedings-publisher']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Outra produção'">
                                    <button
                                      type="button"
                                      class="btn btn-info"
                                      @click="text_to_copy = 
                                      formatRow_others(
                                        cv_output['other-output']['authors']['citation'],
                                        cv_output['other-output']['publication-date']['year'],
                                        cv_output['other-output']['title'],
                                        cv_output['other-output']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Artigo em revista'">
                                    <button
                                      type="button"
                                      class="btn btn-danger"
                                      @click="text_to_copy = 
                                      formatRow_magazine(
                                        cv_output['journal-article']['authors']['citation'],
                                        cv_output['journal-article']['publication-date']['year'],
                                        cv_output['journal-article']['article-title'],
                                        cv_output['journal-article']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Livro'">
                                    <button
                                      type="button"
                                      class="btn btn-dark"
                                      @click="text_to_copy = 
                                      formatRow_book(
                                        cv_output['book']['authors']['citation'],
                                        cv_output['book']['publication-year'],
                                        cv_output['book']['title'],
                                        cv_output['book']['publication-location']['country']['value'],
                                        cv_output['book']['publisher'],
                                        cv_output['book']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>
                                </td>

                                <td><span v-if="cv_output['id']">{{ cv_output['id'] }}</span>
                                    <span style="color:red" v-else><b>No ID</b></span>
                                </td>
                                <td><span v-if="cv_output['last-modified-date']">{{ cv_output['last-modified-date'] }}</span>
                                    <span style="color:red" v-else><b>No Last Modified Date</b></span>
                                </td>
                                <td><span v-if="cv_output['output-category']">{{ cv_output['output-category']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Output Category</b></span>
                                </td>
                                <td><span v-if="cv_output['output-category']">{{ cv_output['output-category']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Output Category</b></span>
                                </td>
                                <td><span v-if="cv_output['output-type']">{{ cv_output['output-type']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Output Type</b></span>
                                </td>
                                <td><span v-if="cv_output['output-type']">{{ cv_output['output-type']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Output Type</b></span>
                                </td>
                                <td><span v-if="cv_output['journal-article']">{{ cv_output['journal-article']['article-title'] }}</span>
                                    <span style="color:red" v-else><b>No Journal Article</b></span>
                                </td>
                                <td><span v-if="cv_output['journal-article']">{{ cv_output['journal-article']['publication-date']['year'] }}</span>
                                    <span style="color:red" v-else><b>No Journal Article</b></span>
                                </td>
                                <td><span v-if="cv_output['journal-article']">{{ cv_output['journal-article']['publication-location']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Journal Article</b></span>
                                </td>
                                <td><span v-if="cv_output['journal-article']">{{ cv_output['journal-article']['url'] }}</span>
                                    <span style="color:red" v-else><b>No Journal Article</b></span>
                                </td>
                                <td><span v-if="cv_output['journal-article']">{{ cv_output['journal-article']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Journal Article</b></span>
                                </td>
                                <td><span v-if="cv_output['book']">{{ cv_output['book']['title'] }}</span>
                                    <span style="color:red" v-else><b>No Book</b></span>
                                </td>
                                <td><span v-if="cv_output['book']">{{ cv_output['book']['publication-year'] }}</span>
                                    <span style="color:red" v-else><b>No Book</b></span>
                                </td>
                                <td><span v-if="cv_output['book']">{{ cv_output['book']['publication-location']['country']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Book</b></span>
                                </td>
                                <td><span v-if="cv_output['book']">{{ cv_output['book']['publisher'] }}</span>
                                    <span style="color:red" v-else><b>No Book</b></span>
                                </td>
                                <td><span v-if="cv_output['book']">{{ cv_output['book']['url'] }}</span>
                                    <span style="color:red" v-else><b>No Book</b></span>
                                </td>
                                <td><span v-if="cv_output['book']">{{ cv_output['book']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Book</b></span>
                                </td>

                                <td><span v-if="cv_output['conference-paper']">{{ cv_output['conference-paper']['paper-title'] }}</span>
                                    <span style="color:red" v-else><b>No Conference Paper</b></span>
                                </td>
                                <td><span v-if="cv_output['conference-paper']">{{ cv_output['conference-paper']['conference-date']['year'] }}</span>
                                    <span style="color:red" v-else><b>No Conference Paper</b></span>
                                </td>
                                <td><span v-if="cv_output['conference-paper']">{{ cv_output['conference-paper']['publication-location']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Conference Paper</b></span>
                                </td>
                                <td><span v-if="cv_output['conference-paper']">{{ cv_output['conference-paper']['proceedings-publisher'] }}</span>
                                    <span style="color:red" v-else><b>No Conference Paper</b></span>
                                </td>
                                <td><span v-if="cv_output['conference-paper']">{{ cv_output['conference-paper']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Conference Paper</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['title'] }}</span>
                                    <span style="color:red" v-else><b>No Output Title</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['url'] }}</span>
                                    <span style="color:red" v-else><b>No Output Url</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Output Authors</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['identifiers']['identifier'][0]['identifier'] }}</span>
                                    <span style="color:red" v-else><b>No Output Identifiers</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Output Identifier Type</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Output Identifier Type</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Output Relationship Type</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Output Relationship Type</b></span>
                                </td>
                                <td><span v-if="cv_output['other-output']">{{ cv_output['other-output']['publication-date']['year']}}</span>
                                    <span style="color:red" v-else><b>No Output Publication Date</b></span>
                                </td>

                                <td>
                                    <!--
                        <a href="#" @click="deleteResearcher(researcher.project_researchers_id)">
                            <i class ="fa fa-trash red"></i>
                        </a>
                        -->
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
// Component code (not registered)

export default {

    data: function () {
        return {
            isbulkUpdateFailed: false,
            checkedTypeFilters: [],
            cv_outputs: [],
            data_to_csv: [],
            filtered_data_to_csv: [],
            text_to_copy: '',
            selectedStartYear: '',
            selectedEndYear: '',
            //aux: [],
        }
    },

    computed: {
        years() {
            const year = new Date().getFullYear()
            return Array.from({
                length: year - 2000
            }, (value, index) => 2001 + index)
        }
    },

    methods: {

        formatRow_conferece(authors, year, paper_title, country, proceedings_publisher) {
            return authors + ". " + year + ".\n" + '"' + paper_title + '". ' + country + ": " + proceedings_publisher;
        },

        formatRow_others(other_output_authors_citation, other_output_publication_date_year, other_output_title, other_output_url) {
            return other_output_authors_citation + ". " + other_output_publication_date_year + ". " + other_output_title + ". " + other_output_url;
        },

        formatRow_magazine(journal_article_authors_citation, journal_article_publication_date_year, journal_article_title, journal_article_url) {
            return journal_article_authors_citation + ". " +
                journal_article_publication_date_year + "." + ' "' + journal_article_title + '". ' + journal_article_url + ".";
        },

        formatRow_book(book_authors_citation, book_publication_year, book_title, book_publication_location_country_value, book_publisher, book_url) {
            return book_authors_citation + ". " + book_publication_year + ". " + book_title + ". " + book_publication_location_country_value + ": " + book_publisher + ". " + book_url;
        },

        formatAllRows() {
            let aux = "------------------------------ Artigo em Conferência ---------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Artigo em conferência") {

                    aux = aux +
                        this.formatRow_conferece(
                            cv_output['conference-paper']['authors']['citation'],
                            cv_output['conference-paper']['conference-date']['year'],
                            cv_output['conference-paper']['paper-title'],
                            cv_output['conference-paper']['publication-location']['country']['value'],
                            cv_output['conference-paper']['proceedings-publisher']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n------------------------------ Artigo em revista ---------------------------\n\n";

            for (let cv_output of this.cv_outputs) {
                if (cv_output['output-type']['value'] == "Artigo em revista") {
                    aux = aux +
                        this.formatRow_magazine(cv_output['journal-article']['authors']['citation'],
                            cv_output['journal-article']['publication-date']['year'],
                            cv_output['journal-article']['article-title'],
                            cv_output['journal-article']['url']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n---------------------------- Livro -----------------------------\n\n";

            for (let cv_output of this.cv_outputs) {
                if (cv_output['output-type']['value'] == "Livro") {
                    aux = aux +
                        this.formatRow_book(cv_output['book']['authors']['citation'],
                            cv_output['book']['publication-year'],
                            cv_output['book']['title'],
                            cv_output['book']['publication-location']['country']['value'],
                            cv_output['book']['publisher'],
                            cv_output['book']['url']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Outra Produção -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Outra produção") {
                    aux = aux +
                        this.formatRow_others(cv_output['other-output']['authors']['citation'],
                            cv_output['other-output']['publication-date']['year'],
                            cv_output['other-output']['title'],
                            cv_output['other-output']['url']
                        ) + "\n\n";
                }
            }

            return aux;

        },
        onCopy: function (e) {
            Swal.fire({
                type: 'success',
                title: 'Text Copied!',
                showConfirmButton: true,
            })
            this.text_to_copy = e.text;
        },

        deleteAll(){
            axios.delete('api/delete/AllOutputs')
            .then(response => {             
              Swal.fire(
                'Deleted!',
                'All deleted.',
                'success'
              )
              Fire.$emit('refresh');             
              })
              .catch(error => {
              Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              })
            });
        },

        getLocalDataToCSV() {
            axios.get('api/cv/getLocalCienciaVitae_Outputs')
                .then(response => {
                    this.data_to_csv = response.data.data;
                });
        },

        getFilteredDataToCSV() {
            axios.get('api/cv_save_outputs/getExportFilteredCienciaVitaeOutPuts')
                .then(response => {
                    this.filtered_data_to_csv = response.data.data;
                });
        },

        loadOutputs() {
            axios.get('api/cv_outputs/getRemoteCienciaVitaeOutputs')
                .then(response => {
                    this.cv_outputs = response.data.output;
                    this.filtered_data_to_csv = [];
                });
        },
        loadOutputsByYearRange(begin, end) {

            var cv_outputs_aux_full = [];
            var cv_outputs_aux_filtrada = [];

            if (end >= begin) {
                axios.get('api/cv_outputs/getCV_outputs_ByYearRange')
                    .then(response => {

                        //como a vista nao atualizava direito tive de esvaziar o vetor principal
                        this.cv_outputs = [];
                        cv_outputs_aux_full = response.data.output;

                        for (let cv_output of cv_outputs_aux_full) {

                            //console.log("Tipo: " + cv_output['output-type']['value'] + '\n');
                            if (this.checkedTypeFilters.includes('Article')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Artigo em revista") &&
                                        (
                                            (cv_output['journal-article']['publication-date']['year'] >= begin) &&
                                            (cv_output['journal-article']['publication-date']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }

                            if (this.checkedTypeFilters.includes('Book')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Livro") &&
                                        (
                                            (cv_output['book']['publication-year'] >= begin) &&
                                            (cv_output['book']['publication-year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }

                            if (this.checkedTypeFilters.includes('Conference')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Artigo em conferência") &&
                                        (
                                            (cv_output['conference-paper']['conference-date']['year'] >= begin) &&
                                            (cv_output['conference-paper']['conference-date']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }

                            if (this.checkedTypeFilters.includes('Other')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Outra produção") &&
                                        (
                                            (cv_output['other-output']['publication-date']['year'] >= begin) &&
                                            (cv_output['other-output']['publication-date']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }

                            }
                        }
                        this.cv_outputs = cv_outputs_aux_filtrada.splice(0);
                        //console.log("Resultado da lista filtrada: \n" + JSON.stringify(this.cv_outputs));
                        //console.log("Resultado da lista local p/ CSV: \n" + JSON.stringify(this.data_to_csv));

                        this.exportFilteredCienciaVitaeOutPuts();

                    });

            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Range Invalid',
                    text: 'Choose correctly start and end Years!',
                })
            }

        },

        exportFilteredCienciaVitaeOutPuts() {

            let lista2 = {
                data: []
            };

            for (let cv_output of this.cv_outputs) {

                lista2.data.push({
                    user_science_id: null,
                    id_row_entry: cv_output['id'],
                    last_modified_date: cv_output['last-modified-date'],
                    output_category_value: cv_output['output-category']['value'],
                    output_category_code: cv_output['output-category']['code'],
                    output_type_value: cv_output['output-type']['value'],
                    output_type_code: cv_output['output-type']['code'],

                    journal_article_title: (cv_output['journal-article'] &&
                            cv_output['journal-article']['article-title']) ?
                        cv_output['journal-article']['article-title'] : "Not defined.",

                    journal_article_publication_date_year: (cv_output['journal-article'] &&
                            cv_output['journal-article']['publication-date'] &&
                            cv_output['journal-article']['publication-date']['year']) ?
                        cv_output['journal-article']['publication-date']['year'] : "Not defined.",

                    journal_article_publication_location: (cv_output['journal-article'] &&
                            cv_output['journal-article']['publication-location'] &&
                            cv_output['journal-article']['publication-location']['value']) ?
                        cv_output['journal-article']['publication-location']['value'] : "Not defined.",

                    journal_article_url: (cv_output['journal-article'] &&
                            cv_output['journal-article']['url']) ?
                        cv_output['journal-article']['url'] : "Not defined.",

                    journal_article_authors_citation: (cv_output['journal-article'] &&
                            cv_output['journal-article']['authors'] &&
                            cv_output['journal-article']['authors']['citation']) ?
                        cv_output['journal-article']['authors']['citation'] : "Not defined.",

                    book_title: (cv_output['book'] &&
                            cv_output['book']['title']) ?
                        cv_output['book']['title'] : "Not defined.",

                    book_authors_citation: (cv_output['book'] &&
                            cv_output['book']['authors'] &&
                            cv_output['book']['authors']['citation']) ?
                        cv_output['book']['authors']['citation'] : "Not defined.",

                    book_publication_year: (cv_output['book'] &&
                            cv_output['book']['publication-year']) ?
                        cv_output['book']['publication-year'] : "Not defined",

                    book_publication_location_country: (cv_output['book'] &&
                            cv_output['book']['publication-location'] &&
                            cv_output['book']['publication-location']['country'] &&
                            cv_output['book']['publication-location']['country']['value']) ?
                        cv_output['book']['publication-location']['country']['value'] : "Not defined.",

                    book_publisher: (cv_output['book'] &&
                            cv_output['book']['publisher']) ?
                        cv_output['book']['publisher'] : "Not defined.",

                    book_url: (cv_output['book'] &&
                            cv_output['book']['url']) ?
                        cv_output['book']['url'] : "Not defined",

                    conference_paper_paper_title: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['paper-title']) ?
                        cv_output['conference-paper']['paper-title'] : "Not defined",

                    conference_paper_conference_date_year: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['conference-date'] &&
                            cv_output['conference-paper']['conference-date']['year']) ?
                        cv_output['conference-paper']['conference-date']['year'] : "Not defined",

                    conference_paper_publication_location_value: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['publication-location']['country'] &&
                            cv_output['conference-paper']['publication-location']['country']['value']) ?
                        cv_output['conference-paper']['publication-location']['country']['value'] : "Not defined",

                    conference_paper_proceedings_publisher: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['proceedings-publisher']) ?
                        cv_output['conference-paper']['proceedings-publisher'] : "Not defined",

                    conference_paper_url: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['url']) ?
                        cv_output['conference-paper']['url'] : "Not defined",

                    conference_paper_authors: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['authors'] && cv_output['conference-paper']['authors']['citation']) ?
                        cv_output['conference-paper']['authors']['citation'] : "Not defined",

                    other_output_title: (cv_output['other-output'] &&
                            cv_output['other-output']['title']) ?
                        cv_output['other-output']['title'] : "Not defined",

                    other_output_url: (cv_output['other-output'] &&
                            cv_output['other-output']['title']) ?
                        cv_output['other-output']['title'] : "Not defined",

                    other_output_authors_citation: (cv_output['other-output'] &&
                            cv_output['other-output']['authors'] &&
                            cv_output['other-output']['authors']['citation']) ?
                        cv_output['other-output']['authors']['citation'] : "Not defined",

                    other_output_identifiers_identifier_identifier: (cv_output['other-output'] &&
                            cv_output['other-output']['identifiers'] &&
                            cv_output['other-output']['identifiers']['identifier'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['identifier']) ?
                        cv_output['other-output']['identifiers']['identifier'][0]['identifier'] : "Not defined",

                    other_output_identifiers_identifier_identifier_type_code: (cv_output['other-output'] &&
                            cv_output['other-output']['identifiers'] &&
                            cv_output['other-output']['identifiers']['identifier'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['identifier-type'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code']) ?
                        cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['code'] : "Not defined",

                    other_output_identifiers_identifier_identifier_type_value: (cv_output['other-output'] &&
                            cv_output['other-output']['identifiers'] &&
                            cv_output['other-output']['identifiers']['identifier'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['identifier-type'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value']) ?
                        cv_output['other-output']['identifiers']['identifier'][0]['identifier-type']['value'] : "Not defined",

                    other_output_identifiers_identifier_relationship_type_code: (cv_output['other-output'] &&
                            cv_output['other-output']['identifiers'] &&
                            cv_output['other-output']['identifiers']['identifier'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['relationship-type'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code']) ?
                        cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['code'] : "Not defined",

                    other_output_identifiers_identifier_relationship_type_value: (cv_output['other-output'] &&
                            cv_output['other-output']['identifiers'] &&
                            cv_output['other-output']['identifiers']['identifier'] &&
                            cv_output['other-output']['identifiers']['identifier'][0] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['relationship-type'] &&
                            cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value']) ?
                        cv_output['other-output']['identifiers']['identifier'][0]['relationship-type']['value'] : "Not defined",

                    other_output_publication_date_year: (cv_output['other-output'] &&
                            cv_output['other-output']['publication-date'] &&
                            cv_output['other-output']['publication-date']['year']) ?
                        cv_output['other-output']['publication-date']['year'] : "Not defined",

                });

            }

            this.filtered_data_to_csv = JSON.stringify(lista2);

            //console.log("-------- Lista: \n" + JSON.stringify(lista2));
            //console.log("\n-------- Tipo do filtered_data_to_csv: \n" + this.filtered_data_to_csv.constructor.name);
            //console.log("\n-------- Tipo do data_to_csv: \n" + this.data_to_csv.constructor.name);
            //console.log("\n-------- filtered_data_to_csv: \n" + JSON.stringify(this.filtered_data_to_csv));

        },

        checkAllFilters() {
            this.checkedTypeFilters = [];
            this.checkedTypeFilters.push('Book');
            this.checkedTypeFilters.push('Other');
            this.checkedTypeFilters.push('Article');
            this.checkedTypeFilters.push('Conference');
        },
        saveCienciaVitaeToLocalDataBase() {

            for (let cv_output of this.cv_outputs) {

                axios({

                        method: 'post',
                        url: 'api/cv_save_outputs/saveCienciaVitaeToLocalDataBase',
                        data: {

                            'user_science_id': null,
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

                        
                    })
                    .catch(function (error) {

                        this.isbulkUpdateFailed = true;

                        console.log(error);
                    });
            }

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
                    showConfirmButton: true,
                })
                Fire.$emit('updateLocalCSV');
            }

        },
    },
    created() {
        this.checkAllFilters();
        this.loadOutputs();
        this.getLocalDataToCSV();

        Fire.$on('refresh', () => {
            this.loadOutputs();
        })
        Fire.$on('updateLocalCSV', () => {
            this.getLocalDataToCSV();
        })
        Fire.$on('updateFilteredDataCSV', () => {
            this.getFilteredDataToCSV();
        })
    },
}
</script>

<style scoped>
tr.activerow {
    background: #123456 !important;
    color: #fff !important;
}
</style>
