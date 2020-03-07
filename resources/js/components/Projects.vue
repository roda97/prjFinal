<template>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects Table</h3>

                    <div class="card-tools">
                        <button class ="btn btn-success" @click="newModal">Add new</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>
                                    <button
                                      type="button"
                                      class="btn btn-warning"
                                      @click="text_to_copy = formatAllRows()"
                                      data-toggle="modal"
                                      data-target="#copyAllRowsModal">Copy All</button>
                                </th>

                                <th>ID</th>
                                <th>Title</th>
                                <th>Abstract</th>
                                <th>Consortium</th>
                                <th>Funding</th>
                                <th>Proponent</th>
                                <th>Total Budget</th>
                                <th>CIIC Budget</th>
                                <th>Actions</th>
                            </tr>
                            <tr v-for="project in projects" :key="project.id" :class="{activerow: currentProject === project}">

                                <td>
                                    <button
                                      type="button"
                                      class="btn btn-success"
                                      @click="text_to_copy = 
                                      formatRow(
                                        project.title,
                                        project.abstract,
                                        project.consortium,
                                      project.funding,
                                      project.proponent,
                                      project.total_budget,
                                      project.ciic_budget
                                      )"
                                      data-toggle="modal"
                                      data-target="#copyRowModal">Copy</button>
                                </td>
                                <td>{{ project.id }}</td>
                                <td>{{ project.title }}</td>
                                <td>{{ project.abstract }}</td>
                                <td>{{ project.consortium }}</td>
                                <td>{{ project.funding }}</td>
                                <td>{{ project.proponent }}</td>
                                <td>{{ project.total_budget }}€</td>
                                <td>{{ project.ciic_budget }}€</td>
                                <td>
                                    <a href="#" @click="editModal(project)">
                            <i class ="fa fa-edit blue"></i>
                        </a>
                                    /
                                    <a href="#" @click="deleteProject(project.id)">
                            <i class ="fa fa-trash red"></i>
                        </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Project</h5>
                    <h5 class="modal-title" v-show="editmode" id="editLabel">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <form @submit.prevent="editmode ? edit() : create()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="title" v-model="form.title" placeholder="Title"
           class="form-control" :class="{'is-invalid': form.errors.has('title')}">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <!--<div class="form-group">

        <textarea type="text" class="form-control" name="abstract" v-validate="'required'" v-model="form.abstract" placeholder="Abstract"/>
          <div class="help-block alert alert-danger" v-show="errors.has('abstract')"> 
            {{errors.first('abstract')}}
          </div>

      </div>-->
                        <div class="form-group">
                            <input type="text" name="abstract" v-model="form.abstract" placeholder="Abstract"
          class="form-control" :class="{'is-invalid': form.errors.has('abstract')}"/>
                            <has-error :form="form" field="abstract"></has-error>
                        </div>
                        <div class="form-group">
                            <textarea type="text" name="consortium" v-model="form.consortium" placeholder="Consortium (Optional)"
          class="form-control" :class="{'is-invalid': form.errors.has('consortium')}"/>
          <has-error :form="form" field="consortium"></has-error>

      </div>
        <div class="form-group">

        <textarea type="text" name="funding" v-model="form.funding" placeholder="Funding (Optional)"
          class="form-control" :class="{'is-invalid': form.errors.has('funding')}"/> 
          <has-error :form="form" field="funding"></has-error>

      </div>
        <div class="form-group">

        <textarea type="text" name="proponent"  v-model="form.proponent" placeholder="Proponent (Optional)"
          class="form-control" :class="{'is-invalid': form.errors.has('proponent')}"/> 
          <has-error :form="form" field="proponent"></has-error>         

      </div>
        <div class="form-group">

        <input type="text" name="total_budget" v-model="form.total_budget" placeholder="Total Budget € (Optional)"
          class="form-control" :class="{'is-invalid': form.errors.has('total_budget')}"/> 
          <has-error :form="form" field="total_budget"></has-error> 

      </div>
        <div class="form-group">

        <input type="text" name="ciic_budget" v-model="form.ciic_budget" placeholder="CIIC Budget € (Optional)"
          class="form-control" :class="{'is-invalid': form.errors.has('ciic_budget')}"/> 
          <has-error :form="form" field="ciic_budget"></has-error> 

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

            <!-- ************************* MODAL PARA CADA LINHA INDIVIDUAL ************************* -->
    <div class="modal fade" id="copyRowModal" tabindex="-1" role="dialog" aria-labelledby="copyRowModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyRowModalLabel">Formatted Row</h5>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">
                        {{ this.text_to_copy }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button"
               class="btn btn-default"
               data-dismiss="modal">Close</button>
                    <span class="pull-right">
               <div>
                  <button class="btn btn-success" v-clipboard:copy="text_to_copy" v-clipboard:success="onCopy">
                  Copy Text
                  </button>
               </div>
            </span>
                </div>
            </div>
        </div>
    </div>
    <!-- ********************************************************************************** -->

    <!-- ************************* MODAL PARA TODAS AS LINHAS ************************* -->
    <div class="modal fade" id="copyAllRowsModal" tabindex="-1" role="dialog" aria-labelledby="copyAllRowsModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyAllRowsModalLabel">Formatted Row</h5>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">
                        {{ this.text_to_copy }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button"
               class="btn btn-default"
               data-dismiss="modal">Close</button>
                    <span class="pull-right">
               <div>
                  <button class="btn btn-warning" v-clipboard:copy="text_to_copy" v-clipboard:success="onCopy">
                  Copy All
                  </button>
               </div>
            </span>
                </div>
            </div>
        </div>
    </div>
    <!-- ********************************************************************************** -->
 </div>
</template>

<script>
// Component code (not registered)

export default {
    data: function () {
        return {
            text_to_copy: '',
            editmode: false,
            projects: [],
            form: new Form({
                id: '',
                title: '',
                abstract: '',
                consortium: '',
                funding: '',
                proponent: '',
                total_budget: '',
                ciic_budget: '',
            }),
            showMessage: false,
            successMessage: '',
            currentProject: null,
        }
    },
    methods: {
        /*editProject: function(project){
          this.currentProject = project;
        }, 
        saveProject: function(){
          this.currentProject = null;
          Swal.fire({
          position: 'top-end',
          type: 'success',
          title: 'Project edited',
          showConfirmButton: false,
          timer: 1500})
        }, 
        cancelEdit: function(){
          this.currentProject = null;
        },*/

        onCopy: function (e) {
            Swal.fire({
                type: 'success',
                title: 'Text Copied!',
                showConfirmButton: true,
            })
            this.text_to_copy = e.text;
        },

        formatRow(title,
            abstract,
            consortium,
            funding,
            proponent,
            total_budget,
            ciic_budget) {

            var text = '';

            if (title) {
                text = text.concat("[Title] " + title + "\n");
            }

            if (abstract) {
                text = text.concat("[Abstract] " + abstract + "\n");
            }

            if (consortium) {
                text = text.concat("[Consortium] " + consortium + "\n");
            }

            if (funding) {
                text = text.concat("[Funding] " + funding + "\n");
            }

            if (proponent) {
                text = text.concat("[Proponent] " + proponent + "\n");
            }

            if (total_budget) {
                text = text.concat("[Total budget] " + total_budget + "\n");
            }

            if (ciic_budget) {
                text = text.concat("[CIIC budget] " + ciic_budget + "\n");
            }

            return text;
        },

        formatAllRows() {
            let aux = [];

            for (let project of this.projects) {
                aux = aux +
                    this.formatRow(
                        project.title,
                        project.abstract,
                        project.consortium,
                        project.funding,
                        project.proponent,
                        project.total_budget,
                        project.ciic_budget
                    ) + "\n----\n";
            }

            return aux;

        },

        newModal() {
            this.editmode = false;
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
        },
        editModal(project) {
            this.editmode = true;
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(project);
        },
        loadProjects() {
            axios.get('api/projects')
                .then(response => {
                    this.projects = response.data.data;
                });
        },
        edit() {
            this.$Progress.start();

            this.form.put('api/projects/edit/' + this.form.id)
                .then(response => {
                    $('#addNew').modal('hide')
                    Swal.fire(
                        'Edited!',
                        'Your project has been edited.',
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
        create() {
            this.$Progress.start();

            this.form.post('api/projects/create')
                .then(response => {
                    $('#addNew').modal('hide')

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Project created',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                    Fire.$emit('refresh');
                })
                .catch(error => {
                    toast({
                        type: 'error',
                        title: 'Project not created',
                    })
                });
            this.$Progress.fail();
        },

        deleteProject(id) {
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
                if (result.value) {
                    axios.delete('api/projects/delete/' + id)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Your project has been deleted.',
                                'success'
                            )
                            Fire.$emit('refresh');
                        })
                        .catch(error => {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'There is a researcher and/or partner associated to this Project!',
                            })
                        });
                }
            })
        }
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findProject?q=' + query)
                .then((response) => {
                    this.projects = response.data;
                })
                .catch(() => {

                })
        })
        this.loadProjects();
        Fire.$on('refresh', () => {
            this.loadProjects();
        })
    },
}
</script>

<style scoped>
tr.activerow {
    background: #123456 !important;
    color: #fff !important;
}
</style>
