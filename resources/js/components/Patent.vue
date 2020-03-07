<template>
<div class="container">

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" align="center">
                    <h3 class="card-title">Patent</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>

                                <th>id</th>

                            </tr>

                            <tr v-for="patent in patents" :key="patent.id">

                                <td>{{ patent.id }}</td>

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
            patents: [],
            form: new Form({
                id: '',
                title: '',
            }),
            showMessage: false,
            successMessage: '',
            currentPatent: null,
        }
    },
    methods: {

        newModal() {
            this.editmode = false;
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
        },
        editModal(patent) {
            this.editmode = true;
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(patent);
        },
        loadPatents() {
            axios.get('api/patents')
                .then(response => {
                    this.patents = response.data;
                });
        },
        edit() {
            this.$Progress.start();

            this.form.put('api/patents/edit/' + this.form.id)
                .then(response => {
                    $('#addNew').modal('hide')
                    Swal.fire(
                        'Edited!',
                        'Your patent has been edited.',
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

            this.form.post('api/patents/create')
                .then(response => {
                    $('#addNew').modal('hide')

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Patent created',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$Progress.finish();
                    Fire.$emit('refresh');
                })
                .catch(error => {
                    toast({
                        type: 'error',
                        title: 'Patent not created',
                    })
                });
            this.$Progress.fail();
        },

        deletePatent(id) {
            this.currentPatent = null;
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
                    axios.delete('api/patents/delete/' + id)
                        .then(response => {
                            Swal.fire(
                                'Deleted!',
                                'Your patent has been deleted.',
                                'success'
                            )
                            Fire.$emit('refresh');
                        })
                        .catch(error => {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'There is a researcher and/or partner associated to this Patent!',
                            })
                        });
                }
            })
        }
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('api/findPatent?q=' + query)
                .then((response) => {
                    this.patents = response.data;
                })
                .catch(() => {

                })
        })
        this.loadPatents();
        Fire.$on('refresh', () => {
            this.loadPatents();
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
