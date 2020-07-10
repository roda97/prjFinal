<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ciencia Vitae Author Identifier</h3>

                <div class="card-tools">

<download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Authors.csv">

	<font color="white">EXPORT CIIC TABLE TO CSV</font>

</download-csv>

                  <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Identifier Type(code)</th>
                    <th>Identifier Type(value)</th>
                    <th>Identifier</th>
                    <th>ID</th>
                    <th>Privacy Level</th>
                    <th>Source Name</th>
                    <th>Last Modified Date</th>
                  </tr>               
                  <tr v-for="cv_author in cv_authors" :key="cv_author.id">
                    <td><span v-if="cv_author['identifier-type']">{{ cv_author['identifier-type']['code'] }}</span>
                        <span style="color:red" v-else><b>No Identifier Type</b></span>
                    </td>
                    <td><span v-if="cv_author['identifier-type']">{{ cv_author['identifier-type']['value'] }}</span>
                        <span style="color:red" v-else><b>No Identifier Type</b></span>
                    </td>
                    <td><span v-if="cv_author['identifier']">{{ cv_author['identifier'] }}</span>
                        <span style="color:red" v-else><b>No Identifier</b></span>
                    </td>
                    <td><span v-if="cv_author['id']">{{ cv_author['id'] }}</span>
                        <span style="color:red" v-else><b>No ID</b></span>
                    </td>
                    <td><span v-if="cv_author['privacy-level']">{{ cv_author['privacy-level'] }}</span>
                        <span style="color:red" v-else><b>No Privacy Level</b></span>
                    </td>
                    <td><span v-if="cv_author['source-name']">{{ cv_author['source-name'] }}</span>
                        <span style="color:red" v-else><b>No Source Name</b></span>
                    </td>
                    <td><span v-if="cv_author['last-modified-date']">{{ cv_author['last-modified-date'] }}</span>
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
        cv_authors:[], 
        data_to_csv:[],
		  }
    },
    methods:{
      getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Author')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },

      loadAuthors(){
          axios.get('api/cv/getRemoteCienciaVitaeAuthor')
  					.then(response=>{
            this.cv_authors = response.data['author-identifier'];
  				});
      },
      saveCienciaVitaeToLocalDataBase() {

      for (let cv_author of this.cv_authors) {

      axios({

          method: 'post',
          url: 'api/cv_save_authors/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'identifier_type_code': 
          (cv_author['identifier-type']
          && cv_author['identifier-type']['code']) ?
          cv_author['identifier-type']['code']: "Not defined.",

          'identifier_type_value': 
          (cv_author['identifier-type']
          && cv_author['identifier-type']['value']) ?
          cv_author['identifier-type']['value']: "Not defined.",

          'identifier': 
          (cv_author['identifier']) ?
          cv_author['identifier']: "Not defined.",

          'id_row_entry': 
          (cv_author['id']) ?
          cv_author['id']: "Not defined.",

          'privacy_level': 
          (cv_author['privacy-level']) ?
          cv_author['privacy-level']: "Not defined.",

          'source_name': 
          (cv_author['source-name']) ?
          cv_author['source-name']: "Not defined.",

          'last_modified_date': 
          (cv_author['last-modified-date']) ?
          cv_author['last-modified-date']: "Not defined.",

          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Authors Updated!',
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