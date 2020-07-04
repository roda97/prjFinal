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

        <input type="checkbox" id="patent" value="Patent" v-model="checkedTypeFilters">
        <label for="book">Patente</label>

        <input type="checkbox" id="book_chapter" value="Book Chapter" v-model="checkedTypeFilters">
        <label for="other">Capítulo de Livro</label>

        <input type="checkbox" id="dissertation" value="Dissertation" v-model="checkedTypeFilters">
        <label for="article">Tese / Dissertação</label>

        <input type="checkbox" id="license" value="License" v-model="checkedTypeFilters">
        <label for="conference">Licenciamento</label>

        <input type="checkbox" id="report" value="Report" v-model="checkedTypeFilters">
        <label for="book">Relatório</label>


        <br>

        <!-- <span>Checked filters: {{ checkedTypeFilters }}</span> -->

        <div class="filterButtons" align="right">
            <button class="btn btn-primary" @click="checkAllFilters()">CHECK ALL TYPES</button>
            <button class="btn btn-success" @click="loadOutputsByYearRange(selectedStartYear.begin, selectedEndYear.end)">FILTER</button>
            <button class="btn btn-danger" @click="loadOutputs(); checkAllFilters()">RESET</button>
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

                        <button class="btn btn-success" @click="updateToCIICDatabase()">UPDATE TO CIIC DATABASE</button>
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
                                <th>Report(Title)</th>
                                <th>Report(Volume)</th>
                                <th>Report(Number Of Pages)</th>
                                <th>Report(Institution Name)</th>
                                <th>Report(Publication Year)</th>
                                <th>Report(Authoring Role)</th>
                                <th>Report(URL)</th>
                                <th>Report(Authors)</th>
                                <th>Dissertation(Title)</th>
                                <th>Dissertation(Number Of Volumes)</th>
                                <th>Dissertation(Degree)</th>
                                <th>Dissertation(Classification)</th>
                                <th>Dissertation(Completion Year)</th>
                                <th>Dissertation(URL)</th>
                                <th>Dissertation(Authors)</th>
                                <th>License(Title)</th>
                                <th>License(Issued Year)</th>
                                <th>License(Completion Year)</th>
                                <th>License(Country)</th>
                                <th>License(Authors)</th>
                                <th>Book Chapter(Chapter Title)</th>
                                <th>Book Chapter(Title)</th>
                                <th>Book Chapter(Volume)</th>
                                <th>Book Chapter(Publication Year)</th>
                                <th>Book Chapter(Publication Location Country)</th>
                                <th>Book Chapter(Publisher)</th>
                                <th>Book Chapter(URL)</th>
                                <th>Book Chapter(Authors)</th>
                                <th>Patent(Title)</th>
                                <th>Patent(Issued Year)</th>
                                <th>Patent(Completion Year)</th>
                                <th>Patent(Country)</th>
                                <th>Patent(Authors)</th>
                            </tr>
                            <tr v-for="cv_output in cv_outputs" :key="cv_output.id">

                                <td>
                                    <span v-if="cv_output['output-type']['value'] == 'Conference paper' || cv_output['output-type']['value'] == 'Artigo em conferência'">
                                    <button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow_conferece(
                                        cv_output['conference-paper']['authors']['citation'],
                                        cv_output['conference-paper']['conference-date']['year'],
                                        cv_output['conference-paper']['paper-title'],
                                        cv_output['conference-paper']['conference-location'] ? cv_output['conference-paper']['conference-location']['country']['value'] : null,
                                        cv_output['conference-paper']['proceedings-publisher']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Other output' || cv_output['output-type']['value'] == 'Outra produção'">
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

                                    <span v-if="cv_output['output-type']['value'] == 'Journal article' || cv_output['output-type']['value'] == 'Artigo em revista'">
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

                                    <span v-if="cv_output['output-type']['value'] == 'Book' || cv_output['output-type']['value'] == 'Livro'" >
                                    <button
                                      type="button"
                                      class="btn btn-dark"
                                      @click="text_to_copy = 
                                      formatRow_book(
                                        cv_output['book']['authors']['citation'],
                                        cv_output['book']['publication-year'],
                                        cv_output['book']['title'],
                                        cv_output['book']['publication-location'] ? cv_output['book']['publication-location']['country']['value'] : null,
                                        cv_output['book']['publisher'],
                                        cv_output['book']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Report' || cv_output['output-type']['value'] == 'Relatório'">
                                    <button
                                      type="button"
                                      class="btn btn-primary"
                                      @click="text_to_copy = 
                                      formatRow_report(
                                        cv_output['report']['authors']['citation'],
                                        cv_output['report']['date-submitted']['year'],
                                        cv_output['report']['report-title'],
                                        cv_output['report']['institutions'] ? cv_output['report']['institutions']['institution'][0]['institution-name'] : null,
                                        cv_output['report']['authoring-role'] ? cv_output['report']['authoring-role']['value'] : null,
                                        cv_output['report']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Dissertation' || cv_output['output-type']['value'] == 'Tese / Dissertação'">
                                    <button
                                      type="button"
                                      class="btn btn-warning"
                                      @click="text_to_copy = 
                                      formatRow_dissertation(
                                        cv_output['dissertation']['authors']['citation'],
                                        cv_output['dissertation']['completion-date']['year'],
                                        cv_output['dissertation']['title'],
                                        cv_output['dissertation']['degree-type'] ? cv_output['dissertation']['degree-type']['value'] : null,
                                        cv_output['dissertation']['classification'],
                                        cv_output['dissertation']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>

                                    <span v-if="cv_output['output-type']['value'] == 'License' || cv_output['output-type']['value'] == 'Licenciamento'">
                                    <button
                                      type="button"
                                      class="btn btn-secondary"
                                      @click="text_to_copy = 
                                      formatRow_license(
                                        cv_output['license']['authors']['citation'],
                                        cv_output['license']['date-issued']['year'],
                                        cv_output['license']['end-date']['year'],
                                        cv_output['license']['license-title'],
                                        cv_output['license']['country']['value'],
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                    </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Book Chapter' || cv_output['output-type']['value'] == 'Capítulo de livro'" >
                                    <button
                                      type="button"
                                      class="btn btn-outline-danger"
                                      @click="text_to_copy = 
                                      formatRow_bookChapter(
                                        cv_output['book-chapter']['authors']['citation'],
                                        cv_output['book-chapter']['publication-year'],
                                        cv_output['book-chapter']['chapter-title'],
                                        cv_output['book-chapter']['book-title'],
                                        cv_output['book-chapter']['publication-location'] ? cv_output['book-chapter']['publication-location']['country']['value'] : null,
                                        cv_output['book-chapter']['book-publisher'],
                                        cv_output['book-chapter']['url']
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                      </span>

                                    <span v-if="cv_output['output-type']['value'] == 'Patent' || cv_output['output-type']['value'] == 'Patente'">
                                    <button
                                      type="button"
                                      class="btn btn-outline-success"
                                      @click="text_to_copy = 
                                      formatRow_patent(
                                        cv_output['patent']['authors']['citation'],
                                        cv_output['patent']['date-issued']['year'],
                                        cv_output['patent']['date-of-term-end']['year'],
                                        cv_output['patent']['patent-title'],
                                        cv_output['patent']['country']['value'],
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
                                <td><span v-if="cv_output['journal-article'] && cv_output['journal-article']['publication-location'] && cv_output['journal-article']['publication-location']['country'] == null">-</span>
                                    <span v-if="cv_output['journal-article'] && cv_output['journal-article']['publication-location'] && cv_output['journal-article']['publication-location']['country']">{{ cv_output['journal-article']['publication-location']['country']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['journal-article'] == null"><b>No Journal Article</b></span>
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
                                <td><span v-if="cv_output['book'] && cv_output['book']['publication-location'] && cv_output['book']['publication-location']['country'] == null">-</span>
                                    <span v-if="cv_output['book'] && cv_output['book']['publication-location'] && cv_output['book']['publication-location']['country']">{{ cv_output['book']['publication-location']['country']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['book'] == null"><b>No Book</b></span>
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
                                <td><span v-if="cv_output['conference-paper'] && cv_output['conference-paper']['conference-location'] && cv_output['conference-paper']['conference-location']['country'] == null">-</span>
                                    <span v-if="cv_output['conference-paper'] && cv_output['conference-paper']['conference-location'] && cv_output['conference-paper']['conference-location']['country']">{{ cv_output['conference-paper']['conference-location']['country']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['conference-paper'] == null"><b>No Conference Paper </b></span>
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
                                <td><span v-if="cv_output['report']">{{ cv_output['report']['report-title'] }}</span>
                                    <span style="color:red" v-else><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['report']">{{ cv_output['report']['volume'] }}</span>
                                    <span style="color:red" v-else><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['report']">{{ cv_output['report']['number-of-pages'] }}</span>
                                    <span style="color:red" v-else><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['report'] && cv_output['report']['institutions'] == null">-</span>
                                    <span v-if="cv_output['report'] && cv_output['report']['institutions']">{{ cv_output['report']['institutions']['institution'][0]['institution-name'] }}</span>
                                    <span style="color:red" v-if="cv_output['report'] == null"><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['report']">{{ cv_output['report']['date-submitted']['year'] }}</span>
                                    <span style="color:red" v-else><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['report'] && cv_output['report']['authoring-role'] == null">-</span>
                                    <span v-if="cv_output['report'] && cv_output['report']['authoring-role']">{{ cv_output['report']['authoring-role']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['report'] == null"><b>No Report</b></span>
                                </td>

                                <td><span v-if="cv_output['report']">{{ cv_output['report']['url'] }}</span>
                                    <span style="color:red" v-else><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['report']">{{ cv_output['report']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Report</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation']">{{ cv_output['dissertation']['title'] }}</span>
                                    <span style="color:red" v-else><b>No Dissertation</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation']">{{ cv_output['dissertation']['number-of-volumes'] }}</span>
                                    <span style="color:red" v-else><b>No Dissertation</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation'] && cv_output['dissertation']['degree-type'] == null">-</span>
                                    <span v-if="cv_output['dissertation'] && cv_output['dissertation']['degree-type']">{{ cv_output['dissertation']['degree-type']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['dissertation'] == null"><b>No Dissertation</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation']">{{ cv_output['dissertation']['classification'] }}</span>
                                    <span style="color:red" v-else><b>No Dissertation</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation']">{{ cv_output['dissertation']['completion-date']['year'] }}</span>
                                    <span style="color:red" v-else><b>No Dissertation</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation']">{{ cv_output['dissertation']['url'] }}</span>
                                    <span style="color:red" v-else><b>No Dissertation</b></span>
                                </td>
                                <td><span v-if="cv_output['dissertation']">{{ cv_output['dissertation']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Dissertation</b></span>
                                </td>

                                <td><span v-if="cv_output['license']">{{ cv_output['license']['license-title'] }}</span>
                                    <span style="color:red" v-else><b>No License</b></span>
                                </td>
                                <td><span v-if="cv_output['license']">{{ cv_output['license']['date-issued']['year'] }}</span>
                                    <span style="color:red" v-else><b>No License</b></span>
                                </td>
                                <td><span v-if="cv_output['license'] && cv_output['license']['end-date'] == null">-</span>
                                    <span v-if="cv_output['license'] && cv_output['license']['end-date']">{{ cv_output['license']['end-date']['year'] }}</span>
                                    <span style="color:red" v-if="cv_output['license'] == null"><b>No License</b></span>
                                </td>
                                <td><span v-if="cv_output['license'] && cv_output['license']['country'] == null">-</span>
                                    <span v-if="cv_output['license'] && cv_output['license']['country']">{{ cv_output['license']['country']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['license'] == null"><b>No License</b></span>
                                </td>
                                <td><span v-if="cv_output['license']">{{ cv_output['license']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No License</b></span>
                                </td>

                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['chapter-title'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['book-title'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['book-volume'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['publication-year'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter'] && cv_output['book-chapter']['publication-location'] && cv_output['book-chapter']['publication-location']['country'] == null">-</span>
                                    <span v-if="cv_output['book-chapter'] && cv_output['book-chapter']['publication-location'] && cv_output['book-chapter']['publication-location']['country']">{{ cv_output['book-chapter']['publication-location']['country']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['book-chapter'] == null"><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['book-publisher'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['url'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>
                                <td><span v-if="cv_output['book-chapter']">{{ cv_output['book-chapter']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Book Chapter</b></span>
                                </td>

                                <td><span v-if="cv_output['patent']">{{ cv_output['patent']['patent-title'] }}</span>
                                    <span style="color:red" v-else><b>No Patent</b></span>
                                </td>
                                <td><span v-if="cv_output['patent']">{{ cv_output['patent']['date-issued']['year'] }}</span>
                                    <span style="color:red" v-else><b>No Patent</b></span>
                                </td>
                                <td><span v-if="cv_output['patent'] && cv_output['patent']['date-of-term-end'] == null">-</span>
                                    <span v-if="cv_output['patent'] && cv_output['patent']['date-of-term-end']">{{ cv_output['patent']['date-of-term-end']['year'] }}</span>
                                    <span style="color:red" v-if="cv_output['patent'] == null"><b>No Patent</b></span>
                                </td>
                                <td><span v-if="cv_output['patent'] && cv_output['patent']['country'] == null">-</span>
                                    <span v-if="cv_output['patent'] && cv_output['patent']['country']">{{ cv_output['patent']['country']['value'] }}</span>
                                    <span style="color:red" v-if="cv_output['patent'] == null"><b>No Patent</b></span>
                                </td>
                                <td><span v-if="cv_output['patent']">{{ cv_output['patent']['authors']['citation'] }}</span>
                                    <span style="color:red" v-else><b>No Patent</b></span>
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
            userAuthenticated: '',
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

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Conference paper" || cv_output['output-type']['value'] == "Artigo em conferência") {

                    aux = aux +
                        this.formatRow_conferece(
                            cv_output['conference-paper']['authors']['citation'],
                            cv_output['conference-paper']['conference-date']['year'],
                            cv_output['conference-paper']['paper-title'],
                            cv_output['conference-paper']['conference-location'] ? cv_output['conference-paper']['conference-location']['country']['value'] : null,
                            cv_output['conference-paper']['proceedings-publisher']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n------------------------------ Artigo em revista ---------------------------\n\n";

            for (let cv_output of this.cv_outputs) {
                if (cv_output['output-type']['value'] == "Journal article" || cv_output['output-type']['value'] == "Artigo em revista") {
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
                if (cv_output['output-type']['value'] == "Book" || cv_output['output-type']['value'] == "Livro") {
                    aux = aux +
                        this.formatRow_book(cv_output['book']['authors']['citation'],
                            cv_output['book']['publication-year'],
                            cv_output['book']['title'],
                            //FAZER ISTO PARA TODOS:
                            cv_output['book']['publication-location'] ? cv_output['book']['publication-location']['country']['value'] : null,
                            cv_output['book']['publisher'],
                            cv_output['book']['url']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Outra Produção -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Other output" || cv_output['output-type']['value'] == "Outra produção") {
                    aux = aux +
                        this.formatRow_others(cv_output['other-output']['authors']['citation'],
                            cv_output['other-output']['publication-date']['year'],
                            cv_output['other-output']['title'],
                            cv_output['other-output']['url']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Relatório -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Report" || cv_output['output-type']['value'] == "Relatório") {
                    aux = aux +
                        this.formatRow_report(cv_output['report']['authors']['citation'],
                            cv_output['report']['date-submitted']['year'],
                            cv_output['report']['report-title'],
                            cv_output['report']['institutions'] ? cv_output['report']['institutions']['institution'][0]['institution-name'] : null,
                            cv_output['report']['authoring-role'] ? cv_output['report']['authoring-role']['value'] : null,
                            cv_output['report']['url']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Tese -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Dissertation" || cv_output['output-type']['value'] == "Tese / Dissertação") {
                    aux = aux +
                        this.formatRow_dissertation(
                            cv_output['dissertation']['authors']['citation'],
                            cv_output['dissertation']['completion-date']['year'],
                            cv_output['dissertation']['title'],
                            cv_output['dissertation']['degree-type'] ? cv_output['dissertation']['degree-type']['value'] : null,
                            cv_output['dissertation']['classification'],
                            cv_output['dissertation']['url']
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Licenciamento -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "License" || cv_output['output-type']['value'] == "Licenciamento") {
                    aux = aux +
                        this.formatRow_license(
                            cv_output['license']['authors']['citation'],
                            cv_output['license']['date-issued']['year'],
                            cv_output['license']['end-date']['year'],
                            cv_output['license']['country']['value'],
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Patente -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Patent" || cv_output['output-type']['value'] == "Patente") {
                    aux = aux +
                        this.formatRow_patent(
                            cv_output['patent']['authors']['citation'],
                            cv_output['patent']['date-issued']['year'],
                            cv_output['patent']['date-of-term-end']['year'],
                            cv_output['patent']['patent-title'],
                            cv_output['patent']['country']['value'],
                        ) + "\n\n";
                }
            }
            aux = aux + "\n\n-------------------------- Capítulo de livro -------------------------------\n\n";

            for (let cv_output of this.cv_outputs) {

                if (cv_output['output-type']['value'] == "Book Chapter" || cv_output['output-type']['value'] == "Capítulo de livro") {
                    aux = aux +
                        this.formatRow_bookChapter(
                            cv_output['book-chapter']['authors']['citation'],
                            cv_output['book-chapter']['publication-year'],
                            cv_output['book-chapter']['chapter-title'],
                            cv_output['book-chapter']['book-title'],
                            cv_output['book-chapter']['publication-location'] ? cv_output['book-chapter']['publication-location']['country']['value'] : null,
                            cv_output['book-chapter']['book-publisher'],
                            cv_output['book-chapter']['url']
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

        getLocalDataToCSV() {
            axios.get('api/cv/getLocalCienciaVitae_Outputs')
                .then(response => {
                    console.log("Dados:")
                    console.log(response.data.data)
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
                    this.selectedStartYear=0;
                    this.selectedEndYear=0;
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
                                        (cv_output['output-type']['value'] === "Journal article" || cv_output['output-type']['value'] === "Artigo em revista") &&
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
                                        (cv_output['output-type']['value'] === "Book" || cv_output['output-type']['value'] === "Livro") &&
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
                                        (cv_output['output-type']['value'] === "Conference paper" || cv_output['output-type']['value'] === "Artigo em conferência") &&
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
                                        (cv_output['output-type']['value'] === "Other output" || cv_output['output-type']['value'] === "Outra produção") &&
                                        (
                                            (cv_output['other-output']['publication-date']['year'] >= begin) &&
                                            (cv_output['other-output']['publication-date']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }

                            }

                            if (this.checkedTypeFilters.includes('Patent')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Patent" || cv_output['output-type']['value'] === "Patente") &&
                                        (
                                            (cv_output['patent']['date-issued']['year'] >= begin) &&
                                            (cv_output['patent']['date-issued']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }                            

                            if (this.checkedTypeFilters.includes('Book Chapter')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Book Chapter" || cv_output['output-type']['value'] === "Capítulo de livro") &&
                                        (
                                            (cv_output['book-chapter']['publication-year'] >= begin) &&
                                            (cv_output['book-chapter']['publication-year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }

                            if (this.checkedTypeFilters.includes('Dissertation')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Dissertation" || cv_output['output-type']['value'] === "Tese / Dissertação") &&
                                        (
                                            (cv_output['dissertation']['completion-date']['year'] >= begin) &&
                                            (cv_output['dissertation']['completion-date']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }

                            if (this.checkedTypeFilters.includes('License')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "License" || cv_output['output-type']['value'] === "Licenciamento") &&
                                        (
                                            (cv_output['license']['date-issued']['year'] >= begin) &&
                                            (cv_output['license']['date-issued']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            } 

                            if (this.checkedTypeFilters.includes('Report')) {
                                if (
                                    (
                                        (cv_output['output-type']['value'] === "Report" || cv_output['output-type']['value'] === "Relatório") &&
                                        (
                                            (cv_output['report']['date-submitted']['year'] >= begin) &&
                                            (cv_output['report']['date-submitted']['year'] <= end)
                                        )
                                    )) {
                                    cv_outputs_aux_filtrada.push(cv_output);
                                }
                            }  
                        }
                        this.cv_outputs = cv_outputs_aux_filtrada.splice(0);
                        //this.cv_outputs = cv_outputs_aux_full.splice(0);
                        console.log('teste');
                        console.log(this.cv_outputs);
                        console.log(cv_outputs_aux_filtrada)
                        console.log(cv_outputs_aux_full)
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

                    //PATENTE

                    patent_title: (cv_output['patent'] &&
                            cv_output['patent']['patent-title']) ?
                        cv_output['patent']['patent-title'] : "Not defined.",

                    patent_date_issued_year: (cv_output['patent'] &&
                            cv_output['patent']['date-issued'] &&
                            cv_output['patent']['date-issued']['year']) ?
                        cv_output['patent']['date-issued']['year'] : "Not defined.",

                    patent_date_of_term_end_year: (cv_output['patent'] &&
                            cv_output['patent']['date-of-term-end'] &&
                            cv_output['patent']['date-of-term-end']['year']) ?
                        cv_output['patent']['date-of-term-end']['year'] : "Not defined.",

                    patent_country: (cv_output['patent'] &&
                            cv_output['patent']['country'] &&
                            cv_output['patent']['country']['value']) ?
                        cv_output['patent']['country']['value'] : "Not defined.",

                    patent_authors_citation: (cv_output['patent'] &&
                            cv_output['patent']['authors'] &&
                            cv_output['patent']['authors']['citation']) ?
                        cv_output['patent']['authors']['citation'] : "Not defined.",

                    //FIM PATENTE

                    //CAPITULO LIVRO

                    book_chapter_chapter_title: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['chapter-title']) ?
                    cv_output['book-chapter']['chapter-title'] : "Not defined.",

                    book_chapter_title: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['book-title']) ?
                        cv_output['book-chapter']['book-title'] : "Not defined.",

                    book_chapter_volume: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['book-volume']) ?
                    cv_output['book-chapter']['book-volume'] : "Not defined.",

                    book_chapter_authors_citation: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['authors'] &&
                            cv_output['book-chapter']['authors']['citation']) ?
                        cv_output['book-chapter']['authors']['citation'] : "Not defined.",

                    book_chapter_publication_year: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['publication-year']) ?
                        cv_output['book-chapter']['publication-year'] : "Not defined",

                    book_chapter_publication_location_country: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['publication-location'] &&
                            cv_output['book-chapter']['publication-location']['country'] &&
                            cv_output['book-chapter']['publication-location']['country']['value']) ?
                        cv_output['book-chapter']['publication-location']['country']['value'] : "Not defined.",

                    book_chapter_book_publisher: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['book-publisher']) ?
                        cv_output['book-chapter']['book-publisher'] : "Not defined.",

                    book_chapter_url: (cv_output['book-chapter'] &&
                            cv_output['book-chapter']['url']) ?
                        cv_output['book-chapter']['url'] : "Not defined",

                    //FIM CAPITULO LIVRO
                    
                    //DISSERTATION (Tese)

                    dissertation_title: (cv_output['dissertation'] && 
                        cv_output['dissertation']['title']) ? 
                        cv_output['dissertation']['title'] : "Not defined",

                    dissertation_number_of_volumes: (cv_output['dissertation'] && 
                        cv_output['dissertation']['number-of-volumes']) ? 
                        cv_output['dissertation']['number-of-volumes'] : "Not defined",

                    //'dissertation_institutions', // confirmar este

                    dissertation_degree_type_value: (cv_output['dissertation'] && 
                        cv_output['dissertation']['degree-type'] && 
                        cv_output['dissertation']['degree-type']['value']) ? 
                    cv_output['dissertation']['degree-type']['value'] : "Not defined",

                    dissertation_classification: (cv_output['dissertation'] && 
                        cv_output['dissertation']['classification']) ? 
                    cv_output['dissertation']['classification'] : "Not defined",

                    dissertation_completion_date_year: (cv_output['dissertation'] && 
                        cv_output['dissertation']['completion-date'] && 
                        cv_output['dissertation']['completion-date']['year']) ? 
                    cv_output['dissertation']['completion-date']['year'] : "Not defined",

                    dissertation_url: (cv_output['dissertation'] && 
                        cv_output['dissertation']['url']) ? 
                        cv_output['dissertation']['url'] : "Not defined",

                    dissertation_authors_citation: (cv_output['dissertation'] && 
                        cv_output['dissertation']['authors'] && 
                        cv_output['dissertation']['authors']['citation']) ?
                    cv_output['dissertation']['authors']['citation'] : "Not defined.",

                    //FIM DiSSERTATION (Tese)

                    //LICENCIAMENTO

                    license_title: (cv_output['license'] && 
                        cv_output['license']['license-title']) ? 
                    cv_output['license']['license-title'] : "Not defined",

                    license_date_issued_year: (cv_output['license'] && 
                        cv_output['license']['date-issued'] &&
                        cv_output['license']['date-issued']['year']) ? 
                    cv_output['license']['date-issued']['year'] : "Not defined",
                    
                    license_end_date: (cv_output['license'] && 
                        cv_output['license']['end-date'] &&
                        cv_output['license']['end-date']['year']) ? 
                    cv_output['license']['end-date']['year'] : "Not defined",

                    license_country:(cv_output['license'] && 
                        cv_output['license']['country'] &&
                        cv_output['license']['country']['value']) ? 
                    cv_output['license']['country']['value'] : "Not defined",

                    license_authors_citation: (cv_output['license'] && 
                        cv_output['license']['authors'] && 
                        cv_output['license']['authors']['citation']) ?
                    cv_output['license']['authors']['citation'] : "Not defined.",


                    //FIM LICENCIAMENTO

                    //RELATÓRIO:

                    report_title: (cv_output['report'] &&
                            cv_output['report']['report-title']) ?
                        cv_output['report']['report-title'] : "Not defined.",

                    report_volume: (cv_output['report'] &&
                            cv_output['report']['volume']) ?
                        cv_output['report']['volume'] : "Not defined.",
                        
                    report_number_of_pages: (cv_output['report'] &&
                            cv_output['report']['number-of-pages']) ?
                        cv_output['report']['number-of-pages'] : "Not defined.",

                    report_institutions_institution_institution_name: (cv_output['report'] &&
                            cv_output['report']['institutions']) &&
                            cv_output['report']['institutions']['institution'][0] &&
                            cv_output['report']['institutions']['institution'][0]['institution-name'] ?
                        cv_output['report']['institutions']['institution'][0]['institution-name'] : "Not defined.",

                    report_date_submitted_year: (cv_output['report'] &&
                        cv_output['report']['date-submitted'] &&
                        cv_output['report']['date-submitted']['year']) ?
                    cv_output['report']['date-submitted']['year'] : "Not defined.",

                    report_authoring_role_value: (cv_output['report'] &&
                        cv_output['report']['authoring-role'] &&
                        cv_output['report']['authoring-role']['value']) ?
                    cv_output['report']['authoring-role']['value'] : "Not defined.",

                    report_url: (cv_output['report'] &&
                            cv_output['report']['url']) ?
                        cv_output['report']['url'] : "Not defined.",

                    report_authors: (cv_output['report'] && 
                            cv_output['report']['authors'] && 
                            cv_output['report']['authors']['citation']) ?
                        cv_output['report']['authors']['citation'] : "Not defined.",
                    //////////////////FIM RELATÓRIO

                    journal_article_title: (cv_output['journal-article'] &&
                            cv_output['journal-article']['article-title']) ?
                        cv_output['journal-article']['article-title'] : "Not defined.",

                    journal_article_publication_date_year: (cv_output['journal-article'] &&
                            cv_output['journal-article']['publication-date'] &&
                            cv_output['journal-article']['publication-date']['year']) ?
                        cv_output['journal-article']['publication-date']['year'] : "Not defined.",

                    journal_article_publication_location: (cv_output['journal-article'] &&
                            cv_output['journal-article']['publication-location'] &&
                            cv_output['journal-article']['publication-location']['country'] &&
                            cv_output['journal-article']['publication-location']['country']['value']) ?
                        cv_output['journal-article']['publication-location']['country']['value'] : "Not defined.",

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

                    conference_paper_conference_location_value: (cv_output['conference-paper'] &&
                            cv_output['conference-paper']['conference-location'] &&
                            cv_output['conference-paper']['conference-location']['country'] &&
                            cv_output['conference-paper']['conference-location']['country']['value']) ?
                        cv_output['conference-paper']['conference-location']['country']['value'] : "Not defined",

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
            //eles tinham: (mas apesar de funcionar, dava erro na consola de string to array)
            this.filtered_data_to_csv = JSON.stringify(lista2);
            //apesar de a linha de cima dar erro na consola, só assim é que dá para exportar a tabela de filtered para o excel!!

            //então alterei para este para resolver o problema de cima
            //this.filtered_data_to_csv = Object.keys(lista2.data);//.split(" ");
            //console.log("filter:");
            //console.log(this.filtered_data_to_csv);
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
            this.checkedTypeFilters.push('Patent');
            this.checkedTypeFilters.push('Book Chapter');
            this.checkedTypeFilters.push('Dissertation');
            this.checkedTypeFilters.push('License');
            this.checkedTypeFilters.push('Report');
        },
        updateToCIICDatabase(){
            axios.get('api/getScienceUserAuthenticated/')
                .then(response => {
                    this.userAuthenticated = response.data;
                    //console.log("teste")
                    //console.log(response.data)
                    //console.log(this.userAuthenticated)
                    
                axios.delete('api/cv_outputs/deleteDadosDatabase/' + this.userAuthenticated)
                    .then(response => {
                        console.log("sucesso!")
                        
                        this.saveCienciaVitaeToLocalDataBase(this.userAuthenticated)
                    })
                    .catch(function (error) {

                        console.log(error);
                    })
                })
                .catch(function (error) {

                console.log(error);
                })

        },

        saveCienciaVitaeToLocalDataBase(id) {


            for (let cv_output of this.cv_outputs) {


                    if(cv_output['report']){
                        console.log("teste2");
                        console.log(cv_output['report']['institutions']['institution'][0]['institution-name'])
                    }
                    
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
                                cv_output['book-chapter']['publication-year'] : "Not defined",

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
                                cv_output['book-chapter']['url'] : "Not defined",

                            //FIM CAPITULO LIVRO
                            
                            //DISSERTATION (Tese)

                            'dissertation_title': (cv_output['dissertation'] && 
                                cv_output['dissertation']['title']) ? 
                                cv_output['dissertation']['title'] : "Not defined",

                            'dissertation_number_of_volumes': (cv_output['dissertation'] && 
                                cv_output['dissertation']['number-of-volumes']) ? 
                                cv_output['dissertation']['number-of-volumes'] : "Not defined",

                            //'dissertation_institutions', // confirmar este

                            'dissertation_degree_type_value': (cv_output['dissertation'] && 
                                cv_output['dissertation']['degree-type'] && 
                                cv_output['dissertation']['degree-type']['value']) ? 
                            cv_output['dissertation']['degree-type']['value'] : "Not defined",

                            'dissertation_classification': (cv_output['dissertation'] && 
                                cv_output['dissertation']['classification']) ? 
                            cv_output['dissertation']['classification'] : "Not defined",

                            'dissertation_completion_date_year': (cv_output['dissertation'] && 
                                cv_output['dissertation']['completion-date'] && 
                                cv_output['dissertation']['completion-date']['year']) ? 
                            cv_output['dissertation']['completion-date']['year'] : "Not defined",

                            'dissertation_url': (cv_output['dissertation'] && 
                                cv_output['dissertation']['url']) ? 
                                cv_output['dissertation']['url'] : "Not defined",

                            'dissertation_authors_citation': (cv_output['dissertation'] && 
                                cv_output['dissertation']['authors'] && 
                                cv_output['dissertation']['authors']['citation']) ?
                            cv_output['dissertation']['authors']['citation'] : "Not defined.",

                            //FIM DiSSERTATION (Tese)

                            //LICENCIAMENTO

                            'license_title': (cv_output['license'] && 
                                cv_output['license']['license-title']) ? 
                            cv_output['license']['license-title'] : "Not defined",

                            'license_date_issued_year': (cv_output['license'] && 
                                cv_output['license']['date-issued'] &&
                                cv_output['license']['date-issued']['year']) ? 
                            cv_output['license']['date-issued']['year'] : "Not defined",
                            
                            'license_end_date': (cv_output['license'] &&
                                cv_output['license']['end-date'] && 
                                cv_output['license']['end-date']['year']) ? 
                            cv_output['license']['end-date']['year'] : "Not defined",

                            'license_country':(cv_output['license'] && 
                                cv_output['license']['country'] &&
                                cv_output['license']['country']['value']) ? 
                            cv_output['license']['country']['value'] : "Not defined",

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
                                    cv_output['report']['institutions']['institution'][0] &&
                                    cv_output['report']['institutions']['institution'][0]['institution-name'] ?
                                cv_output['report']['institutions']['institution'][0]['institution-name'] : "Not defined." ,

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
                                    cv_output['journal-article']['publication-location']['country'] &&
                                    cv_output['journal-article']['publication-location']['country']['value']) ?
                                cv_output['journal-article']['publication-location']['country']['value'] : "Not defined.",

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

                            'conference_paper_conference_location_value': (cv_output['conference-paper'] &&
                                    cv_output['conference-paper']['conference-location'] &&
                                    cv_output['conference-paper']['conference-location']['country'] &&
                                    cv_output['conference-paper']['conference-location']['country']['value']) ?
                                cv_output['conference-paper']['conference-location']['country']['value'] : "Not defined",

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
