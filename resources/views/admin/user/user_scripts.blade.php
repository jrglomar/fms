
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/user/'
        // END OF GLOBAL VARIABLE

        // DATA TABLES FUNCTION
        function dataTable(){
                dataTable = $('#dataTable').DataTable({
                "ajax": { url: BASE_API + 'datatable'},
                "processing": true,
                "serverSide": true,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "email"},
                    { data: "user_role", render: function(data, type, row){
                        let user_role = ''

                        $.each(data, function(i){
                            if(i < (data.length) - 1){
                                user_role += data[i].role.title + ', '
                            }
                            else{
                                user_role += data[i].role.title
                            }
                        })

                        return user_role;
                    }},
                    { data: "status", render: function(data, type, row){
                        if(data == 'Inactive'){
                            return `</div>
                                        <span class="badge badge-warning" id="${row.id}">
                                        <div>Inactive</div>
                                    </span>`
                        }
                        else{
                            return `</div>
                                        <span class="badge badge-success" id="${row.id}">
                                        <div>Active</div>
                                    </sp>`
                        }
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                            if (data == null){
                                return `
                                    <div class="text-center dropdown">
                                        <div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-item d-flex btnViewDetails" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                            <div>View</div></div>
                                            <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                                <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                                <div>Edit</div></div>
                                                <div class="dropdown-divider"</div></div>
                                                <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                                <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                                <div style="color: red">Delete</div>
                                            </div>
                                    </div>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                        }
                    }
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[2, "desc"]]
                })
        }
        // END OF DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API + 'datatable';

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        // REFRESH DATATABLE FUNCTION
        $(document).on("click", ".btnViewDetails", function(){
            var id = this.id
            console.log(id)

            window.location.href = APP_URL+'/admin/user/'+id
        });
        // REFRESH DATATABLE FUNCTION


        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var form_url = APP_URL+'/api/v1/register/'
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
                    notification('success', 'User')
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

                    $('#id_view').html(data.id);
                    $('#email_view').html(data.email);
                    $('#created_at_view').html(created_at);
                    $('#status_view').html(data.status);

                    $('#viewModal').modal('show');
                },
                error: function(error){
                    swalAlert('warning', error.responseJSON.message)
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
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
                    $('#email_edit').val(data.email);

                    $('#editModal').modal('show');
                },
                error: function(error){
                    swalAlert('warning', error.responseJSON.message)
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
                "email": $('#email_edit').val()
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
                    notification('info', 'User')
                    refresh()
                    $('#editModal').modal('hide');
                },
                error: function(error){
                    swalAlert('warning', error.responseJSON.message)
                    console.log(error)
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
                    swalAlert('warning', error.responseJSON.message)
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
                    notification('error', 'User')
                    refresh()
                    $('#deactivateModal').modal('hide');
                },
                error: function(error){
                    swalAlert('warning', error.responseJSON.message)
                    console.log(error)
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

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
