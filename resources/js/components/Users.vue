<template>
<div id="table" class="container" >
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users Table</h3>

                    <div class="card-tools">
                        <button class ="btn btn-success" @click="newModal">Add new</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Download Curriculum</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Institution</th>
                                <th>Academic Degree</th>
                                <th>Department</th>
                                <th>Career</th>
                                <th>User science</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            <tr v-for="user in users" :key="user.id">
                                <td>
                                    <a href="#" @click="downloadStandardCV(user.science_id)">
                                    <i class ="fa fa-file-pdf red fa-3x"></i></a>
                                </td>
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.institution_name }}</td>
                                <td>{{ user.academic_degree }}</td>
                                <td>{{ user.department}}</td>
                                <td>{{ user.career}}</td>
                                <td>{{ user.science_id }}</td>
                                <td v-if="user.photo == null"><img width="80" v-bind:src="'img/man.png'" ></td>
                                <td v-if="user.photo != null"><img width="80" v-bind:src="'img/profile/' + user.photo"></td>
                                <td>
                                    <toggle-button @change="alterIsActive(user)" :value=!!+user.isActive :color="{checked: '#00FF00', 
                                unchecked: '#FF0000'}" :labels="{checked: 'ON', unchecked: 'OFF'}" />
                                </td>
                                <td>
                                    <a href="#" v-if="user.isAdmin == 0" @click="promote(user)">
                            <i class ="fa fa-arrow-alt-circle-up"></i>
                        </a>
                                    <a href="#" v-if="user.isAdmin == 1" @click="demote(user)">
                            <i class ="fa fa-arrow-alt-circle-down"></i>
                        </a> /
                                    <a href="#" @click="editModal(user)">
                            <i class ="fa fa-edit blue"></i>
                        </a> /
                                    <a href="#" @click="deleteUser(user.id)">
                            <i class ="fa fa-trash red"></i>
                        </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <!--<div class="card-footer">
                <pagination :data="users" 
                @pagination-change-page="getResults"></pagination>
              </div>-->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New User</h5>
                    <h5 class="modal-title" v-show="editmode" id="editLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <form @submit.prevent="editmode ? editUser() : createUser()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" v-model="form.name" placeholder="Name"
           class="form-control" :class="{'is-invalid': form.errors.has('name')}">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" v-model="form.password" placeholder="Password"
           class="form-control" :class="{'is-invalid': form.errors.has('password')}">
                            <has-error :form="form" field="password"></has-error>
                        </div>

                        <div class="form-group">
                            <input type="text" name="email" v-model="form.email" placeholder="Email"
           class="form-control" :class="{'is-invalid': form.errors.has('email')}">
                            <has-error :form="form" field="email"></has-error>
                        </div>

                        <div class="form-group">
                            <input type="text" name="institution_name" v-model="form.institution_name" placeholder="Institution Name"
           class="form-control" :class="{'is-invalid': form.errors.has('institution_name')}">
                            <has-error :form="form" field="institution_name"></has-error>
                        </div>

                        <div class="form-group">
                            <select name="academic_degree" v-model="form.academic_degree"
           class="form-control" :class="{'is-invalid': form.errors.has('academic_degree')}">
              <option :value="''" disabled selected>- Select an academic degree -</option>
              <option value="Master of Science">Master of Science</option>
              <option value="Postgraduate Academic Degree">Postgraduate Academic Degree</option>
          </select>
                            <has-error :form="form" field="academic_degree"></has-error>
                        </div>

                        <div class="form-group">
                            <select name="department" v-model="form.department"
           class="form-control" :class="{'is-invalid': form.errors.has('department')}">
              <option :value="''" disabled selected> - Select a department - </option> 
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

          <div class="form-group">
                            <select name="career" v-model="form.career"
           class="form-control" :class="{'is-invalid': form.errors.has('career')}">
              <option :value="''" disabled selected> - Select a career - </option> 
              <option value="Estudante">Estudante</option>
              <option value="Tecnico">Tecnico</option>
              <option value="Professor">Professor</option>
          </select>
              <has-error :form="form" field="career"></has-error>
                        </div>
                          

                        <div class="form-group">
                            <input type="text" name="science_id" v-model="form.science_id" placeholder="User Science"
                            class="form-control" :class="{'is-invalid': form.errors.has('science_id')}">
                            <has-error :form="form" field="science_id"></has-error>
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
    <div class="alert" :class="typeofmsg" v-if="showMessage">
        <button type="button" class="close-btn" v-on:click="showMessage=false">&times;</button>
        <strong>{{ message }}</strong>
    </div>
