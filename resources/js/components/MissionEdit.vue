<template>
<div class=container>
    <h1>Editing Front Page Mission Text</h1>
    <!--<tinymce id="d1" :other_options="tinyOptions" v-model="editorContent"></tinymce>-->
    <!--<input id="text_box" v-model="this.text">-->
    <textarea v-model="text" class=text_area cols="60" rows="8"> {{ this.text }} </textarea>
    <button v-on:click="updateMission">Edit Mission Text</button>
</div>
</template>

<script>
export default {
    data() {
        return {
            text: '',
            author: '',
            title: '',
            editorContent: '',
            tinyOptions: {
                'height': 500
            },
        }
    },

    methods: {
        getMission(id) {
            axios.get('api/mission/getMission/' + id)
                .then(response => {
                    console.log("Response: " + response.data.text);
                   /* this.editorContent = response.data.text;
                    tinyMCE.activeEditor.insertContent(response.data.text); */
                    this.text = response.data.text;

                });
        },

        updateMission() {
            axios({
                    method: 'put',
                    url: 'api/mission/edit/' + 1,
                    data: {
                        //'text': this.editorContent,
                       // 'text': tinyMCE.activeEditor.getContent(),
                       'text': this.text,
                    },

                }).then(function (response) {

                    Swal.fire({
                        type: 'success',
                        title: 'Mission text Updated!',
                        showConfirmButton: true,
                    })
                    window.location.href = "/home";
                })

                .catch(function (error) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Text cannot be empty!',
                    })
                    console.log(error);
                });
        },
    },

    created() {
        this.getMission(1);
    },
}
</script>

<style>
.text_area {width:80%;height:300px;border: 1px dotted #000099;}
</style>
