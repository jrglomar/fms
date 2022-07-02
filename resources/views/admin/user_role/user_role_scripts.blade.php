
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/user_role/'
        // END OF GLOBAL VARIABLE

        // DATA TABLES FUNCTION
        function dataTable(){
                dataTable = $('#dataTable').DataTable({
                "ajax": {url: BASE_API, dataSrc: ''},
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "user.email"},
                    { data: "role.title"},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                        <div>View</div></div>
                                        <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                            <div>Edit</div></div>
                                            <div class="dropdown-divider"</div></div>
                                            <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                            <div style="color: red">Delete</div></div></div></div>`;
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
        }
        // END OF DATATABLE FUNCTION

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        // GET LIST OF USER DATATABLE FUNCTION
        function getUserList(){
            var form_url = APP_URL+'/api/v1/user';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    let user_id_select = '<option disabled selected>List of user/s</option>'
                    $.each(data, function (i){
                        user_id_select += `<option value="${data[i].id}">${data[i].email}</option>`
                    })

                    $('#user_id').html(user_id_select)
                    $('#user_id_edit').html(user_id_select)
                },
                error: function(error){
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        }
        // GET LIST OF USER DATATABLE FUNCTION

        // GET LIST OF ROLE DATATABLE FUNCTION
        function getRoleList(){
            var form_url = APP_URL+'/api/v1/role';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    let role_id_select = '<option disabled selected>List of role/s</option>'
                    $.each(data, function (i){
                        role_id_select += `<option value="${data[i].id}">${data[i].title}</option>`
                    })

                    $('#role_id').html(role_id_select)
                    $('#role_id_edit').html(role_id_select)
                },
                error: function(error){
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        }
        // GET LIST OF ROLE DATATABLE FUNCTION


        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var form_url = BASE_API
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })

            // ajax opening tag
            $.ajax({
                url: form_url,
                method: "POST",
                data: JSON.stringify(data),
                dataType: "JSON",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data){
                    notification('success', 'User Role')
                    $("#createForm").trigger("reset")
                    $("#create_card").collapse("hide")
                    refresh();
                },
                error: function(error){
                    console.log(error)
                    swalAlert('warning', error.responseJSON.message)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF SUBMIT FUNCTION

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var id = this.id;
            let form_url = BASE_API+id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    let created_at = moment(data.created_at).format('LLL');
                    let status = (data.deleted_at === null) ? 'Active' : 'Inactive';

                    $('#id_view').html(data.id);
                    $('#user_id_view').html(data.user.email);
                    $('#role_id_view').html(data.role.title);
                    $('#created_at_view').html(created_at);
                    $('#status_view').html(status);

                    $('#viewModal').modal('show');
                }
            // ajax closing tag
            })
        });
        // END OF VIEW FUNCTION

        // EDIT FUNCTION
        $(document).on("click", ".btnEdit", function(){
            var id = this.id;
            let form_url = BASE_API+id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    $('#id_edit').val(data.id);
                    $('#user_id_edit').val(data.user_id);
                    $('#role_id_edit').val(data.role_id);


                    $('#user_id_edit').select2();
                    $('#role_id_edit').select2();

                    $('#editModal').modal('show');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF EDIT FUNCTION

        // UPDATE FUNCTION
        $('#updateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_edit').val();
            var form_url = BASE_API+id

            let data = {
                "user_id": $('#user_id_edit').val(),
                "role_id": $('#role_id_edit').val()
            }

            $.ajax({
                url: form_url,
                method: "PUT",
                data: JSON.stringify(data),
                dataType: "JSON",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    notification('info', 'User Role')
                    refresh()
                    $('#editModal').modal('hide');
                },
                error: function(error){
                    console.log(error)
                    swalAlert('warning', error.responseJSON.message)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })

        });
        // END OF UPDATE FUNCTION

        // DEACTIVATE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
            var id = this.id;
            let form_url = BASE_API+id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    $('#id_delete').val(data.id);
                    $('#email_delete').html(data.email);

                    $('#deactivateModal').modal('show');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF DEACTIVATE FUNCTION

        // DEACTIVATE SUBMIT FUNCTION
        $('#deactivateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_delete').val();
            var form_url = BASE_API+'destroy/'+id

            $.ajax({
                url: form_url,
                method: "DELETE",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    notification('error', 'User Role')
                    refresh()
                    $('#deactivateModal').modal('hide');
                },
                error: function(error){
                    console.log(error)
                    swalAlert('warning', error.responseJSON.message)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF DEACTIVATE SUBMIT FUNCTION

        // ACTIVATE FUNCTION
        $(document).on("click", ".btnActivate", function(){
            var id = this.id;
            console.log(id)
        });
        // END OF ACTIVATE FUNCTION

    // END OF JQUERY FUNCTIONS

        // CALLING DATATABLE FUNCTION
        dataTable()
        getUserList()
        getRoleList()
        removeLoader()
    });
</script>
