<template>
    <div id="table" class="container" >
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Awards Table</h3>

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
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="award in awards" :key="award.id">
                    <td>{{ award.id }}</td>
                    <td>{{ award.title }}</td>
                    <td>{{ award.description }}</td>
                    <td>
                        <a href="#" v-if="aux == 1 || membroComissaoCientifica == 0|| aux == award.user_id" @click="editModal(award)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        <a v-if="aux == 1 || membroComissaoCientifica == 0|| aux == award.user_id">
                          /
                        </a>  
                        
                        <a href="#" v-if="aux == 1 || membroComissaoCientifica == 0|| aux == award.user_id" @click="deleteAward(award.id)">
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
          </div>
          </div>
          <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Award</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Award</h5>
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
	        <textarea type="text" name="description" v-model="form.description" placeholder="Description"
          class="form-control" :class="{'is-invalid': form.errors.has('description')}"/> 
          <has-error :form="form" field="description"></has-error>
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
            aux: '',
            membroComissaoCientifica: '',
            editmode: false,
            awards: [],
            selectedCategory:'',
            form : new Form({
            id: '',
            title: '',
            description:''
            }), 
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
                this.aux = response.data;
                console.log(this.aux);
                //this.$store.commit("setSearchPermission", response.data);
            });
      },

      newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
      },
      editModal(award){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(award);
      },
      loadAwards(){
          axios.get('api/awards')
  					.then(response=>{
  					this.awards = response.data.data; 
  				});		
      },
        edit(){
          this.$Progress.start();

          this.form.put('api/awards/edit/' + this.form.id)
            .then(response => {             
              $('#addNew').modal('hide')
              Swal.fire(
                'Edited!',
                'Award has been edited.',
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
          
            this.form.post('api/awards/create')
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Award created',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Award not created',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deleteAward(id){
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
            axios.delete('api/awards/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Award has been deleted.',
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
        axios.get('api/findAward?q=' + query)
        .then((response) =>{
          this.awards = response.data;
        })
        .catch(() =>{

        })
      })
      this.loadAwards();
      Fire.$on('refresh',()=>{
        this.loadAwards();
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
#table{
    max-width: max-content;
}
</style>