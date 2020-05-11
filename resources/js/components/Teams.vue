<template>
    <div id="table" class="container" >
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Teams Table</h3>

                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Keywords</th>
                    <th>Scientific Domains</th>
                    <th>Application Domains</th>
                  </tr>               
                  <tr v-for="team in teams" :key="team.id">
                    <td>{{ team.id }}</td>
                    <td>{{ team.title }}</td>
                    <td>{{ team.keywords }}</td>
                    <td>{{ team.scientific_domains }}</td>
                    <td>{{ team.application_domains }}</td>
                    <td>
                          <toggle-button @change="alterToActive(team)" :value=!!+team.isActive :color="{checked: '#00FF00', 
                            unchecked: '#FF0000'}" :labels="{checked: 'ON', unchecked: 'OFF'}" />
                    </td>
                    <td>
                        <a href="#" @click="editModal(team)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteTeam(team.id)">
                            <i class ="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Team</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="editmode ? edit() : create()" >
      <div class="modal-body">
        <div class="form-group">
	        <input type="text" name="title" v-model="form.title" placeholder="Title"
           class="form-control" :class="{'is-invalid': form.errors.has('title')}"> 
          <has-error :form="form" field="title"></has-error>
	    </div>
        <div class="form-group">
	        <textarea type="text" name="keywords" v-model="form.keywords" placeholder="Keywords"
          class="form-control" :class="{'is-invalid': form.errors.has('keywords')}"/> 
          <has-error :form="form" field="keywords"></has-error>
	    </div>
        <div class="form-group">
	        <textarea type="text" name="scientific_domains" v-model="form.scientific_domains" placeholder="Scientific Domains"
          class="form-control" :class="{'is-invalid': form.errors.has('scientific_domains')}"/> 
          <has-error :form="form" field="scientific_domains"></has-error>
	    </div>
        <div class="form-group">
	        <textarea type="text" name="application_domains" v-model="form.application_domains" placeholder="Application Domains"
          class="form-control" :class="{'is-invalid': form.errors.has('application_domains')}"/> 
          <has-error :form="form" field="application_domains"></has-error>
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
        <button v-show="editmode" type="submit" class="btn btn-success">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>
 </div>
    
</template>

<script>
  // Component code (not registered)

	export default{
		data: function () {
			return {
            editmode: false,
            teams: [],
            form : new Form({
            id: '',
            title: '',
            keywords:'',
            scientific_domains:'',
            application_domains:''
            }),
            showMessage: false,
            successMessage: '',
		}
    },
    methods:{
       alterToActive(team) {
            axios.put("api/teams/alterToActive/" + team.id)
                .then(response => {
                    team.isActive = !team.isActive;
                    this.showSuccess = true;
                    this.successMessage = 'State of Team Changed!';
                })
                .catch(erros => {
                    console.log(erros);
                });

            axios({
                    method: 'post',
                    url: 'api/teamActiveHistory/insertTeamRecord',
                    data: {
                        'team_id': team.id,
                        'changed_to': !team.isActive,
                    },
                })

                .then(function (response) {
                    Swal.fire({
                        type: 'success',
                        title: 'New history entry created!',
                        showConfirmButton: true,
                    })
                    console.log(response);
                })

                .catch(function (error) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Couldnt create history entry!',
                    })
                    console.log(error);
                });
        },

      newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
      },
      editModal(team){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(team);
      },
      loadTeams(){
          axios.get('api/teams')
  					.then(response=>{
  					this.teams = response.data.data; 
  				});		
      },
        edit(){
          this.$Progress.start();

          this.form.put('api/teams/edit/' + this.form.id)
            .then(response => {             
              $('#addNew').modal('hide')
              Swal.fire(
                'Edited!',
                'Team has been edited.',
                'success'
              )
              this.$Progress.finish(); 
              Fire.$emit('refresh');            
              })
              .catch(error => {
              Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              })
            });

          this.$Progress.fail();
        },
        create(){
          this.$Progress.start();
          
            this.form.post('api/teams/create')
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Team created',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Team not created',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deleteTeam(id){
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if(result.value){
            axios.delete('api/teams/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Team has been deleted.',
                'success'
              )
              Fire.$emit('refresh');             
              })
              .catch(error => {
              Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              })
            });
          }    
          })
        }
    },
        created(){
            Fire.$on('searching',() => {
            let query = this.$parent.search;
            axios.get('api/findTeam?q=' + query)
            .then((response) =>{
              this.teams = response.data;
            })
            .catch(() =>{

            })
          })
          this.loadTeams();
          Fire.$on('refresh',()=>{
            this.loadTeams();
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