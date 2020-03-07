<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Researchers in Projects Table</h3>

                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Researcher</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="researcher in researchers" :key="researcher.id">
                    <td>{{ researcher.user_id }}</td>
                    <td>{{ researcher.user_name }}</td>
                    <td>{{ researcher.project_id }}</td>
                    <td>{{ researcher.project_title }}</td>
                    <td>
                      <!--
                        <a href="#" @click="editModal(researcher)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        /
                        -->
                        <a href="#" @click="deleteResearcher(researcher.project_researchers_id)">
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
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Researcher</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Researcher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="editmode ? edit() : create()" >
      <div class="modal-body">
        <div class="form-group">
	        <select name="userSelected" v-model="form.userSelected" class="form-control" 
            :class="{'is-invalid': form.errors.has('userSelected')}"> 
           <option :value="''" disabled selected> - Please select a User - </option> 
           <option v-for="user in users" :value="user.id" :key="user.id">{{ user.name }}</option>
           </select>
           <has-error :form="form" field="userSelected"></has-error>
        </div>
        <div class="form-group">
	        <select name="projectSelected" v-model="form.projectSelected" class="form-control" 
            :class="{'is-invalid': form.errors.has('projectSelected')}"> 
           <option :value="''" disabled selected> - Please select a Project - </option> 
           <option v-for="project in projects" :value="project.id" 
           :key="project.title">{{ project.title }}</option>
           </select>
           <has-error :form="form" field="projectSelected"></has-error>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button v-show="!editmode" type="submit" class="btn btn-primary">Add</button>
        <button v-show="editmode" type="submit" class="btn btn-success">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>
 </div>
    
</template>

<script type="text/javascript">
  // Component code (not registered)

	export default{
		data: function () {
		return {
        editmode: false,
        researchers: [],
        users:[],
        projects:[],
        form : new Form({
            id:'',
            userSelected:'',
            projectSelected:'',
        }), 
		  }
    },
    methods:{
      loadProjects(){
          axios.get('api/projects')
  					.then(response=>{
  					this.projects = response.data.data; 
  				});
      },
      loadUsers(){
          axios.get('api/users')
  					.then(response=>{
  					this.users = response.data.data; 
  				});		
        },
      newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
      },

      /*
      editModal(researcher){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(researcher);
      },
      */

      loadResearchers(){
          axios.get('api/researchers/getResearchersPerProject')
  					.then(response=>{
  					this.researchers = response.data.data; 
  				});		
        },
        
        /*
        edit(){
          this.$Progress.start();

          this.form.put('api/researchers/edit/' + this.form.id)
            .then(response => {             
              $('#addNew').modal('hide')
              Swal.fire(
                'Edited!',
                'Researcher has been edited.',
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
        }, */
        create(){
          this.$Progress.start(); 
          
            this.form.post('api/researchers/add', this.form.userSelected, this.form.projectSelected)
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Researcher Association Updated!',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Researcher Association Updated!',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deleteResearcher(id){
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
            axios.delete('api/researchers/deleteResearcherFromProject/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Researcher has been deleted.',
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
          /*
            Fire.$on('searching',() => {
            let query = this.$parent.search;
            axios.get('api/findResearcher?q=' + query)
            .then((response) =>{
              this.researchers = response.data;
            })
            .catch(() =>{

            })
          })
          */
          this.loadResearchers();
          this.loadUsers();
          this.loadProjects();
          Fire.$on('refresh',()=>{
            this.loadResearchers();
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