<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ciencia Vitae Phones</h3>
<!--
                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
                -->
                <div class="card-tools">
                                    <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Phones.csv">

	<font color="white">EXPORT CIIC TABLE TO CSV</font>

</download-csv>
                  <button class="btn btn-success" @click="saveCienciaVitaeToLocalDataBase()">UPDATE TO CIIC DATABASE</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Usage Type(code)</th>
                    <th>Usage Type(value)</th>
                    <th>Phone Type(code)</th>
                    <th>Phone Type(value)</th>
                    <th>Country Code</th>
                    <th>Local Number</th>
                    <th>ID</th>
                    <th>Preferred Phone Number?</th>
                    <th>Last Modified Date</th>
                  </tr>               
                  <tr v-for="cv_phone in cv_phones" :key="cv_phone.id">
                    <td><span v-if="cv_phone['usage-type']">{{ cv_phone['usage-type']['code'] }}</span>
                        <span style="color:red" v-else><b>No Usage Type</b></span>
                    </td>
                    <td><span v-if="cv_phone['usage-type']">{{ cv_phone['usage-type']['value'] }}</span>
                        <span style="color:red" v-else><b>No Usage Type</b></span>
                    </td>
                    <td><span v-if="cv_phone['phone-type']">{{ cv_phone['phone-type']['code'] }}</span>
                        <span style="color:red" v-else><b>No Phone Type</b></span>
                    </td>
                    <td><span v-if="cv_phone['phone-type']">{{ cv_phone['phone-type']['value'] }}</span>
                        <span style="color:red" v-else><b>No Phone Type</b></span>
                    </td>
                    <td><span v-if="cv_phone['country-code']">{{ cv_phone['country-code'] }}</span>
                        <span style="color:red" v-else><b>No Country Code</b></span>
                    </td>
                    <td><span v-if="cv_phone['local-number']">{{ cv_phone['local-number'] }}</span>
                        <span style="color:red" v-else><b>No Local Number</b></span>
                    </td>
                    <td><span v-if="cv_phone['id']">{{ cv_phone['id'] }}</span>
                        <span style="color:red" v-else><b>No ID</b></span>
                    </td>
                    <td><span v-if="cv_phone['preferred-phone-number']" style="color:green"><b>Yes</b></span>
                        <span style="color:red" v-else><b>No</b></span>
                    </td>
                    <td><span v-if="cv_phone['last-modified-date']">{{ cv_phone['last-modified-date'] }}</span>
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
        cv_phones:[], 
        data_to_csv: []
		  }
    },
    methods:{
      getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_Phones')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },
      loadPhones(){
          axios.get('api/cv_phones/getRemoteCienciaVitaePhones')
  					.then(response=>{
            this.cv_phones = response.data['phone-number'];
  				});
      },
      saveCienciaVitaeToLocalDataBase() {

      for (let cv_phone of this.cv_phones) {
      
      axios({

          method: 'post',
          url: 'api/cv_save_phones/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'usage_type_code': 
          (cv_phone['usage-type']
          && cv_phone['usage-type']['code']) ?
          cv_phone['usage-type']['code'] : "Not defined" ,

          'usage_type_value': 
          (cv_phone['usage-type']
          && cv_phone['usage-type']['value']) ?
          cv_phone['usage-type']['value'] : "Not defined" ,

          'phone_type_code': 
          (cv_phone['phone-type']
          && cv_phone['phone-type']['code']) ?
          cv_phone['phone-type']['code'] : "Not defined" ,

          'phone_type_value': 
          (cv_phone['phone-type']
          && cv_phone['phone-type']['value']) ?
          cv_phone['phone-type']['value'] : "Not defined" ,

          'country_code': 
          (cv_phone['country-code']) ?
          cv_phone['country-code'] : "Not defined" ,

          'local_number': 
          (cv_phone['local-number']) ?
          cv_phone['local-number'] : "Not defined" ,

          'id_row_entry': 
          (cv_phone['id']) ?
          cv_phone['id'] : "Not defined" ,

          'preferred_phone_number': 
          (cv_phone['preferred-phone-number']) ?
          cv_phone['preferred-phone-number'] : "Not defined" ,

          'last_modified_date': 
          (cv_phone['last-modified-date']) ?
          cv_phone['last-modified-date'] : "Not defined" ,
          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Phones Updated!',
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
          this.loadPhones();
          this.getLocalDataToCSV();
          Fire.$on('refresh',()=>{
            this.loadPhones();
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