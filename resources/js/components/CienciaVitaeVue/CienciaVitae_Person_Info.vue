<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ciencia Vitae Person Info</h3>
            <!--
                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
                -->
            <div class="card-tools">
              <download-csv
                class   = "btn btn-dark"
                :data   = "data_to_csv"
                name    = "CIIC_DB_Person_Info.csv">

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
                  <th>Full Name</th>
                  <th>Names</th>
                  <th>Surnames</th>
                  <th>Presented Name</th>
                  <th>Date of Birth</th>
                  <th>Gender</th>
                </tr>
                <tr>
                  <td><span v-if="cv_person_info['full-name']">{{ cv_person_info['full-name'] }}</span>
                        <span style="color:red" v-else><b>No Full Name</b></span>
                  </td>
                  <td><span v-if="cv_person_info['names']">{{ cv_person_info['names'] }}</span>
                        <span style="color:red" v-else><b>No Names</b></span>
                  </td>
                  <td><span v-if="cv_person_info['surnames']">{{ cv_person_info['surnames'] }}</span>
                        <span style="color:red" v-else><b>No Surnames</b></span>
                  </td>
                  <td><span v-if="cv_person_info['presented-name']">{{ cv_person_info['presented-name'] }}</span>
                    <span style="color:red" v-else><b>No Presented Name</b></span>
                  </td>
                  <td><span v-if="cv_person_info['date-of-birth']">{{ cv_person_info['date-of-birth']['year'] }}
                      /
                      {{ cv_person_info['date-of-birth']['month'] }}
                      /
                      {{ cv_person_info['date-of-birth']['day'] }}
                    </span>
                    <span
                      style="color:red"
                      v-else
                    ><b>No Date of Birth</b></span>
                  </td>
                  <!-- verificação do 
                  "Cannot read property 'value' of undefined" -->
                  <td><span v-if="cv_person_info.gender && cv_person_info.gender.value">{{ cv_person_info['gender']['value'] }}</span>
                    <span
                      style="color:red"
                      v-else
                    ><b>No Gender</b></span>
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
      cv_person_info: [],
      data_to_csv: []
    };
  },
  methods: {
    getLocalDataToCSV(){
          axios.get('api/cv/getLocalCienciaVitae_PersonInfo')
  					.then(response=>{
            this.data_to_csv = response.data.data;
  				});
      },
    loadPersonInfo() {
      axios
        .get("api/CienciaVitae/getRemoteCienciaVitaePersonInfo")
        .then(response => {
          this.cv_person_info = response.data;
        });
    },
  saveCienciaVitaeToLocalDataBase() {

    axios({

        method: 'post',
        url: 'api/cv_save_person/saveCienciaVitaeToLocalDataBase',
        data: {
          
        'user_science_id': null,
        'full_name':
        (this.cv_person_info['full-name']) ? 
        this.cv_person_info['full-name']: "Not defined.",

        'names':
        (this.cv_person_info['names']) ? 
        this.cv_person_info['names']: "Not defined.",

        'surnames':
        (this.cv_person_info['surnames']) ? 
        this.cv_person_info['surnames']: "Not defined.",

        'presented_name':
        (this.cv_person_info['presented-name']) ? 
        this.cv_person_info['presented-name']: "Not defined.",

        'date_of_birth_year':
        (this.cv_person_info['date-of-birth']
        && this.cv_person_info['date-of-birth']['year']) ? 
        this.cv_person_info['date-of-birth']['year']: "Not defined.",

        'date_of_birth_month':
        (this.cv_person_info['date-of-birth']
        && this.cv_person_info['date-of-birth']['month']) ? 
        this.cv_person_info['date-of-birth']['month']: "Not defined.",

        'date_of_birth_day':
        (this.cv_person_info['date-of-birth']
        && this.cv_person_info['date-of-birth']['day']) ? 
        this.cv_person_info['date-of-birth']['day']: "Not defined.",

        'gender_value':
        (this.cv_person_info['gender']
        && this.cv_person_info['gender']['value']) ? 
        this.cv_person_info['gender']['value']: "Not defined.",
        },

      }).then(function (response) {
        Swal.fire({
              type: 'success',
              title: 'Local Person Info Updated!',
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
  created() {
    this.loadPersonInfo();
    this.getLocalDataToCSV();
    Fire.$on("refresh", () => {
      this.loadPersonInfo();
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