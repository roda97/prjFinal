<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ciencia Vitae Groups</h3>

                <div class="card-tools">
                                    <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Groups.csv">

	<font color="white">EXPORT CIIC TABLE TO CSV</font>

</download-csv>
                  <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Funding Outputs</th>
                    <th>Employment Services</th>
                  </tr>               
                  <tr>
                    <td><span v-if="cv_groups['fundings-outputs']">{{ cv_groups['fundings-outputs'] }}</span>
                        <span style="color:red" v-else><b>No Funding Outputs</b></span>
                    </td>
                    <td><span v-if="cv_groups['employments-services']">{{ cv_groups['employments-services'] }}</span>
                        <span style="color:red" v-else><b>No Employments Services</b></span>
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
        cv_groups:[], 
      data_to_csv: []
		  }
    },
    methods:{
      getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Groups')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },
      loadGroups(){
          axios.get('api/cv/getRemoteCienciaVitaeGroups')
  					.then(response=>{
            this.cv_groups = response.data;
  				});
      },
      saveCienciaVitaeToLocalDataBase() {

      axios({

          method: 'post',
          url: 'api/cv_save_groups/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'fundings_outputs': 
          (this.cv_groups['fundings-outputs']) ?
          this.cv_groups['fundings-outputs']: "Not defined." ,

          'employments_services': 
          (this.cv_groups['employments-services']) ?
          this.cv_groups['employments-services']: "Not defined." ,

          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Groups Updated!',
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
      },       
    },
        created(){
          this.loadGroups();
          this.getLocalDataToCSV();
          Fire.$on('refresh',()=>{
            this.loadGroups();
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