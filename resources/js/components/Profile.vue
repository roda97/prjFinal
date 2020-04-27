<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0,
}
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" 
                    style="background-image:url('./img/user-cover.jpg')">
                <h3 class="widget-user-username">{{this.form.name}}</h3>
                <h5 class="widget-user-desc">{{this.form.academic_degree}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{this.form.institution_name}}</h5>
                      <!--<span class="description-text">SALES</span>-->
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{this.form.science_id}}</h5>
                      <!--<span class="description-text">SALES</span>-->
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{this.form.department}}</h5>
                      <!--<span class="description-text">SALES</span>-->
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            </div>
            <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane active show" id="settings">
                    <form>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name"
                          :class="{'is-invalid': form.errors.has('name')}">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"
                          :class="{'is-invalid': form.errors.has('email')}">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputInstitution" class="col-sm-2 control-label">Institution Name</label>

                        <div class="col-sm-10">
                          <input type="institution_name" v-model="form.institution_name" class="form-control" id="inputInstitution" placeholder="Institution Name"
                          :class="{'is-invalid': form.errors.has('institution_name')}">
                          <has-error :form="form" field="institution_name"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Academic Degree</label>

                        <div class="col-sm-10">
                          <select name="academic_degree" v-model="form.academic_degree" class="form-control" placeholder="Academic Degree"
                          :class="{'is-invalid': form.errors.has('academic_degree')}">
                            <option value="Master of Science">Master of Science</option>
                            <option value="Postgraduate Academic Degree">Postgraduate Academic Degree</option>
                          </select>
                          <has-error :form="form" field="academic_degree"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputDepartment" class="col-sm-2 control-label">Department</label>

                        <div class="col-sm-10">
                          <select name="department" v-model="form.department" class="form-control" id="inputDepartment" placeholder="Department"
                          :class="{'is-invalid': form.errors.has('department')}">
                          <option value="Ciências Jurídicas">Ciências Jurídicas</option>
                          <option value="Ciências da Linguagem">Ciências da Linguagem</option>
                          <option value="Engenharia do Ambiente">Engenharia do Ambiente</option>
                          <option value="Engenharia Civil">Engenharia Civil</option>
                          <option value="Engenharia Eletrotécnica">Engenharia Eletrotécnica</option>
                          <option value="Engenharia Informática">Engenharia Informática	</option>
                          <option value="Engenharia Mecânica">Engenharia Mecânica</option>
                          <option value="Gestão e Economia">Gestão e Economia</option>
                          <option value="Matemática">Matemática</option>
                          </select>
                          <has-error :form="form" field="department"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputScience" class="col-sm-2 control-label">Science ID</label>

                        <div class="col-sm-10">
                          <input type="text" v-model="form.science_id" class="form-control" id="inputScience" placeholder="Science ID"
                          :class="{'is-invalid': form.errors.has('science_id')}">
                          <has-error :form="form" field="science_id"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Photo</label>

                        <div class="col-sm-10">
                          <input type="file" @change="updatePhoto" name="photo" classform="form-input ">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-12 control-label">Password (leave empty if not changing)</label>

                        <div class="col-sm-12">
                          <input type="password" v-model="form.password" class="form-control" id="inputPassport" placeholder="Password"
                          :class="{'is-invalid': form.errors.has('password')}">
                          <has-error :form="form" field="password"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button @click.prevent="update" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form : new Form({
                  id: '',
                  name: '',
                  password:'',
                  email: '',
                  institution_name: '',
                  academic_degree: '',
                  role: '',
                  department: '',
                  science_id: '',
                  photo:'',
                })
            }
        },
        methods:{
          getProfilePhoto(){
            //let prefix = (this.form.photo.match(/\//) ? '' : '/img/profile/');
            //return prefix + this.form.photo;
            return "img/profile/" + this.form.photo;
          },
            updatePhoto(e){
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                if(file['size'] < 2111775){
                  reader.onloadend = (file)=>{
                      //console.log('RESULT', reader.result);
                      this.form.photo = reader.result;
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
            update(){
              this.$Progress.start();
              if(this.form.password == ''){
                this.form.password = undefined;
              }
              this.form.put('api/profile')
              .then(response => {             
                Fire.$emit("refresh");
                Swal.fire(
                'Edited!',
                'Your profile has been edited.',
                'success'
              )
                this.$Progress.finish();
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

            getData(){
              axios.get('api/profile')
              .then(({data}) => (this.form.fill(data)));
            }
        }, 
        
        created() {
          Fire.$on('searching',() => {
            let query = this.$parent.search;
            axios.get('api/findProfile?q=' + query)
            .then((response) =>{
              this.response = response.data;
            })
            .catch(() =>{

            })
          })
          this.getData();
          Fire.$on('refresh',()=>{
            this.getData();
          })          
        },
    }
</script>


<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 300px;
}
</style>