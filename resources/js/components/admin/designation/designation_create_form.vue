<template>
        <div class="row">
            <div class="col-md-12 collapse" id="create_card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="text-dark"> <span id="create_card_title">Create</span> Designation</h4>
                    </div>
                    <form id="create_form" @submit.prevent="addDesignation()">
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
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary"
                                id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary ml-1" id="create_btn">Create <i
                                    class="fas fa-check"></i></button>
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
            console.log('Designation Create Form mounted.')
            this.dataTable();
        },

        // ALL DATA VARIABLES USED IN THIS COMPONENT
        data(){
            return {
                designation_title: '',
                description: '',
                // update_description: 'aw',
                // update_designation_title: 'aw',
                data: '',
            }
        },

        // ALL FUNCTIONS USED IN THIS COMPONENT
        methods:{
            dataTable(){
                this.activityTable = $('#designation_table').DataTable({
                "ajax": {url: "http://127.0.0.1:8000/api/v1/designation/",
                        dataSrc: ''},
                "columns": [
                    {data: "id"},
                    {data: "title"},
                    {data: "description"},
                    {data: "deleted_at", 
                    render: function(data, type, row){
                            if (data == null){
                                return '<div class="text-center dropdown">' +
                                            '<div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>' +
                                                '<div class="dropdown-menu dropdown-menu-right">' +
                                                    // View Designation
                                                    '<div class="dropdown-item d-flex btn_view" id="'+ row.id +'" role="button">' +
                                                        '<div style="width: 2rem"><i class="fas fa-eye"></i></div>' +
                                                        '<div>View Designation</div>' + 
                                                    '</div>' +
                                                    // Edit Designation
                                                    '<div class="dropdown-item d-flex btn_edit" id="'+ row.id +'" role="button" data-toggle="modal" data-target="#exampleModal">' +
                                                        '<div style="width: 2rem"><i class="fas fa-edit"></i></div>' +
                                                        '<div>Edit Designation</div>' +
                                                    '</div>' +
                                                    '<div class="dropdown-divider"</div></div>' +
                                                    // Delete Designation
                                                    '<button @click.prevent="deleteDesignation('+ row.id +')"> Delete Button </button>'
                                                    '<button type="button" class="dropdown-item d-flex btn_delete" id="'+ row.id +'" v-on:click="deleteDesignation('+ row.id +')">' +
                                                        '<div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>' +
                                                        '<div style="color: red"> Delete Designation</div>' +
                                                    '</button>' + 
                                                '</div>' +
                                        '</div>';
                            }
                            else{
                            return '<button class="btn btn-danger btn-sm">Activate</button>';
                            }
                        }
                    }
                    ],
            
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
                "order": [[1, "desc"]]
                })
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
            },

            deleteDesignation(id){
                alert(id);
            }
        }
    }

    
</script>
