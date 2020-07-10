<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ciencia Vitae Degrees</h3>
            <!--
                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
                -->
            <div class="card-tools">

              <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Degrees.csv">

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
                                                  <th>
                                    <button
                                      type="button"
                                      class="btn btn-warning"
                                      @click="text_to_copy = formatAllRows()"
                                      data-toggle="modal"
                                      data-target="#copyAllRowsModal">Copy All</button>
                                </th>
                  <th>ID</th>
                  <th>Degree Type(value)</th>
                  <th>Degree Type(code)</th>
                  <th>Degree Code(value)</th>
                  <th>Degree Code(speciality code)</th>
                  <th>Degree Name</th>
                  <th>Institution Name</th>
                  <th>Institution City</th>
                  <th>Institution Country</th>
                  <th>Degree Major</th>        
                  <th>Degree Status(value)</th>
                  <th>Degree Status(code)</th>
                  <th>Description</th>
                  <th>End Date</th>                            
                  <th>Privacy Level</th>
                  <th>Research Classifications</th>
                  <th>Source Name</th>
                  <th>Start Date</th>
                  <th>Thesis</th>
                  <th>Last Modified Date</th>
                </tr>

                <tr v-for="cv_degree in cv_degrees" :key="cv_degree.degree_name">

                                <td>
                                    <button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow(
                                        cv_degree['end-date']['year'],
                                          cv_degree['degree-type']['value'], 
                                      cv_degree['degree-name'], 
                                      cv_degree['institutions']['institution'][0]['institution-name'],
                                      cv_degree['institutions']['institution'][0]['institution-address']['city'],
                                      cv_degree['institutions']['institution'][0]['institution-address']['country']['value']

                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                </td>

                  <td><span v-if="cv_degree['id']">{{ cv_degree['id'] }}</span>
                        <span style="color:red" v-else><b>No ID</b></span>
                  </td> 
                  <td><span v-if="cv_degree['degree-type']">{{ cv_degree['degree-type']['value'] }}</span>
                        <span style="color:red" v-else><b>No Degree Type</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-type']">{{ cv_degree['degree-type']['code'] }}</span>
                        <span style="color:red" v-else><b>No Degree Type</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-code']">{{ cv_degree['degree-code']['value'] }}</span>
                        <span style="color:red" v-else><b>No Degree Code</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-code']['speciality-code']">{{ cv_degree['degree-code']['speciality-code'] }}</span>
                        <span style="color:red" v-else><b>No Degree Speciality Code</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-name']">{{ cv_degree['degree-name'] }}</span>
                        <span style="color:red" v-else><b>No Degree Name</b></span>
                  </td>
                  <td><span v-if="cv_degree['institutions']">{{ cv_degree['institutions']['institution'][0]['institution-name'] }}</span>
                        <span style="color:red" v-else><b>No Institutions</b></span>
                  </td>
                  <td><span v-if="cv_degree['institutions']">{{ cv_degree['institutions']['institution'][0]['institution-address']['city'] }}</span>
                        <span style="color:red" v-else><b>No Institutions</b></span>
                  </td>
                  <td><span v-if="cv_degree['institutions']">{{ cv_degree['institutions']['institution'][0]['institution-address']['country']['value'] }}</span>
                        <span style="color:red" v-else><b>No Institutions</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-major']">{{ cv_degree['degree-major'] }}</span>
                        <span style="color:red" v-else><b>No Degree Major</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-status']">{{ cv_degree['degree-status']['value'] }}</span>
                        <span style="color:red" v-else><b>No Degree Status</b></span>
                  </td>
                  <td><span v-if="cv_degree['degree-status']">{{ cv_degree['degree-status']['code'] }}</span>
                        <span style="color:red" v-else><b>No Degree Status</b></span>
                  </td>
                  <td><span v-if="cv_degree['description']">{{ cv_degree['description'] }}</span>
                        <span style="color:red" v-else><b>No Description</b></span>
                  </td>
                  <td><span v-if="cv_degree['end-date']">{{ cv_degree['end-date']['year'] }}</span>
                        <span style="color:red" v-else><b>No End Date</b></span>
                  </td>                              
                  <td><span v-if="cv_degree['privacy-level']">{{ cv_degree['privacy-level'] }}</span>
                        <span style="color:red" v-else><b>No Privacy Level</b></span>
                  </td>
                  <td><span v-if="cv_degree['research-classifications']">{{ cv_degree['research-classifications'] }}</span>
                        <span style="color:red" v-else><b>No Research Classifications</b></span>
                  </td>
                  <td><span v-if="cv_degree['source-name']">{{ cv_degree['source-name'] }}</span>
                        <span style="color:red" v-else><b>No Source Name</b></span>
                  </td>
                  <td><span v-if="cv_degree['start-date']">{{ cv_degree['start-date']['year'] }}</span>
                        <span style="color:red" v-else><b>No Start Date</b></span>
                  </td>
                  <td><span v-if="cv_degree['thesis']">{{ cv_degree['thesis'] }}</span>
                        <span style="color:red" v-else><b>No Thesis</b></span>
                  </td>
                  <td><span v-if="cv_degree['last-modified-date']">{{ cv_degree['last-modified-date'] }}</span>
                        <span style="color:red" v-else><b>No Last Modified Date</b></span>
                  </td>
                  <!--
                    <td>{{ cv_degree.degree_code }}</td>
                    <td>{{ cv_degree.degree_name }}</td>
                    
                    <td>{{ cv_degree.degree_status }}</td>
                    <td>{{ cv_degree.degree_end_date }}</td>
                    <td>{{ cv_degree.updated_at }}</td>
                    -->
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

<script type="text/javascript">
// Component code (not registered)

export default {
  data: function() {
    return {
      cv_degrees: [],
      data_to_csv: [],
      text_to_copy: ''
    };
  },
  methods: {

        formatRow(degree_end_date, deegree_type_value, degree_name, institution_name, institution_city, institution_country) {
            return degree_end_date + ": " + degree_name + " (" + deegree_type_value + ") - " + institution_name + ", " + institution_city + ", " + institution_country;
        },

        formatAllRows() {
            let aux = [];

            for (let cv_degree of this.cv_degrees) {
                aux = aux +
                    this.formatRow(
                        cv_degree['end-date']['year'],
                        cv_degree['degree-type']['value'],
                        cv_degree['degree-name'],
                        cv_degree['institutions']['institution'][0]['institution-name'],
                        cv_degree['institutions']['institution'][0]['institution-address']['city'],
                        cv_degree['institutions']['institution'][0]['institution-address']['country']['value']
                    ) + "\n";
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

    getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Degrees')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },

    loadDegrees() {
      //axios.get('api/cv_degrees/getAll')
      axios
        .get("api/cv_degrees/getRemoteCienciaVitaeDegrees")
        .then(response => {
          this.cv_degrees = response.data['degree'];
        });
    },
    saveCienciaVitaeToLocalDataBase() {

      for (let cv_degree of this.cv_degrees) {
      
      axios({

          method: 'post',
          url: 'api/cv_save_degrees/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null, 

          'degree_id': 
          (cv_degree['id']) ? 
          cv_degree['id']: "Not defined.",

          'degree_type_value': 
          (cv_degree['degree-type'] 
          && cv_degree['degree-type']['value']) ?
          cv_degree['degree-type']['value']: "Not defined.",

          'degree_type_code': 
          (cv_degree['degree-type'] 
          && cv_degree['degree-type']['code']) ?
          cv_degree['degree-type']['code']: "Not defined.",

          'degree_code_value': 
          (cv_degree['degree-code'] 
          && cv_degree['degree-code']['value']) ?
          cv_degree['degree-code']['value']: "Not defined.",

          'degree_code_speciality_code': 
          (cv_degree['degree-code'] 
          && cv_degree['degree-code']['speciality-code']) ?
          cv_degree['degree-code']['speciality-code']: "Not defined.",

          'degree_name': 
          (cv_degree['degree-name']) ? 
          cv_degree['degree-name']: "Not defined.",

          'institution_name':
          (cv_degree['institutions'] 
          && cv_degree['institutions']['institution'] 
          && cv_degree['institutions']['institution'][0]['institution-name']) ? 
          cv_degree['institutions']['institution'][0]['institution-name']: "Not defined.",

          'institution_city': 
          (cv_degree['institutions'] 
          && cv_degree['institutions']['institution']
          && cv_degree['institutions']['institution'][0]['institution-address'] 
          && cv_degree['institutions']['institution'][0]['institution-address']['city']) ?
          cv_degree['institutions']['institution'][0]['institution-address']['city']: "Not defined.",


          'institution_country': 
          (cv_degree['institutions'] 
          && cv_degree['institutions']['institution']
          && cv_degree['institutions']['institution'][0]['institution-address'] 
          && cv_degree['institutions']['institution'][0]['institution-address']['country']
          && cv_degree['institutions']['institution'][0]['institution-address']['country']['value']) ?
          cv_degree['institutions']['institution'][0]['institution-address']['country']['value']: "Not defined.",

          'degree_major': 
          (cv_degree['degree-major']) ? 
          cv_degree['degree-major']: "Not defined.",

          'degree_status_value': 
          (cv_degree['degree-status']
          && cv_degree['degree-status']['value']) ?
          cv_degree['degree-status']['value']:  "Not defined.",

          'degree_status_code': 
          (cv_degree['degree-status']
          && cv_degree['degree-status']['code']) ?
          cv_degree['degree-status']['code']:  "Not defined.",
          
          'description': 
          (cv_degree['description']) ? 
          cv_degree['description']: "Not defined.",

          'degree_end_date': 
          (cv_degree['end-date']
          && cv_degree['end-date']['year']) ?
          cv_degree['end-date']['year']:  "Not defined.",
                
          'privacy_level': 
          (cv_degree['privacy-level']) ? 
          cv_degree['privacy-level']: "Not defined.",
          
          'research_classifications': 
          (cv_degree['research-classifications']) ? 
          cv_degree['research-classifications']: "Not defined.",

          'source_name': 
          (cv_degree['source-name']) ? 
          cv_degree['source-name']: "Not defined.",

          'start_date': 
          (cv_degree['start-date'] 
          && cv_degree['start-date']['year']) ? 
          cv_degree['start-date']['year']: "Not defined.",

          'thesis': 
          (cv_degree['thesis']) ? 
          cv_degree['thesis']: "Not defined.",

          'last_modified_date': 
          (cv_degree['last-modified-date']) ? 
          cv_degree['last-modified-date']: "Not defined.",

          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Degrees Updated!',
                showConfirmButton: true,
                }
                )
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
    this.loadDegrees();
    this.getLocalDataToCSV();
    Fire.$on("refresh", () => {
      this.loadDegrees();
      this.getLocalDataToCSV();
    });
  }
};
</script>

<style scoped>
tr.activerow {
  background: #123456 !important;
  color: #fff !important;
}
</style>