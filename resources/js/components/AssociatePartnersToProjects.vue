<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Partners in Projects Table</h3>

                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new Partner</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>Partner ID</th>
                    <th>Partner Name</th>
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Actions</th>
                  </tr>               
                  <!--<tr v-for="partner in partners" :key="partner.id">-->
                    <tr v-for="(partner, i) in partners" :key="i">
                    <td>{{ partner.partner_id }}</td>
                    <td>{{ partner.name }}</td>
                    <td>{{ partner.project_id }}</td>
                    <td>{{ partner.title }}</td>
                    <td>
                      <!--
                        <a href="#" @click="editModal(partner)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        /
                        -->
                        <a href="#" @click="deletePartner(partner.partners_projects_id)">
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
	        <select name="partnerSelected" v-model="form.partnerSelected" class="form-control" 
            :class="{'is-invalid': form.errors.has('partnerSelected')}"> 
           <option :value="''" disabled selected> - Please select a Partner - </option> 
           <!--<option v-for="partner in partners" :value="partner.id" :key="partner.id">{{ partner.name }}</option>-->
           <option v-for="(partner, i) in partners" :value="partner.id" :key="i">{{ partner.name }}</option>
           </select>
           <has-error :form="form" field="partnerSelected"></has-error>
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
        partners: [],
        partners:[],
        projects:[],
        form : new Form({
            id:'',
            partnerSelected:'',
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
      //falta criar novo metodo em base deste em baixo para este problema
      loadPartners(){
          axios.get('api/partners')
  					.then(response=>{
  					this.partners = response.data.data; 
  				});		
        },
      newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
      },

      /*
      editModal(partner){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(partner);
      },
      */

      loadPartners(){
          axios.get('api/partners/getPartnersPerProject')
  					.then(response=>{
  					this.partners = response.data.data; 
  				});		
        },
        
        /*
        edit(){
          this.$Progress.start();

          this.form.put('api/partners/edit/' + this.form.id)
            .then(response => {             
              $('#addNew').modal('hide')
              Swal.fire(
                'Edited!',
                'Partner has been edited.',
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
          
            this.form.post('api/partners/add', this.form.partnerSelected, this.form.projectSelected)
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Partners Association Updated!',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Partners association not updated!',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deletePartner(id){
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
            axios.delete('api/partners/deletePartnerFromProject/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Partner has been deleted.',
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
            axios.get('api/findPartnerToProject?q=' + query)
            .then((response) =>{
              this.partners = response.data;
            })
            .catch(() =>{

            })
          })         
          this.loadPartners();
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