<template>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">News Table</h3>

                    <div class="card-tools">

                        <a href="/newsadd"
                        button class ="btn btn-success">
                        Add new

                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Description</th>
                                <th>Photo</th>
                                <th>Created At</th>
                                <th>Actions</th>
                                <!-- <th>Status</th> -->
                            </tr>
                            <tr v-for="article in news" :key="article.id" :class="{activerow: currentNew === article}">
                                <td>{{ article.id }}</td>
                                <td>{{ article.title }}</td>
                                <td>{{ article.author }}</td>
                                <td>{{ article.description }}</td>
                                <td><img width="80" height="47" :src="'img/news/'+ article.new_img_path"></td>
                                <td>{{ article.created_at }}</td>
                                <td>

                                    <a href="#"

                                      @click="editorContent = getEditorContent(article.id)"
                                      data-toggle="modal"
                                      data-target="#editTextModal">
                                      <i class ="fa fa-edit blue"></i>
                                      </a>

                                    /
                                    <a href="#" @click="deleteNew(article.id)">
                            <i class ="fa fa-trash red"></i>
                        </a>
                                </td>
                                <!--
                                <td>
                                    <toggle-button @change="alterStatus(article)" :value=!!+article.status :color="{checked: '#00FF00', 
                                unchecked: '#FF0000'}" :labels="{checked: 'ON', unchecked: 'OFF'}" />
                                </td>
                                -->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- ************************* MODAL PARA CADA LINHA INDIVIDUAL ************************* -->
    <div class="modal fade" id="editTextModal" tabindex="-1" role="dialog" aria-labelledby="editTextModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h3>Edit {{editing_title}}</h3>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Title:</label>
                            <input type="text" class="form-control" v-model="editing_title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Description</label>
                                <input type="text" class="form-control" v-model="editing_description" placeholder="Description">
                            </div>

                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Author</label>
                                    <input type="text" class="form-control" v-model="editing_author" placeholder="Author's name">
                                         </div>

                    </form>
                    <tinymce id="d1" :other_options="tinyOptions" v-model="editorContent"></tinymce>    
                </div>

                <div class="modal-footer">
                    <button type="button"
               class="btn btn-default"
               data-dismiss="modal">Close</button>
                    <span class="pull-right">
               <div>
                    <button class="btn btn-warning" @click="updateNew()">
                  Update
                  </button>
               </div>
            </span>
                </div>
            </div>
        </div>
  </div>
    </div>
</template>

<script>
// Component code (not registered)

export default {
    data: function () {
        return {
            editing_description: '',
            new_img_path: '',
            editing_id: null,
            editing_author: null,
            editing_title: null,

            author: '',
            title: '',
            editorContent: '',
            tinyOptions: {
                'height': 500
            },

            news: [],
            form: new Form({
                id: '',
                title: '',
                author: '',
                created_at: '',
            }),
            showMessage: false,
            successMessage: '',
            currentNew: null,
        }
    },
    methods: {

        updateNew() {

            axios({

                    method: 'put',
                    url: 'api/news/edit/' + this.editing_id,
                    data: {

                        'text': this.editorContent,
                        'title': this.editing_title,
                        'author': this.editing_author,
                        'description': this.editing_description

                    },

                }).then(function (response) {
                    $('#editTextModal').modal('hide')
                    Swal.fire({
                        type: 'success',
                        title: 'News Updated!',
                        showConfirmButton: true,
                    })
                    Fire.$emit('refresh');
                })

                .catch(function (error) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Fields cannot be empty!',
                    })
                    console.log(error);
                });
        },

        getEditorContent(id) {
            axios.get('/api/news/getNew/' + id)
                .then(response => {
                    this.editorContent = response.data.text;
                    this.editing_author = response.data.author;
                    this.editing_title = response.data.title;
                    this.editing_id = id;
                    this.editing_description = response.data.description;
                });

        },

        alterStatus(article) {

            axios.put("api/news/alterStatus/" + article.id)
                .then(response => {
                    article.status = !article.status;
                    this.showSuccess = true;
                    this.successMessage = 'State of News Changed!';
                })
                .catch(erros => {
                    console.log(erros);
                });
        },

        loadNews() {
            axios.get('api/news')
                .then(response => {
                    this.news = response.data.data;
                });
        },

        deleteNew(id) {
            this.currentNew = null;
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
                    axios.delete('api/news/delete/' + id)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Your article has been deleted.',
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
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findNew?q=' + query)
                .then((response) => {
                    this.news = response.data;
                })
                .catch(() => {

                })
        })
        this.loadNews();
        Fire.$on('refresh', () => {
            this.loadNews();
        })
    },
}
</script>

<style scoped>
tr.activerow {
    background: #123456 !important;
    color: #fff !important;
}

.modal-dialog {
    max-width: 50%;
}
</style>
