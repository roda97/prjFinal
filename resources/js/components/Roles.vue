<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">  
            <div class="card-tools" style="text-align:right">
                <button class ="btn btn-success" @click="newModal" style="width: 20%; height: 100%;">Add New Role</button>
            </div>        
            <div class="card">               
              <div class="card-header">
                <h3 class="card-title">Full Member Table</h3>
              </div>
              <!-- /.card-header Full Member -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    
                    <th>User Name</th>
                    <th>Role Name</th>
                    <th>Role Function</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="memberRole in memberRoles" :key="memberRole.id">            
              
                    <td v-if= "memberRole['name'] == 'Full Member'">{{ memberRole.user_name }}</td>
                    <td v-if= "memberRole['name'] == 'Full Member'">{{ memberRole.name }}</td>
                    <td v-if= "memberRole['name'] == 'Full Member'">{{ memberRole.function }}</td>
                    <td v-if= "memberRole['name'] == 'Full Member'">
                        <a href="#" @click="deleteMember(memberRole.id)">
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
          <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">External Member Table</h3>
              </div>
              <!-- /.card-header Full Member -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
               
                    <th>User Name</th>
                    <th>Role Name</th>
                    <th>Role Function</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="memberRole in memberRoles" :key="memberRole.id">            
                   
                    <td v-if= "memberRole['name'] == 'External Member'">{{ memberRole.user_name }}</td>
                    <td v-if= "memberRole['name'] == 'External Member'">{{ memberRole.name }}</td>
                    <td v-if= "memberRole['name'] == 'External Member'">{{ memberRole.function }}</td>
                    <td v-if= "memberRole['name'] == 'External Member'">
                        <a href="#" @click="deleteMember(memberRole.id)">
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
          <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Collaborator Member Table</h3>
              </div>
              <!-- /.card-header Full Member -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
         
                    <th>User Name</th>
                    <th>Role Name</th>
                    <th>User Career</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="memberRole in memberRoles" :key="memberRole.id">            
              
                    <td v-if= "memberRole['name'] == 'Collaborator Member'">{{ memberRole.user_name }}</td>
                    <td v-if= "memberRole['name'] == 'Collaborator Member'">{{ memberRole.name }}</td>
                    <td v-if= "memberRole['name'] == 'Collaborator Member'">{{ memberRole.user_career }}</td>
                    <td v-if= "memberRole['name'] == 'Collaborator Member'">
                        <a href="#" @click="deleteMember(memberRole.id)">
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
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Role</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Role</h5>
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
	        <select name="roleSelected" @change="changeName" v-model="form.roleSelected" class="form-control" 
            :class="{'is-invalid': form.errors.has('roleSelected')}"> 
           <option :value="''" disabled selected> - Please select a Role - </option> 
           <option v-for="role in roles" :value="role.name" 
           :key="role.id">{{ role.name }}</option>
           </select>
           <has-error :form="form" field="roleSelected"></has-error>
        </div>
        <div class="form-group">
	        <select name="functionSelected" v-model="form.functionSelected" class="form-control" 
            :class="{'is-invalid': form.errors.has('functionSelected')}"> 
           <option :value="''" disabled selected> - Please select a Function - </option> 
           <option v-for="role in roleFunctions" :value="role.id" 
           :key="role.id">{{ role.function }}</option>
           </select>
           <has-error :form="form" field="functionSelected"></has-error>
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
        memberRoles: [],
        users:[],
        roles:[],
        roleFunctions:[],
        form : new Form({
            id:'',
            userSelected:'',
            roleSelected:'',
            functionSelected: '',   
            }), 
		}
    },
    methods:{
    changeName(){
            axios.get('/api/roles/' + this.form.roleSelected)
                .then(response => {
                    this.roleFunctions = response.data.data;
        });
    },
      loadRoles(){
          axios.get('api/roles')
  					.then(response=>{
  					this.roles = response.data; 
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
      editModal(memberRole){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(memberRole);
      },
      loadMemberRoles(){
          axios.get('api/memberRoles')
  					.then(response=>{
            this.memberRoles = response.data;
    
  				});		
        },
        create(){
          this.$Progress.start(); 
          
            this.form.post('api/memberRoles/create', this.form.userSelected, this.form.roleSelected, this.form.functionSelected)
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Member Role Created!',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Member Role Not Created!',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deleteMember(id){
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
            axios.delete('api/memberRoles/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Member Role has been deleted.',
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
            axios.get('api/findMember?q=' + query)
            .then((response) =>{
              this.memberRoles = response.data;
            })
            .catch(() =>{

            })
          })
          this.loadMemberRoles();
          this.loadUsers();
          this.loadRoles();
          Fire.$on('refresh',()=>{
            this.loadMemberRoles();
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