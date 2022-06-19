<template>
    <div class="row">
            <div class="col-md-12 collapse" id="create_card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="text-dark"> <span id="create_card_title">Create</span> User</h4>
                    </div>

                    <form id="create_form" @submit.prevent="addUser()">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required-input">Email</label>
                                    <input type="email" class="form-control" id="email"
                                    v-model="user.email" placeholder="Email" tabindex="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required-input">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                    v-model="user.password"   placeholder="Password" tabindex="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="required-input">Password Confirmation</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                    v-model="user.password_confirmation"   placeholder="Password Confirmation" tabindex="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#create_card"
                                id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                            <button type="submit" class="btn btn-primary ml-1" id="create_btn">Create<i
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
            console.log('User Create Form mounted.')
            this.dataTable();
        },

        // ALL DATA VARIABLES USED IN THIS COMPONENT
        data(){
            return {
                user: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            }
        },

        // ALL FUNCTIONS USED IN THIS COMPONENT
        methods:{
            btnView(){
                console.log('test')
            },

            dataTable(){
                this.userTable = $('#user_table').DataTable().destroy()
                this.userTable = $('#user_table').DataTable({
                "ajax": {url: "http://127.0.0.1:8000/api/v1/user/",
                dataSrc: ''},
                "columns": [
                    {data: "id"},
                    {data: "created_at"},
                    {data: "email"},
                    {data: "deleted_at", render: function(data, type, row){
                            if (data == null){
                                return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item d-flex btn_view" @click="btnView" id="${row.id}" role="button">
                                    <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                    <div>View Category</div></div>
                                    <div class="dropdown-item d-flex btn_edit" id="'${row.id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                        <div>Edit Category</div></div>
                                        <div class="dropdown-divider"</div></div>
                                        <div class="dropdown-item d-flex btn_delete" id="'${row.id}'" role="button">
                                        <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                        <div style="color: red">Delete Category</div></div></div></div>`;
                            }
                            else{
                            return '<button class="btn btn-danger btn-sm">Activate</button>';
                            }
                        }
                    }
                    ],

                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]]
                })
            },

            refresh(){
                var url = "http://127.0.0.1:8000/api/v1/user/";

                this.userTable.ajax.url(url).load();
            },

            addUser(){
                var self=this
                axios.post('http://127.0.0.1:8000/api/v1/register',
                {
                    email: this.user.email,
                    password: this.user.password,
                    password_confirmation: this.user.password_confirmation
                },
                {
                    headers: {
                        'Authorization': 'Bearer 2|nVkSmClRgy7Ax9Tzl3KyXzdnh9CnSMA4VLkFn2di'
                    }
                })
                .then(function (response) {
                    this.user.email = "";
                    this.user.password = "";
                    this.user.password_confirmation = "";
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
