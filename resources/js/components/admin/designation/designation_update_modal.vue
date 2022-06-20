<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <a type="button" class="close" id="btnClose" data-dismiss="modal" data-toggle="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <form id="create_form" @submit.prevent="">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="required-input">Title</label>
                                    <input type="text" class="form-control" id="designation_title"
                                    v-model="designation_title" placeholder="Title" tabindex="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="required-input">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        v-model="description" placeholder="Description" tabindex="1" required>
                                </div>
                            </div>
                        </div>     
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <a type="button" class="btn btn-secondary" id="btnClose" data-dismiss="modal" data-toggle="modal">Close</a>
                        <button type="button" class="btn btn-primary" id="btnSave">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

$(function () {
    $('#btnSave').on('click', function (event) {
        alert('Saved');
        event.preventDefault();
        });

    $('#btnClose').on('click', function (event) {
        $("#exampleModal").modal('hide');
        event.preventDefault();
        });
    });


    export default {

        // ALL FUNCTIONS HERE AUTOMATICALLY RUNS WHEN MOUNTED
        mounted() {
            console.log('Designation Update modal mounted.')
        },

        // ALL DATA VARIABLES USED IN THIS COMPONENT
        data(){
            return {
                designation_title: '',
                description: '',
            }
        },


        // ALL FUNCTIONS USED IN THIS COMPONENT
        methods:{
            refresh(){
                var url = "http://127.0.0.1:8000/api/v1/designation/";
                this.activityTable.ajax.url(url).load();
            },

            addDesignation(){
                var self=this
                axios.post('http://127.0.0.1:8000/api/v1/designation',
                {
                    title: this.designation_title,
                    description: this.description,
                },
                {
                    headers: {
                        'Authorization': 'Bearer 4|73iiMLUidO7Zp59ot5ZbYydYtK4f2hBQYmsIAftf'
                    }
                })
                .then(function (response) {
                    console.log(response);
                    self.refresh();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