</div>
</template>

<script>
// Component code (not registered)
//import projectEdit from './ProjectsEdit.vue'

export default {
    data: function () {
        return {
            users: [],
            editmode: false,
            form: new Form({
                id: '',
                name: '',
                password: '',
                email: '',
                institution_name: '',
                academic_degree: '',
                role: '',
                department: '',
                science_id: '',
                photo: '',
                career: '',
            }),
            showMessage: false,
            successMessage: '',
            currentUser: null,
        }
    },
    methods: {
        downloadStandardCV(science_id) {
            axios({
                    url: "api/CienciaVitae/getMyCurriculum/" + science_id,
                    method: "GET",
                    responseType: "blob" // important
                })
                .then(response => {
                    Swal.fire("Downloading...", "Your file is ready!", "success");

                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute("download", "file.pdf");
                    document.body.appendChild(link);
                    link.click();
                })
                .catch(error => {
                    console.log(error)
                    Swal.fire({
                        type: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });
                });
        },

        alterIsActive(user) {
            axios.put("api/users/alterIsActive/" + user.id)
                .then(response => {
                    user.isActive = !user.isActive;
                    this.showSuccess = true;
                    this.successMessage = 'State of User Changed!';
                })
                .catch(erros => {
                    console.log(erros);
                });

            axios({
                    method: 'post',
                    url: 'api/userActiveHistory/insertRecord',
                    data: {
                        'user_id': user.id,
                        'name': user.name,
                        'changed_to': !user.isActive,
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
        newModal() {
            this.editmode = false;
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
        },
        editModal(user) {
            this.editmode = true;
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user);
        },
        loadUsers() {
            axios.get('api/users')
                .then(response => {
                    this.users = response.data.data;
                });
        },
        editUser() {
            this.$Progress.start();

            this.form.put('api/users/edit/' + this.form.id)
                .then(response => {
                    $('#addNew').modal('hide')
                    Swal.fire(
                        'Edited!',
                        'Your user has been edited.',
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
        createUser() {
            this.$Progress.start();

            this.form.post('api/users/create')
                .then(response => {
                    $('#addNew').modal('hide')

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'User created',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                    Fire.$emit('refresh');
                })
                .catch(error => {
                    toast({
                        type: 'error',
                        title: 'User not created',
                    })
                });
            this.$Progress.fail();
        },

        deleteUser(id) {
            this.currentUser = null;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('api/users/delete/' + id)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Your user has been deleted.',
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
        },
        promote: function(user) {   
		    	axios.put("/api/users/promote/" + user.id)
		    	.then(response =>{
		    		Swal.fire(
                        'Upgrade',
                        'User promoted!',
                        'success'
                        )
                    Fire.$emit('refresh');
                }).catch(error => {
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                });        
        },
        demote: function(user) {   
		    	axios.put("/api/users/demote/" + user.id)
		    	.then(response =>{
		    		Swal.fire(
                        'Downgrade',
                        'User demoted!',
                        'success'
                        )
                    Fire.$emit('refresh');
                }).catch(error => {
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                });        
        },
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findUser?q=' + query)
                .then((response) => {
                    this.users = response.data;
                })
                .catch(() => {

                })
        })
        this.loadUsers();
        //this.getResults();
        Fire.$on('refresh', () => {
            this.loadUsers();
        });
    },
}
</script>
<style>
#table{
    max-width: max-content;
}
</style>