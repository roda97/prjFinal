<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ciencia Vitae Access Privileges</h3>

               <div class="card-tools">
                                   <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Privileges.csv">

	<font color="white">EXPORT CIIC TABLE TO CSV</font>

</download-csv>
                  <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Name</th>
                    <th>Privacy Level(code)</th>
                    <th>Privacy Level(value)</th>
                    <th>Role(code)</th>
                    <th>Role(value)</th>
                    <th>URL</th>
                    <th>Science ID</th>
                    <th>Effective Privacy Level(code)</th>
                    <th>Effective Privacy Level(value)</th>
                    <th>Effective Role(code)</th>
                    <th>Effective Role(value)</th>
                  </tr>                
                  <tr>
                    <td><span v-if="cv_privileges['api-user']">{{ cv_privileges['api-user']['name'] }}</span>
                        <span style="color:red" v-else><b>No Name</b></span>
                    </td>
                    <td><span v-if="cv_privileges['api-user']">{{ cv_privileges['api-user']['privacy-level']['code'] }}</span>
                        <span style="color:red" v-else><b>No Privileges</b></span>
                    </td>
                    <td><span v-if="cv_privileges['api-user']">{{ cv_privileges['api-user']['privacy-level']['value'] }}</span>
                        <span style="color:red" v-else><b>No Privileges</b></span>
                    </td>
                    <td><span v-if="cv_privileges['api-user']">{{ cv_privileges['api-user']['role']['code'] }}</span>
                        <span style="color:red" v-else><b>No Roles</b></span>
                    </td>
                    <td><span v-if="cv_privileges['api-user']">{{ cv_privileges['api-user']['role']['value'] }}</span>
                        <span style="color:red" v-else><b>No Roles</b></span>
                    </td>
                    <td><span v-if="cv_privileges['api-user']">{{ cv_privileges['api-user']['url'] }}</span>
                        <span style="color:red" v-else><b>No URL</b></span>
                    </td>
                    <td><span v-if="cv_privileges['privilege']">{{ cv_privileges['privilege']['ciencia-id'] }}</span>
                        <span style="color:red" v-else><b>No Science ID</b></span>
                    </td>
                    <td><span v-if="cv_privileges['privilege']">{{ cv_privileges['privilege']['effective-privacy-level']['code'] }}</span>
                        <span style="color:red" v-else><b>No Effective Privileges</b></span>
                    </td>
                    <td><span v-if="cv_privileges['privilege']">{{ cv_privileges['privilege']['effective-privacy-level']['value'] }}</span>
                        <span style="color:red" v-else><b>No Effective Privileges</b></span>
                    </td>
                    <td><span v-if="cv_privileges['privilege']">{{ cv_privileges['privilege']['effective-role']['code'] }}</span>
                        <span style="color:red" v-else><b>No Effective Roles</b></span>
                    </td>
                    <td><span v-if="cv_privileges['privilege']">{{ cv_privileges['privilege']['effective-role']['value'] }}</span>
                        <span style="color:red" v-else><b>No Effective Roles</b></span>
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
        cv_privileges:[], 
        data_to_csv: []
		  }
    },
    methods:{
      getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Privileges')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },
      loadPrivileges(){
          axios.get('api/cv/getRemoteCienciaVitaePrivileges')
  					.then(response=>{
            this.cv_privileges = response.data;
  				});
      },
      saveCienciaVitaeToLocalDataBase() {

      axios({

          method: 'post',
          url: 'api/cv_save_privileges/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'api_user_name': 
          (this.cv_privileges['api-user']
          && this.cv_privileges['api-user']['name']) ?
          this.cv_privileges['api-user']['name']: "Not defined",

          'api_user_privacy_level_code': 
          (this.cv_privileges['api-user']
          && this.cv_privileges['api-user']['privacy-level']
          && this.cv_privileges['api-user']['privacy-level']['code']) ?
          this.cv_privileges['api-user']['privacy-level']['code']: "Not defined",

          'api_user_privacy_level_value': 
          (this.cv_privileges['api-user']
          && this.cv_privileges['api-user']['privacy-level']
          && this.cv_privileges['api-user']['privacy-level']['value']) ?
          this.cv_privileges['api-user']['privacy-level']['value']: "Not defined",

          'api_user_role_code': 
          (this.cv_privileges['api-user']
          && this.cv_privileges['api-user']['role']
          && this.cv_privileges['api-user']['role']['code']) ?
          this.cv_privileges['api-user']['role']['code']: "Not defined",

          'api_user_role_value': 
          (this.cv_privileges['api-user']
          && this.cv_privileges['api-user']['role']
          && this.cv_privileges['api-user']['role']['value']) ?
          this.cv_privileges['api-user']['role']['value']: "Not defined",

          'api_user_url': 
          (this.cv_privileges['api-user']
          && this.cv_privileges['api-user']['url']) ?
          this.cv_privileges['api-user']['url']: "Not defined",

          'privilege_ciencia_id': 
          (this.cv_privileges['privilege']
          && this.cv_privileges['privilege']['ciencia-id']) ?
          this.cv_privileges['privilege']['ciencia-id']: "Not defined",

          'privilege_effective_privacy_level_code': 
          (this.cv_privileges['privilege']['effective-privacy-level']
          && this.cv_privileges['privilege']['effective-privacy-level']['code']) ?
          this.cv_privileges['privilege']['effective-privacy-level']['code']: "Not defined",

          'privilege_effective_privacy_level_value': 
          (this.cv_privileges['privilege']['effective-privacy-level']
          && this.cv_privileges['privilege']['effective-privacy-level']['value']) ?
          this.cv_privileges['privilege']['effective-privacy-level']['value']: "Not defined",

          'privilege_effective_role_code': 
          (this.cv_privileges['privilege']['effective-role']
          && this.cv_privileges['privilege']['effective-role']['code']) ?
          this.cv_privileges['privilege']['effective-role']['code']: "Not defined",

          'privilege_effective_role_value': 
          (this.cv_privileges['privilege']['effective-role']
          && this.cv_privileges['privilege']['effective-role']['value']) ?
          this.cv_privileges['privilege']['effective-role']['value']: "Not defined",

          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Privileges Updated!',
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
          this.loadPrivileges();
          this.getLocalDataToCSV();
          Fire.$on('refresh',()=>{
            this.loadPrivileges();
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