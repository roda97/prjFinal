<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ciencia Vitae Web Addresses</h3>





                <div class="card-tools">
<download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Web.csv">

	<font color="white">EXPORT CIIC TABLE TO CSV</font>

</download-csv>

                  <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Site Type(code)</th>
                    <th>Site Type(value)</th>
                    <th>URL</th>
                    <th>ID</th>
                    <th>Last Modified Date</th>
                  </tr>               
                  <tr v-for="cv_web in cv_webs" :key="cv_web.id">
                    <td><span v-if="cv_web['site-type']">{{ cv_web['site-type']['code'] }}</span>
                        <span style="color:red" v-else><b>No Site Type</b></span>
                    </td>
                    <td><span v-if="cv_web['site-type']">{{ cv_web['site-type']['value'] }}</span>
                        <span style="color:red" v-else><b>No Site Type</b></span>
                    </td>
                    <td><span v-if="cv_web['url']">{{ cv_web['url'] }}</span>
                        <span style="color:red" v-else><b>No URL</b></span>
                    </td>
                    <td><span v-if="cv_web['id']">{{ cv_web['id'] }}</span>
                        <span style="color:red" v-else><b>No ID</b></span>
                    </td>
                    <td><span v-if="cv_web['last-modified-date']">{{ cv_web['last-modified-date'] }}</span>
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
        cv_webs:[],
        data_to_csv:[], 
		  }
    },
    methods:{
      getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Web')
  					.then(response=>{
            this.data_to_csv = response.data.data;      
            })
      },
      loadWeb(){
          axios.get('api/cv/getRemoteCienciaVitaeWeb')
  					.then(response=>{
            this.cv_webs = response.data['web-address'];
  				});
      },
      saveCienciaVitaeToLocalDataBase() {

      for (let cv_web of this.cv_webs) {
      
      axios({

          method: 'post',
          url: 'api/cv_save_webs/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'site_type_code': 
          (cv_web['site-type']
          && cv_web['site-type']['code']) ?
          cv_web['site-type']['code']: "Not defined." ,

          'site_type_value': 
          (cv_web['site-type']
          && cv_web['site-type']['value']) ?
          cv_web['site-type']['value']: "Not defined." ,

          'url': 
          (cv_web['url']) ?
          cv_web['url']: "Not defined." ,

          'id_row_entry': 
          (cv_web['id']) ?
          cv_web['id']: "Not defined." ,

          'last_modified_date': 
          (cv_web['last-modified-date']) ?
          cv_web['last-modified-date']: "Not defined." ,
          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Webs Updated!',
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
          this.loadWeb();
          this.getLocalDataToCSV();
          Fire.$on('refresh',()=>{
            this.loadWeb();
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