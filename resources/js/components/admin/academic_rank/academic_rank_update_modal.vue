<template>
    <div class="modal fade" id="editing_modal">
        <div class="modal-dialog m-0" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update_form" @submit.prevent="">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        // ALL FUNCTIONS HERE AUTOMATICALLY RUNS WHEN MOUNTED
        mounted() {
            console.log('Designation Update modal mounted.')
            this.dataTable();
        },

        // ALL DATA VARIABLES USED IN THIS COMPONENT
        data(){
            return {
                designation_title: '',
                description: '',
            }
        },

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
</script>
