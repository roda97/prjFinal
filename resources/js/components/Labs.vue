<template>
    <div class="container">
    <div class="row mt-5">
       <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Laboratories Table</h3>

                <div class="card-tools">
                  <button class ="btn btn-success" @click="newModal">Add new</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Lab ID</th>
                    <th>Location</th>
                    <th>Name</th>
                    <th>Work Posts</th>
                    <th>Area(m²)</th>
                    <th>Workgroup</th>                  
                    <th>Photo</th>
                    <th>Actions</th>
                  </tr>               
                  <tr v-for="lab in labs" :key="lab.id">
                    <td>{{ lab.id }}</td>
                    <td>{{ lab.laboratoy_real_id }}</td>
                    <!--<td>{{ lab.campus_id  }}</td>-->
                    <td>{{ lab.school_campus_name }}</td>
                    <td>{{ lab.name }}</td>
                    <td>{{ lab.number_work_posts }}</td>
                    <td>{{ lab.area_m2 }}</td>
                    <td>{{ lab.workgroup }}</td>
                    <td><img width="80" :src="'img/labs/'+ lab.lab_img_path"></td>
                    <td>
                        <a href="#" @click="editModal(lab)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteLab(lab.id)">
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
        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Lab</h5>
        <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Lab</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" @submit.prevent="editmode ? edit() : create()" >
      <div class="modal-body">
        <div class="form-group">
	        <input type="text" name="laboratoy_real_id" v-model="form.laboratoy_real_id" placeholder="Laboratoy ID"
           class="form-control" :class="{'is-invalid': form.errors.has('laboratoy_real_id')}"> 
          <has-error :form="form" field="laboratoy_real_id"></has-error>
	    </div>
        <div class="form-group">
	        <!--
            <input type="text" name="campus_id" v-model="form.campus_id" placeholder="Campus (choose from 1 to 6)"
           class="form-control" :class="{'is-invalid': form.errors.has('campus_id')}"> 
          <has-error :form="form" field="campus_id"></has-error>
          -->
          <div class="form-group">
	        <select name="school_campus_name" v-model="form.school_campus_name"
           class="form-control" :class="{'is-invalid': form.errors.has('school_campus_name')}"> 
              <option :value="''" disabled selected> - Select a Campus Name - </option> 
              <option value="Campus 1">Campus 1</option>
              <option value="Campus 2">Campus 2</option>
              <option value="Campus 3">Campus 3</option>
              <option value="Campus 4">Campus 4</option>
              <option value="Campus 5">Campus 5</option>
              <option value="Serviços Centrais">Serviços Centrais</option>
            </select>
          <has-error :form="form" field="school_campus_name"></has-error>
          </div>
	    </div>

        <div class="form-group">
	        <input type="text" name="name" v-model="form.name" placeholder="Name"
           class="form-control" :class="{'is-invalid': form.errors.has('name')}"> 
          <has-error :form="form" field="name"></has-error>
	    </div>
        <div class="form-group">
	        <input type="text" name="number_work_posts" v-model="form.number_work_posts" placeholder="Work Posts"
           class="form-control" :class="{'is-invalid': form.errors.has('number_work_posts')}"> 
          <has-error :form="form" field="number_work_posts"></has-error>
	    </div>
        <div class="form-group">
	        <input type="text" name="area_m2" v-model="form.area_m2" placeholder="Area(m²)"
           class="form-control" :class="{'is-invalid': form.errors.has('area_m2')}"> 
          <has-error :form="form" field="area_m2"></has-error>
	    </div>
      
        <div class="form-group">

          <!--<v-combobox class="form-control"  v-model="form.workgroup" :items="workgroups" :rules="[v => !!v || 'Campo obrigatório']" label="Escolha uma imagem" required></v-combobox >                                        
          <v-combobox  v-model="form.workgroup" :items="workgroups" :rules="[v => !!v || 'Campo obrigatório']" label="Escolha uma imagem" ></v-combobox>-->

	        <select editable="true" name="workgroup" v-model="form.workgroup"                                    
           class="form-control" :class="{'is-invalid': form.errors.has('workgroup')}" > 
              <option :value="''" disabled selected> - Select a workgroup - </option> 
              <option value="Cybersecurity and Digital Forensics">Cybersecurity and Digital Forensics</option>
              <option value="Internet of Things (IoT)">Internet of Things (IoT)</option>
              <option value="Virtual and Augmented Reality (VAR)">Virtual and Augmented Reality (VAR)</option>
              <option value="All">All</option>
            </select>
          <has-error :form="form" field="workgroup"></has-error>
	    </div>     
        <div class="form-group">
          <label class="col-sm-2 control-label">Photo</label>
          <div class="col-sm-10">
            <input type="file" @change="onFileSelected" class="form-control-file">
          </div>
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
  //import { mdbSelect } from "mdbvue";
  //import axios from "axios";



	export default{

		data: function () {
			return {
            workgroups:["Cybersecurity and Digital Forensics", "Internet of Things (IoT)", "Virtual and Augmented Reality (VAR)", "All"],
            editmode: false,
            labs: [],
            form : new Form({
            id: '',
            laboratoy_real_id: '',
            //campus_id:'',
            school_campus_name: '',
            name:'',
            number_work_posts:'',
            area_m2:'',
            workgroup:'',
            lab_img_path:'',
            }), 
		}
    },
    methods:{
				onFileSelected(e){          
          let file = e.target.files[0];
          let reader = new FileReader();
          if(file['size'] < 2111775){
            reader.onloadend = (file)=>{
              this.form.lab_img_path = reader.result;
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
      newModal(){
        this.editmode = false;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
      },
      editModal(lab){
        this.editmode = true;
        this.form.clear();
        this.form.reset();
        $('#addNew').modal('show');
        this.form.fill(lab);
      },
      loadLabs(){
          axios.get('api/labs')
  					.then(response=>{
  					this.labs = response.data.data; 
  				});		
      },
        edit(){
          this.$Progress.start();

          this.form.put('api/labs/edit/' + this.form.id)
            .then(response => {             
              $('#addNew').modal('hide')
              Swal.fire(
                'Edited!',
                'Lab has been edited.',
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
          
            this.form.post('api/labs/create')
            .then(response => {
              $('#addNew').modal('hide')

              Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Lab created',
              showConfirmButton: false,
              timer: 1500}
              )
              this.$Progress.finish();
              Fire.$emit('refresh');
              })
              .catch(error => {
                toast({
                  type: 'error',
                  title: 'Lab not created',
                }) 
              });              
          this.$Progress.fail();
        },
        
        deleteLab(id){
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
            axios.delete('api/labs/delete/' + id)
              .then(response => {             
              Swal.fire(
                'Deleted!',
                'Lab has been deleted.',
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
            axios.get('api/findLab?q=' + query)
            .then((response) =>{
              this.labs = response.data;
            })
            .catch(() =>{

            })
          })
          this.loadLabs();
          Fire.$on('refresh',()=>{
            this.loadLabs();
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