<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ciencia Vitae Citation Names</h3>

                <div class="card-tools">

                  <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Citations.csv">

	<font color="white">EXPORT CIIC TABLE TO CSV</font>

</download-csv>
                  <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Value</th>
                    <th>ID</th>
                    <th>Privacy Level</th>
                    <th>Source Name</th>
                    <th>Last Modified Date</th>
                    <th>Preferred Citation Name?</th>
                  </tr>               
                  <tr v-for="cv_citation in cv_citations" :key="cv_citation.id">
                    <td><span v-if="cv_citation['value']">{{ cv_citation['value'] }}</span>
                        <span style="color:red" v-else><b>No Value</b></span>
                    </td>
                    <td><span v-if="cv_citation['id']">{{ cv_citation['id'] }}</span>
                        <span style="color:red" v-else><b>No ID</b></span>
                    </td>
                    <td><span v-if="cv_citation['privacy-level']">{{ cv_citation['privacy-level'] }}</span>
                        <span style="color:red" v-else><b>No Privacy Level</b></span>
                    </td>
                    <td><span v-if="cv_citation['source-name']">{{ cv_citation['source-name'] }}</span>
                        <span style="color:red" v-else><b>No Source Name</b></span>
                    </td>
                    <td><span v-if="cv_citation['last-modified-date']">{{ cv_citation['last-modified-date'] }}</span>
                        <span style="color:red" v-else><b>No Last Modified Date</b></span>
                    </td>
                    <td><span v-if="cv_citation['preferred-citation-name']" style="color:green"><b>Yes</b></span>
                        <span style="color:red" v-else><b>No</b></span>
                  </td>
                                   
                    <td>
                        <!--
                        <a href="#" @click="deleteResearcher(researcher.project_researchers_id)">
                            <i class ="fa fa-trash red"></i>
                        </a>
                        -->
                    </td>
                  </tr>
                </tbody></table>
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

	export default{
		data: function () {
		return {
        cv_citations:[], 
        data_to_csv:[]
		  }
    },
    methods:{
      getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Citation')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },

      loadAuthors(){
          axios.get('api/cv/getRemoteCienciaVitaeCitation')
  					.then(response=>{
            this.cv_citations = response.data['citation-name'];
  				});
      },
      saveCienciaVitaeToLocalDataBase() {

      for (let cv_citation of this.cv_citations) {

      axios({

          method: 'post',
          url: 'api/cv_save_citations/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'value': 
          (cv_citation['value']) ? 
          cv_citation['value']: "Not defined",

          'id_row_entry': 
          (cv_citation['id']) ? 
          cv_citation['id']: "Not defined",

          'privacy_level': 
          (cv_citation['privacy-level']) ? 
          cv_citation['privacy-level']: "Not defined",

          'source_name': 
          (cv_citation['source-name']) ? 
          cv_citation['source-name']: "Not defined",

          'last_modified_date': 
          (cv_citation['last-modified-date']) ? 
          cv_citation['last-modified-date']: "Not defined",

          'preferred_citation_name': 
          (cv_citation['preferred-citation-name']) ? 
          cv_citation['preferred-citation-name']: "Not defined",

          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Citations Updated!',
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
        created(){
          this.loadAuthors();
          this.getLocalDataToCSV();
          Fire.$on('refresh',()=>{
            this.loadAuthors();
            this.getLocalDataToCSV();
          })
        },  
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}

</style>