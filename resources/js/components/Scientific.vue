<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reunion Table</h3>

                <div class="card-tools">
                  <button class ="btn btn-success" v-if="id == 1 || membroComissaoCientifica == 0" @click="newModal">Add new Reunion</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>File</th>
                    <th>Room</th>
                    <th>Description</th>
                    <th>Date</th>
                    <!--<th>Scientific Committee Start Date</th>-->
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="scientificCommittee in scientificCommittees" :key="scientificCommittee.id">
                    <td>
                    <a v-if="scientificCommittee.ata != null" :href="'/storage/Atas/' + scientificCommittee.ata" download >
                    <i class ="fa fa-file-pdf red fa-3x"></i></a>
                    <br v-else="">
                    </td>
                    <td>{{ scientificCommittee.room }}</td>
                    <td>{{ scientificCommittee.description }}</td>
                    <td>{{ scientificCommittee.datereunion }}</td>
                    <!--<td>{{ member.start_date }}</td>-->
                    <td>
                        <!--<a href="#" @click="editModal(member)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                         /-->
                    
                        <a href="#" v-if="id == 1 || membroComissaoCientifica == 0" @click="editModal(scientificCommittee)">
                            <i class ="fa fa-edit blue"></i>
                        </a> 

                         <a v-if="id == 1 || membroComissaoCientifica == 0">
                          /
                        </a>

                        <a href="#" v-if="id == 1 || membroComissaoCientifica == 0" @click="deletereunion(scientificCommittee.id)">
                            <i class ="fa fa-trash red"></i>
                        </a>

                        <a v-else>
                        -
                        </a>  
                       
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Scientific Committee Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                  </tr>        
                  <tr v-for="memberRole in memberRoles"  :key="memberRole.id" > 
                   <td v-if="memberRole.user_photo == null && memberRole['name'] == 'Full Member'"><img width="80" v-bind:src="'img/man.png'" ></td>
                    <td v-if="memberRole.user_photo != null && memberRole['name'] == 'Full Member'"><img width="80" v-bind:src="'img/profile/' + memberRole.user_photo"></td>
                    <td v-if="memberRole['name'] == 'Full Member'">{{ memberRole.user_name }}</td>
                    <td v-if="memberRole['name'] == 'Full Member'">{{ memberRole.user_email }}</td>
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
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Reunion</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Reunion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="editmode ? edit() : create()" >
      <div class="modal-body">
        <div class="form-group">
           <input type="text" name="room" v-model="form.room" placeholder="Room"
           class="form-control" :class="{'is-invalid': form.errors.has('room')}">
                <has-error :form="form" field="room"></has-error>
          </div>
          <div class="form-group">
           <input type="text" name="description" v-model="form.description" placeholder="Description"
           class="form-control" :class="{'is-invalid': form.errors.has('description')}">
                <has-error :form="form" field="description"></has-error>
          </div>
          <div class="form-group">
           <input type="date" name="datereunion" v-model="form.datereunion" placeholder="Date of Reunion"
           class="form-control" :class="{'is-invalid': form.errors.has('datereunion')}">
                <has-error :form="form" field="datereunion"></has-error>
          </div>
          <div class="form-group">
            <input type="file" @change="updateFile" name="ata" placeholder="Meeting Minutes"
            class="form-control" :class="{'is-invalid': form.errors.has('ata')}">
                <has-error :form="form" field="ata"></has-error>
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
        id: '',
        membroComissaoCientifica: '',
        editmode: false,
        attachment: null,
        memberRoles: [],
        users:[],
        scientificCommittees:[],
        form : new Form({
            id:'',
            room:'',
            description:'',
            datereunion:'',
            ata:'',
            atab64:'',
            file_ata:null
        }),
        showMessage: false,
        successMessage: '', 
		  }
    },
    methods:{
      searchPermission(){
        axios.get('api/searchPermission')
            .then(response => {
                this.membroComissaoCientifica = response.data;
                //this.$store.commit("setSearchPermission", response.data);
            });
      },

      searchPermissionAwardsAndProjects(){
        axios.get('api/searchPermissionAwardsAndProjects')
            .then(response => {
                this.id = response.data;
                console.log(this.id);
                //this.$store.commit("setSearchPermission", response.data);
            });
      },

      loadScientificCommittees(){
          axios.get('api/scientificCommittee')
  					.then(response=>{
  					this.scientificCommittees = response.data.data; 
  				});
      },
      updateFile(e){
                let file = e.target.files[0];
                console.log(file.name);
                this.form.ata = file.name;
              let reader = new FileReader();
                if(file['size'] < 2111775){
                  reader.onloadend = (file)=>{
                      console.log('RESULT', reader.result);
                      this.form.atab64 = reader.result;
                      this.form.file_ata = file;
                  }
                  reader.readAsDataURL(file);
                }else{
                  Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'You are uploading a large file!',
                  })
                }
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
      editModal(scientificCommittee){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(scientificCommittee);
      },
        loadMemberRoles(){
          axios.get('api/memberRoles')
  					.then(response=>{
            this.memberRoles = response.data;
            
          })
          .catch((error) =>{
              console.log("erro roles");
            });	
        },
         
         formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
  
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
   
                let formData = new FormData();
                formData.append('file', this.file);
  
                axios.post('/formSubmit', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            },
         
         create() {
            this.$Progress.start();
            this.form.post('api/scientificCommittee/createreunion')
                .then(response => {
                    $('#addNew').modal('hide')

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Reunion created',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                    Fire.$emit('refresh');
                })
                .catch(error => {
                    toast({
                        type: 'error',
                        title: 'Reunion not created',
                    })
                });
            this.$Progress.fail();
        },
        edit() {
            this.$Progress.start();
            
            this.form.put('api/scientificCommittee/edit/' + this.form.id)
                .then(response => {
                    $('#addNew').modal('hide')
                    Swal.fire(
                        'Edited!',
                        'Your Reunion has been edited.',
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
                    console.log(error);
                });

            this.$Progress.fail();
        }, 
        deletereunion(id){
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
            axios.delete('api/scientificCommittee/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Reunion has been deleted.',
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
          this.scientificCommittee = response.data;
        })
        .catch(() =>{
          
        })
      })
      this.loadUsers();
      this.loadMemberRoles();
      this.loadScientificCommittees();
      Fire.$on('refresh',()=>{
        this.loadScientificCommittees();
      })
    },  
    mounted(){
      this.searchPermissionAwardsAndProjects();
      this.searchPermission();
    } 
	}
</script>

<style scoped>
	tr.activerow {
  		background: #123456  !important;
  		color: #fff          !important;
}

</style>