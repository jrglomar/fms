
<script>

    

    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/requirement_list_type/'

        let R_BIN_ID = "{{ $requirement_bin_id }}"
        // END OF GLOBAL VARIABLE

        $('#btnUpload').on('click', function(){
            swalAlert('warning', 'This feature is under maintenance')
        })

        $('#btnDone').on('click', function(){
            swalAlert('warning', 'This feature is under maintenance')
        })


        // FUNCTION TO CHANGE PAGE HEADER/TITLE
        function getRequirementBinDetails(){
            $.ajax({
                url: APP_URL+'/api/v1/requirement_bin/' + R_BIN_ID ,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    var title = responseData.title;
                    var deadline = responseData.deadline
                    var description = responseData.description

                    // let requiredDocumentList = `<li class="list-group-item d-flex justify-content-between" disabled>
                    //                                 <span class="text-primary"><strong>Document Type</strong></span>
                    //                             </li>`

                    // $.each(responseData.requirement_list_type, function(i){
                    //     let requiredDocumentTitle = responseData.requirement_list_type[i].requirement_type.title 
                    //     requiredDocumentList += `<li class="list-group-item d-flex justify-content-between align-items-center">
                    //                                 <span class="text-primary">${requiredDocumentTitle}</span>
                    //                             </li>`
                    // })

                    let requiredDocumentList = 'Required Document/s: '

                        $.each(responseData.requirement_list_type, function(i){
                            if(i < (responseData.requirement_list_type.length) - 1){
                                requiredDocumentList += responseData.requirement_list_type[i].requirement_type.title + ', '
                            }
                            else{
                                requiredDocumentList += responseData.requirement_list_type[i].requirement_type.title
                            }
                        })


                    $('#requiredDocumentList').html(requiredDocumentList)
                    $("#created_by").html(`${responseData.created_by_user.faculty.first_name} ${responseData.created_by_user.faculty.last_name}` );
                    $("#created_at").html(moment(responseData.deadline).format('LL'));
                    $("#title").html(title);
                    // $("#deadline").html("Deadline: " + deadline);
                    $("#description").html(description);
                },
                error: function ({ responseJSON }) {},
            });
        };

        getRequirementBinDetails();
        // END FUNCTION TO CHANGE PAGE HEADER/TITLE

        // DATA TABLES FUNCTION
        function dataTable(){
                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API+'search/' + R_BIN_ID, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "requirement_bin.title"},
                    { data: "requirement_type.title"},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                        <div>View Requirement List Type</div></div>
                                        <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                            <div>Edit Requirement List Type</div></div>
                                            <div class="dropdown-divider"</div></div>
                                            <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                            <div style="color: red">Delete Requirement List Type</div></div></div></div>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 2] }],
                "order": [[1, "desc"]]
                })
        }
        // END OF DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API+'search/' + R_BIN_ID;

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        // LOAD REQUIREMENT TYPES
        function loadRequirementTypes(){
            $.ajax({
                url: APP_URL+'/api/v1/requirement_type/',
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   

                    console.log(responseData)
                    let html = ""
                    $.each(responseData, function (i, dataOptions) 
                    {
                        console.log(responseData)
                        html +=
                            "<option value='" +
                            dataOptions.id +
                            "'>" +
                            dataOptions.title +
                            "</option>";

                        
                    });

                    $("#requirement_type_id").html(html);
                    $("#requirement_type_id_edit").html(html);
                    $("#requirement_type_id2").html(html);
                    $("#requirement_type_id_edit2").html(html);
                    
                },
                error: function ({ responseJSON }) {},
            });
        };

        loadRequirementTypes();
        // END LOAD REQUIREMENT TYPES

        $('#createRequiredDocument').on('click', function(){
            $('#createRequiredDocumentModal').modal('show')
        })

        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();


            document.getElementById('requirement_bin_id').value = R_BIN_ID;

            var form_url = BASE_API
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })

            var requirement_bin_id = R_BIN_ID
            var requirement_type_id = data.requirement_type_id


            $.ajax({
                url: BASE_API + 'search_existing/' + requirement_bin_id + '/' + requirement_type_id,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    if(responseData.length == 0)
                    {
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
                                notification('success', 'Required Document')
                                $("#createForm").trigger("reset")
                                $('#createRequiredDocumentModal').modal('hide')
                                setInterval(() => {
                                    location.reload()
                                }, 1000);
                            },
                            error: function(error){
                                console.log(error)
                                swalAlert('warning', error.responseJSON.message)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }
                        // ajax closing tag
                        })
                    }
                    else if (responseData.length > 0)
                    {
                        swalAlert('custom', 'The required document is already added.')
                    }        
                },
                error: function ({ responseJSON }) {},
            });
        });
        // END OF SUBMIT FUNCTION

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var id = this.id;
            let form_url = BASE_API + id

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
                    $('#requirement_bin_id_view').html(data.requirement_bin.title);
                    $('#requirement_type_id_view').html(data.requirement_type.title);
                    $('#created_at_view').html(created_at);

                    $('#viewModal').modal('show');
                }
            // ajax closing tag
            })
        });
        // END OF VIEW FUNCTION

        // EDIT FUNCTION
        $(document).on("click", ".btnEdit", function(){
            var id = this.id;
            let form_url = BASE_API + id

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
                    $('#requirement_bin_id_edit').val(data.requirement_bin_id);
                    $('#requirement_type_id_edit').val(data.requirement_type_id);

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
            var form_url = BASE_API + id

            let data = {
                "requirement_bin_id": $('#requirement_bin_id_edit').val(),
                "requirement_type_id": $('#requirement_type_id_edit').val(),
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
                    notification('info', 'Required Document')
                    refresh()
                    $('#editModal').modal('hide');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })


        });
        // END OF UPDATE FUNCTION

        // DEACTIVATE FUNCTION
        $(document).on("click", ".btnDeactivateRequiredDocument", function(){
            var id = this.id;
            let form_url = BASE_API + id

            // Swal.fire({
            //     icon: 'warning',
            //     text: 'This feature is still under development'
            // })

            console.log(id)

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    console.log(data)
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't able to remove this.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        confirmButtonText: "Yes, remove it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: BASE_API + 'destroy/' + data.id,
                                method: "DELETE",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },

                                success: function(data){
                                    notification('error', 'Required Document')
                                    setInterval(() => {
                                        location.reload()
                                    }, 1000);
                                },
                                error: function(error){
                                    console.log(error)
                                    swalAlert('warning', error.responseJSON.message)
                                    console.log(`message: ${error.responseJSON.message}`)
                                    console.log(`status: ${error.status}`)
                                }
                            // ajax closing tag
                            })
                        }
                    });
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
            var form_url = BASE_API + 'destroy/' + id
            console.log(id)

            $.ajax({
                url: form_url,
                method: "DELETE",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    notification('error', 'Required Document')
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
        });
        // END OF ACTIVATE FUNCTION

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
