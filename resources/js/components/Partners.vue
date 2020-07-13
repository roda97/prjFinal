<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Partners Table</h3>
                <!--<br>
                <div class="form-group">
                <select v-model="selectedCategory" class="form-control">
                  <option value="''" disabled selected> - Filter by Project - </option> 
                  <option v-for="project in projects" :key="project.id">{{ project.name }}</option>
                </select>
                </div>-->

                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="partner in partners" :key="partner.id">
                    <td>{{ partner.name }}</td>
                    <td>
                        <a href="#" @click="editModal(partner)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deletePartner(partner.id)">
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
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Partner</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Partner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="editmode ? edit() : create()" >
      <div class="modal-body">
        <div class="form-group">
	        <input type="text" name="name" v-model="form.name" placeholder="Name"
           class="form-control" :class="{'is-invalid': form.errors.has('name')}"> 
          <has-error :form="form" field="name"></has-error>
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

<script type="text/javascript">
  // Component code (not registered)

	export default{
		data: function () {
			return {
            editmode: false,
            partners: [],
            projects: [],
            selectedCategory:'',
            form : new Form({
            id: '',
            name: '',
            }), 
		}
    },
    methods:{
      newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
      },
      editModal(partner){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(partner);
      },
      loadProjects(){
          axios.get('api/projects')
  					.then(response=>{
  					this.projects = response.data.data; 
  				});		
      },
      loadPartners(){
          axios.get('api/partners')
  					.then(response=>{
  					this.partners = response.data.data; 
  				});		
        },
        edit(){
          this.$Progress.start();

          this.form.put('api/partners/edit/' + this.form.id)
            .then(response => {             
              $('#addNew').modal('hide')
              Swal.fire(
                'Edited!',
                'Your partner has been edited.',
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
          
            this.form.post('api/partners/create')
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Partner created',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Partner not created',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deletePartner(id){
          this.currentProject = null;
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
            axios.delete('api/partners/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Your partner has been deleted.',
                'success'
              )
              Fire.$emit('refresh');             
              })
              .catch(error => {
              Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'This partner is associated to a Project!',
              })
            });
          }    
          })
        }
    },
        created(){
            Fire.$on('searching',() => {
            let query = this.$parent.search;
            axios.get('api/findPartner?q=' + query)
            .then((response) =>{
              this.partners = response.data;
            })
            .catch(() =>{

            })
          })
          this.loadPartners();
          this.loadProjects();
          Fire.$on('refresh',()=>{
            this.loadPartners();
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