
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/requirement_type/'
        // END OF GLOBAL VARIABLE

        // DATA TABLES FUNCTION
        function dataTable(){
                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "title"},
                    { data: "description"},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `<button class="btn btn-info btnView" id="${row.id}" data-value="${row.id}"><i class="fas fa-eye"></i></button>`;
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

        // CALLING DATATABLE FUNCTION
        dataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION


        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var form_url = BASE_API
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })

            //console.log(JSON.stringify(data))

            //ajax opening tag
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
                    console.log(data)
                    $("#createForm").trigger("reset")
                    $("#create_card").collapse("hide")
                    refresh();

                    notification("success", "New requirement type added")
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)

                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
                }
            //ajax closing tag
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
                    $('#title_view').html(data.title);
                    $('#description_view').html(data.description);
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
                    console.log(data)
                    $('#id_edit').val(data.id);
                    $('#title_edit').val(data.title);
                    $('#description_edit').val(data.description);

                    $('#editModal').modal('show');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)

                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
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
                "title": $('#title_edit').val(),
                "description": $('#description_edit').val()
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
                    refresh()
                    $('#editModal').modal('hide');

                    notification("info", "Requirement Type")
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)

                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
                }
            // ajax closing tag
            })


        });
        // END OF UPDATE FUNCTION

        // DEACTIVATE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
            var id = this.id;
            let form_url = BASE_API+id

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
                            url: BASE_API + 'destroy/' + id,
                            method: "DELETE",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },

                            success: function(data){
                                notification('error', '{{ $page_title }}')
                                refresh()
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
            // END OF DELETE CONFIRMATION SWAL
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
