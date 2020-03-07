<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Scientific Committee Table</h3>

                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Member</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <!--<th>Scientific Committee Start Date</th>-->
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="member in members" :key="member.id">
                    <td>{{ member.user_id }}</td>
                    <td>{{ member.user_name }}</td>
                    <!--<td>{{ member.start_date }}</td>-->
                    <td>
                        <!--<a href="#" @click="editModal(member)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        /-->
                        <a href="#" @click="deleteMember(member.row_id)">
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
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Member</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Member</h5>
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
        <!--<div class="form-group">
	        <select name="committeeSelected" v-model="form.committeeSelected" class="form-control" 
            :class="{'is-invalid': form.errors.has('committeeSelected')}"> 
           <option :value="''" disabled selected> - Please select a Scientific Committee - </option> 
           <option v-for="scientificCommittee in scientificCommittees" :value="scientificCommittee.id" 
           :key="scientificCommittee.id">{{ scientificCommittee.id }}</option>
           </select>
           <has-error :form="form" field="committeeSelected"></has-error>
        </div>-->
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
        members: [],
        users:[], 
        scientificCommittees:[],
        form : new Form({
            id:'',
            userSelected:'',
            committeeSelected:'',
        }), 
		  }
    },
    methods:{
      loadScientificCommittees(){
          axios.get('api/scientificCommittee')
  					.then(response=>{
  					this.scientificCommittees = response.data.data; 
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
      editModal(member){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(member);
      },
      loadMembers(){
          axios.get('api/members')
  					.then(response=>{
  					this.members = response.data.data; 
  				});		
        },
        create(){
          this.$Progress.start(); 
          
            this.form.post('api/members/create', this.form.userSelected, this.form.committeeSelected)
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Scientifc Committee Updated!',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Scientifc Committee not updated!',
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
            axios.delete('api/members/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Member has been deleted.',
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
              this.members = response.data;
            })
            .catch(() =>{

            })
          })
          this.loadMembers();
          this.loadUsers();
          this.loadScientificCommittees();
          Fire.$on('refresh',()=>{
            this.loadMembers();
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