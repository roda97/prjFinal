<template>
<div class=container>
    <div class="form-group">
        Author: <input v-model="author" placeholder="Author's name">
        <br>
        New Post Title: ><input v-model="title" placeholder="Title">
        <br>
        Description: <input v-model="description" placeholder="Description" maxlength="90" size="90">
        <br>
        Choose an Image:
        <br>
        <input type="file" @change="onFileSelected" class="form-control-file">
    </div>
        <tinymce id="d1" :other_options="tinyOptions" v-model="editorContent"></tinymce>
        <button v-on:click="createPost">Create a new Post</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            new_img_path: '',
            author: '',
            title: '',
            description: '',
            editorContent: '<h2 style="color: #339966;">Hi there from TinyMCE for Vue.js.</h2> <p>&nbsp;</p> <p><span>Hey y`all.</span></p>',
            tinyOptions: {
                'height': 500
            },
        }
    },

    methods: {

        onFileSelected(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if (file['size'] < 2111775) {
                reader.onloadend = (file) => {
                    this.new_img_path = reader.result;
                }
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'You are uploading a large file!',
                })
            }
        },

        createPost: function (event) {
            if (tinyMCE.activeEditor.getContent() == '' ||
                this.title === undefined || this.author === undefined || this.description === undefined) {
                alert("Fields can't be empty!");
            } else {
                var text = tinyMCE.activeEditor.getContent();

                axios({
                        method: 'post',
                        url: 'api/news/createNew',
                        data: {
                            'author': this.author,
                            'title': this.title,
                            'text': tinyMCE.activeEditor.getContent(),
                            'description': this.description,
                            'new_img_path': this.new_img_path,
                        },
                    })

                    .then(function (response) {
                        Swal.fire({
                            type: 'success',
                            title: 'New post created!',
                            showConfirmButton: true,
                        })
                        window.location.href = "/news";
                    })

                    .catch(function (error) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                        console.log(error);
                    });
            }
        },
    }
}
</script>
