<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ciencia Vitae Mailing Addresses</h3>
            <!--
                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
                -->
            <div class="card-tools">
                                <download-csv
	class   = "btn btn-dark"
	:data   = "data_to_csv"
	name    = "CIIC_DB_Addresses.csv">

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
                  <th>Type</th>
                  <th>Type Code</th>
                  <th>Street Address</th>
                  <th>Postal Code</th>
                  <th>City</th>
                  <th>Province State</th>
                  <th>Country</th>
                  <th>Country Code</th>
                  <th>Last Modified Date</th>
                  <th>Main address?</th>
                  <th>Privacy Level</th>
                </tr>
                <tr v-for="cv_mailing in cv_mailings" :key="cv_mailing.id">
                  <td><span v-if="cv_mailing['address-type']">{{ cv_mailing['address-type']['value'] }}</span>
                        <span style="color:red" v-else><b>No Address Type</b></span>
                  </td>
                  <td><span v-if="cv_mailing['address-type']">{{ cv_mailing['address-type']['code'] }}</span>
                        <span style="color:red" v-else><b>No Address Type</b></span>
                  </td>
                  <td><span v-if="cv_mailing['street-address']">{{ cv_mailing['street-address'] }}</span>
                        <span style="color:red" v-else><b>No Street Address</b></span>
                  </td>
                  <td><span v-if="cv_mailing['postal-code']">{{ cv_mailing['postal-code'] }}</span>
                        <span style="color:red" v-else><b>No Postal Code</b></span>
                  </td>
                  <td><span v-if="cv_mailing['city']">{{ cv_mailing['city'] }}</span>
                        <span style="color:red" v-else><b>No City</b></span>
                  </td>
                  <td><span v-if="cv_mailing['province-state']">{{ cv_mailing['province-state'] }}</span>
                        <span style="color:red" v-else><b>No Province State</b></span>
                  </td>
                  <td><span v-if="cv_mailing['country']">{{ cv_mailing['country']['value'] }}</span>
                        <span style="color:red" v-else><b>No Country</b></span>
                  </td>
                  <td><span v-if="cv_mailing['country']">{{ cv_mailing['country']['code'] }}</span>
                        <span style="color:red" v-else><b>No Country</b></span>
                  </td>
                  <td><span v-if="cv_mailing['last-modified-date']">{{ cv_mailing['last-modified-date'] }}</span>
                        <span style="color:red" v-else><b>No Last Modified Date</b></span>
                  </td>
                  <td><span v-if="cv_mailing['preferred-mailing-address']" style="color:green"><b>Yes</b></span>
                        <span style="color:red" v-else><b>No</b></span>
                  </td>
                  <td><span v-if="cv_mailing['privacy-level']">{{ cv_mailing['privacy-level'] }}</span>
                        <span style="color:red" v-else><b>No Privacy Level</b></span>
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
      cv_mailings: [],
      data_to_csv: []
    };
  },
  methods: {
    getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_MailingAddresses')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },
    loadMailing() {
      axios
        .get("api/cv_mailings/getRemoteCienciaVitaeMailingAddresses")
        .then(response => {
          this.cv_mailings = response.data["mailing-address"];
        });
    },
    saveCienciaVitaeToLocalDataBase() {

      for (let cv_mailing of this.cv_mailings) {
      
      axios({

          method: 'post',
          url: 'api/cv_save_mailings/saveCienciaVitaeToLocalDataBase',
          data: {

          'user_science_id': null,

          'address_type_value': 
          (cv_mailing['address-type']
          && cv_mailing['address-type']['value'])?
          cv_mailing['address-type']['value']: "Not defined.",

          'address_type_code': 
          (cv_mailing['address-type']
          && cv_mailing['address-type']['code'])?
          cv_mailing['address-type']['code']: "Not defined.",

          'street_address': 
          (cv_mailing['street-address'])?
          cv_mailing['street-address']: "Not defined.",

          'postal_code': 
          (cv_mailing['postal-code'])?
          cv_mailing['postal-code']: "Not defined.",

          'city': 
          (cv_mailing['city'])?
          cv_mailing['city']: "Not defined.",

          'province_state': 
          (cv_mailing['province-state'])?
          cv_mailing['province-state']: "Not defined.",

          'country_value': 
          (cv_mailing['country']
          && cv_mailing['country']['value'])?
          cv_mailing['country']['value']: "Not defined.",

          'preferred_mailing_address': 
          (cv_mailing['preferred-mailing-address'])?
          cv_mailing['preferred-mailing-address']: "Not defined.",

          'last_modified_date': 
          (cv_mailing['last-modified-date'])?
          cv_mailing['last-modified-date']: "Not defined.",

          'privacy_level': 
          (cv_mailing['privacy-level'])?
          cv_mailing['privacy-level']: "Not defined.",
          },

        }).then(function (response) {
          Swal.fire({
                type: 'success',
                title: 'Local Mailings Updated!',
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
    this.loadMailing();
    this.getLocalDataToCSV();
    Fire.$on("refresh", () => {
      this.loadMailing();
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