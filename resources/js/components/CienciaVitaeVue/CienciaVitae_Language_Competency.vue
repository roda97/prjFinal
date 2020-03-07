<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ciencia Vitae Language Competency</h3>
            <!--
                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
                -->
            <div class="card-tools">
                                <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Languages.csv">

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
                  <th>Code</th>
                  <th>Language</th>
                  <th>Mother Tongue?</th>
                  <th>Read</th>
                  <th>Read Code</th>
                  <th>Write</th>
                  <th>Write Code</th>
                  <th>Speak</th>
                  <th>Speak Code</th>
                  <th>Understand</th>
                  <th>Understand Code</th>
                  <th>Is Public?</th>
                  <th>Peer Review</th>

                </tr>
                <tr v-for="cv_language_competency in cv_language_competencies" :key="cv_language_competency.degree_name">
                  <td><span v-if="cv_language_competency['language']['code']">{{ cv_language_competency['language']['code'] }}</span>
                        <span style="color:red" v-else><b>No Language Code</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['language']['value']">{{ cv_language_competency['language']['value'] }}</span>
                        <span style="color:red" v-else><b>No Language Value</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['mother-tongue']" style="color:green"><b>Yes</b></span>
                        <span style="color:red" v-else><b>No</b></span>
                  </td>          
                  <td><span v-if="cv_language_competency['read']['value'] ">{{ cv_language_competency['read']['value'] }}</span>
                        <span style="color:red" v-else><b>No Read Value</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['read']['code'] ">{{ cv_language_competency['read']['code'] }}</span>
                        <span style="color:red" v-else><b>No Read Code</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['write']['value'] ">{{ cv_language_competency['write']['value'] }}</span>
                        <span style="color:red" v-else><b>No Write Value</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['write']['code'] ">{{ cv_language_competency['write']['code'] }}</span>
                        <span style="color:red" v-else><b>No Write Code</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['speak']['value'] ">{{ cv_language_competency['speak']['value'] }}</span>
                        <span style="color:red" v-else><b>No Speak Value</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['speak']['code'] ">{{ cv_language_competency['speak']['code'] }}</span>
                        <span style="color:red" v-else><b>No Speak Code</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['understand-spoken']['value']">{{ cv_language_competency['understand-spoken']['value'] }}</span>
                        <span style="color:red" v-else><b>No Understand Spoken Value</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['understand-spoken']['code']">{{ cv_language_competency['understand-spoken']['code'] }}</span>
                        <span style="color:red" v-else><b>No Understand Spoken Code</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['privacy-level']">{{ cv_language_competency['privacy-level'] }}</span>
                        <span style="color:red" v-else><b>No Privacy Level</b></span>
                  </td>
                  <td><span v-if="cv_language_competency['peer-review']">{{ cv_language_competency['peer-review'] }}</span>
                        <span style="color:red" v-else><b>No Peer Review</b></span>
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

<script type="text/javascript">
// Component code (not registered)

export default {
  data: function() {
    return {
      cv_language_competencies: [],
      data_to_csv: []
    };
  },
  methods: {
    getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_LanguageCompetency')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },
    loadLanguages() {
      axios
        .get("api/CienciaVitae/getRemoteCienciaVitaeLanguageCompetency")
        .then(response => {
          this.cv_language_competencies = response.data['language-competency'];
        });
    },

    saveCienciaVitaeToLocalDataBase() {

      for (let cv_language_competency of this.cv_language_competencies) {
      
      axios({

          method: 'post',
          url: 'api/cv_save_language/saveCienciaVitaeToLocalDataBase',
          data: {

        'user_science_id' : null,
        
        'mother_tongue' : 
        (cv_language_competency['mother-tongue']) ? 
        cv_language_competency['mother-tongue']: "Not defined.",
    
        'language_code':
        (cv_language_competency['language'] && cv_language_competency['language']['code']) ? 
        cv_language_competency['language']['code']: "Not defined.",

        'language_value':
        (cv_language_competency['language'] && cv_language_competency['language']['value']) ? 
        cv_language_competency['language']['value']: "Not defined.",

        'read_value':
        (cv_language_competency['read'] && cv_language_competency['read']['value']) ? 
        cv_language_competency['read']['value']: "Not defined.",

        'read_code':
        (cv_language_competency['read'] && cv_language_competency['read']['code']) ? 
        cv_language_competency['read']['code']: "Not defined.",

        'write_value':
        (cv_language_competency['write'] && cv_language_competency['write']['value']) ? 
        cv_language_competency['write']['value']: "Not defined.",

        'write_code':
        (cv_language_competency['write'] && cv_language_competency['write']['code']) ? 
        cv_language_competency['write']['code']: "Not defined.",

        'speak_value':
        (cv_language_competency['speak'] && cv_language_competency['speak']['value']) ? 
        cv_language_competency['speak']['value']: "Not defined.",

        'speak_code':
        (cv_language_competency['speak'] && cv_language_competency['speak']['code']) ? 
        cv_language_competency['speak']['code']: "Not defined.",

        'understand_spoken_value':
        (cv_language_competency['understand-spoken'] && cv_language_competency['understand-spoken']['value']) ? 
        cv_language_competency['understand-spoken']['value']: "Not defined.",

        'understand_spoken_code':
        (cv_language_competency['understand-spoken'] && cv_language_competency['understand-spoken']['code']) ? 
        cv_language_competency['understand-spoken']['code']: "Not defined.",

        'privacy_level':
        (cv_language_competency['privacy-level']) ? 
        cv_language_competency['privacy-level']: "Not defined.",

        'peer_review':
        (cv_language_competency['peer-review']) ? 
        cv_language_competency['peer-review']: "Not defined.",
        
        },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Language Competencies Updated!',
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
    this.loadLanguages();
    this.getLocalDataToCSV();
    Fire.$on("refresh", () => {
      this.loadLanguages();
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