<template>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ciencia Vitae Employments</h3>
                    <div class="card-tools">
                        <download-csv 
                            class="btn btn-dark" 
                            :data="data_to_csv" 
                            name="CIIC_DB_Employment.csv">
                            <font color="white">EXPORT CIIC TABLE TO CSV</font>
                        </download-csv>
                        <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Employment Category(Value)</th>
                                <th>Employment Category(Other Value)</th>
                                <th>Employment Category(Code)</th>
                                <th>Institution Name</th>
                                <th>Institution Address(City)</th>
                                <th>Institution Address(Region)</th>
                                <th>Institution Address(Country Code)</th>
                                <th>Institution Address(Country Value)</th>
                                <th>Institution Sector(Code)</th>
                                <th>Institution Sector(Value)</th>
                                <th>Institution Identifier(Type)</th>
                                <th>Institution Identifier(Identifier)</th>
                                <th>Other Institution Identifier(Type)</th>
                                <th>Other Institution Identifier(Type)</th>
                                <th>Position Type(Value)</th>
                                <th>Position Type(Other Value)</th>
                                <th>Position Type(Code)</th>
                                <th>Position Title(Code)</th>
                                <th>Position Title(Value)</th>
                                <th>Position Title Group(Code)</th>
                                <th>Position Title Group(Value)</th>
                                <th>Start Date(Year)</th>
                                <th>End Date(Year)</th>
                                <th>ID</th>
                                <th>Privacy Level</th>
                                <th>Source Name</th>
                                <th>Last Modified Date</th>
                            </tr>
                            <tr v-for="cv_employment in cv_employments" :key="cv_employment.id">
                                <td><span v-if="cv_employment['employment-category']['value']">{{ cv_employment['employment-category']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Employment Category(Value)</b></span>
                                </td>
                                <td><span v-if="cv_employment['employment-category']['other-value']">{{ cv_employment['employment-category']['other-value'] }}</span>
                                    <span style="color:red" v-else><b>No Employment Category(Other Value)</b></span>
                                </td>
                                <td><span v-if="cv_employment['employment-category']['code']">{{ cv_employment['employment-category']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Employment Category(Code)</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-name']">{{ cv_employment['institution']['institution-name'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Name</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-address']">{{ cv_employment['institution']['institution-address']['city'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Address</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-address']">{{ cv_employment['institution']['institution-address']['region'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Address</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-address']">{{ cv_employment['institution']['institution-address']['country']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Address</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-address']">{{ cv_employment['institution']['institution-address']['country']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Address</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-sector']">{{ cv_employment['institution']['institution-sector']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Sector</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-sector']">{{ cv_employment['institution']['institution-sector']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Sector</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-identifier']">{{ cv_employment['institution']['institution-identifier']['type'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Identifier</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-identifier']">{{ cv_employment['institution']['institution-identifier']['identifier'] }}</span>
                                    <span style="color:red" v-else><b>No Institution Identifier</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-other-identifiers']">{{ cv_employment['institution']['institution-other-identifiers']['institution-identifier'][0]['type'] }}</span>
                                    <span style="color:red" v-else><b>No Other Institution Identifier</b></span>
                                </td>
                                <td><span v-if="cv_employment['institution']['institution-other-identifiers']">{{ cv_employment['institution']['institution-other-identifiers']['institution-identifier'][1]['type'] }}</span>
                                    <span style="color:red" v-else><b>No Other Institution Identifier</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-type']">{{ cv_employment['position-type']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Position Type</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-type']">{{ cv_employment['position-type']['other-value'] }}</span>
                                    <span style="color:red" v-else><b>No Position Type</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-type']">{{ cv_employment['position-type']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Position Type</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-title']">{{ cv_employment['position-title']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Position Title</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-title']">{{ cv_employment['position-title']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Position Title</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-title-group']">{{ cv_employment['position-title-group']['code'] }}</span>
                                    <span style="color:red" v-else><b>No Position Title Group</b></span>
                                </td>
                                <td><span v-if="cv_employment['position-title-group']">{{ cv_employment['position-title-group']['value'] }}</span>
                                    <span style="color:red" v-else><b>No Position Title Group</b></span>
                                </td>
                                <td><span v-if="cv_employment['start-date']">{{ cv_employment['start-date']['year'] }}</span>
                                    <span style="color:red" v-else><b>No Start Date</b></span>
                                </td>
                                <td><span v-if="cv_employment['end-date']">{{ cv_employment['end-date']['year'] }}</span>
                                    <span style="color:red" v-else><b>No End Date</b></span>
                                </td>
                                <td><span v-if="cv_employment['id']">{{ cv_employment['id'] }}</span>
                                    <span style="color:red" v-else><b>No ID</b></span>
                                </td>
                                <td><span v-if="cv_employment['privacy-level']">{{ cv_employment['privacy-level'] }}</span>
                                    <span style="color:red" v-else><b>No Privacy Level</b></span>
                                </td>
                                <td><span v-if="cv_employment['source-name']">{{ cv_employment['source-name'] }}</span>
                                    <span style="color:red" v-else><b>No Source Name</b></span>
                                </td>
                                <td><span v-if="cv_employment['last-modified-date']">{{ cv_employment['last-modified-date'] }}</span>
                                    <span style="color:red" v-else><b>No Last Modified Date</b></span>
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
</div>
</template>

<script>
// Component code (not registered)

export default {
    data: function () {
        return {
            cv_employments: [],
            data_to_csv: []
        }
    },
    methods: {
        getLocalDataToCSV() {
            axios.get('api/cv/getLocalCienciaVitae_Employment')
                .then(response => {
                    this.data_to_csv = response.data.data;
                });
        },
        loadEmployments() {
            axios.get('api/cv/getRemoteCienciaVitaeEmployment')
                .then(response => {
                    this.cv_employments = response.data["employment"];
                });
        },
        saveCienciaVitaeToLocalDataBase() {

            for (let cv_employment of this.cv_employments) {

                axios({

                        method: 'post',
                        url: 'api/cv_save_employments/saveCienciaVitaeToLocalDataBase',
                        data: {

                            'user_science_id': null,

                            'employment_category_value': (cv_employment['employment-category'] &&
                                    cv_employment['employment-category']['value']) ?
                                cv_employment['employment-category']['value'] : "Not defined.",

                            'employment_category_other_value': (cv_employment['employment-category'] &&
                                    cv_employment['employment-category']['other-value']) ?
                                cv_employment['employment-category']['other-value'] : "Not defined.",

                            'employment_category_code': (cv_employment['employment-category'] &&
                                    cv_employment['employment-category']['code']) ?
                                cv_employment['employment-category']['code'] : "Not defined.",

                            'institution_institution_name': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-name']) ?
                                cv_employment['institution']['institution-name'] : "Not defined.",

                            'institution_institution_address_city': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-address'] &&
                                    cv_employment['institution']['institution-address']['city']) ?
                                cv_employment['institution']['institution-address']['city'] : "Not defined.",

                            'institution_institution_address_region': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-address'] &&
                                    cv_employment['institution']['institution-address']['region']) ?
                                cv_employment['institution']['institution-address']['region'] : "Not defined.",

                            'institution_institution_address_country_code': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-address'] &&
                                    cv_employment['institution']['institution-address']['country'] &&
                                    cv_employment['institution']['institution-address']['country']['code']) ?
                                cv_employment['institution']['institution-address']['country']['code'] : "Not defined.",

                            'institution_institution_address_country_value': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-address'] &&
                                    cv_employment['institution']['institution-address']['country'] &&
                                    cv_employment['institution']['institution-address']['country']['value']) ?
                                cv_employment['institution']['institution-address']['country']['value'] : "Not defined.",

                            'institution_institution_sector_code': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-sector'] &&
                                    cv_employment['institution']['institution-sector']['code']) ?
                                cv_employment['institution']['institution-sector']['code'] : "Not defined.",

                            'institution_institution_sector_value': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-sector'] &&
                                    cv_employment['institution']['institution-sector']['value']) ?
                                cv_employment['institution']['institution-sector']['value'] : "Not defined.",

                            'institution_institution_identifier_type': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-identifier'] &&
                                    cv_employment['institution']['institution-identifier']['type']) ?
                                cv_employment['institution']['institution-identifier']['type'] : "Not defined.",

                            'institution_institution_identifier_identifier': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-identifier'] &&
                                    cv_employment['institution']['institution-identifier']['identifier']) ?
                                cv_employment['institution']['institution-identifier']['identifier'] : "Not defined.",

                            'other_identifiers_institution_identifier_type_0': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-other-identifiers'] &&
                                    cv_employment['institution']['institution-other-identifiers']['institution-identifier'] &&
                                    cv_employment['institution']['institution-other-identifiers']['institution-identifier'][0]['type']) ?
                                cv_employment['institution']['institution-other-identifiers']['institution-identifier'][0]['type'] : "Not defined.",

                            'other_identifiers_institution_identifier_type_1': (cv_employment['institution'] &&
                                    cv_employment['institution']['institution-other-identifiers'] &&
                                    cv_employment['institution']['institution-other-identifiers']['institution-identifier'] &&
                                    cv_employment['institution']['institution-other-identifiers']['institution-identifier'][1]['type']) ?
                                cv_employment['institution']['institution-other-identifiers']['institution-identifier'][1]['type'] : "Not defined.",

                            'position_type_value': (cv_employment['position-type'] &&
                                    cv_employment['position-type']['value']) ?
                                cv_employment['position-type']['value'] : "Not defined.",

                            'position_type_other_value': (cv_employment['position-type'] &&
                                    cv_employment['position-type']['other-value']) ?
                                cv_employment['position-type']['other-value'] : "Not defined.",

                            'position_type_code': (cv_employment['position-type'] &&
                                    cv_employment['position-type']['code']) ?
                                cv_employment['position-type']['code'] : "Not defined.",

                            'position_title_code': (cv_employment['position-title'] &&
                                    cv_employment['position-title']['code']) ?
                                cv_employment['position-title']['code'] : "Not defined.",

                            'position_title_value': (cv_employment['position-title'] &&
                                    cv_employment['position-title']['value']) ?
                                cv_employment['position-title']['value'] : "Not defined.",

                            'position_title_group_code': (cv_employment['position-title-group'] &&
                                    cv_employment['position-title-group']['code']) ?
                                cv_employment['position-title-group']['code'] : "Not defined.",

                            'position_title_group_value': (cv_employment['position-title-group'] &&
                                    cv_employment['position-title-group']['value']) ?
                                cv_employment['position-title-group']['value'] : "Not defined.",

                            'start_date_year': (cv_employment['start-date'] &&
                                    cv_employment['start-date']['year']) ?
                                cv_employment['start-date']['year'] : "Not defined.",

                            'end_date_year': (cv_employment['end-date'] &&
                                    cv_employment['end-date']['year']) ?
                                cv_employment['end-date']['year'] : "Not defined.",

                            'id_row_entry': (cv_employment['id']) ?
                                cv_employment['id'] : "Not defined.",

                            'privacy_level': (cv_employment['privacy-level']) ?
                                cv_employment['privacy-level'] : "Not defined.",

                            'source_name': (cv_employment['source-name']) ?
                                cv_employment['source-name'] : "Not defined.",

                            'last_modified_date': (cv_employment['last-modified-date']) ?
                                cv_employment['last-modified-date'] : "Not defined.",

                        },

                    }).then(function (response) {
                        Swal.fire({
                            type: 'success',
                            title: 'Local Employments Updated!',
                            showConfirmButton: true,
                        })
                    Fire.$emit('refresh');    
                    })
                    .catch(function (error) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                        console.log(error);
                    });
            }
        },

    },
    created() {
        this.loadEmployments();
        this.getLocalDataToCSV();
        Fire.$on('refresh', () => {
            this.loadEmployments();
            this.getLocalDataToCSV();
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
