
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity/'
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
                    { data: "activity_type.title"},
                    { data: "description"},
                    { data: "status"},
                    { data: "start_datetime", render: function(data, row){
                        return `${moment(data).format('LLL')} - ${moment(row.end_datetime).format('LLL')}` 
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                        <div>View activity type</div></div>
                                        <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                            <div>Edit activity type</div></div>
                                            <div class="dropdown-divider"</div></div>
                                            <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                            <div style="color: red">Delete activity type</div></div></div></div>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 4] }],
                "order": [[1, "desc"]]
                })
        }
        // END OF DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        // ACTIVITY TYPE FUNCTION
        function activity_type(){

            activity_type_url = APP_URL+'/api/v1/activity_type/'
    
            $.ajax({
            url: activity_type_url,
            type: "GET",
            dataType: "JSON",

            success: function(data){

                var html = ""

                for(var i=0; i < data.length; i++){
                html += `<option value="${data[i].id}">${data[i].title}</option>`
                }
                
                $('#activity_type_id').html(html);
                $('#activity_type_id_edit').html(html);
                //$('#busTypeEdit').html(html);

            }
            })
        }
        // END OF ACTIVITY TYPE FUNCTION

        // CALLING ACTIVITY TYPE FUNCTION
        activity_type()

        $('#status').change(function(){
            if(this.value == "Pending" || "Ongoing" || "Ended") {
                html = '<div class="form-group col-md-6 additional-input">' +
                            '<label class="required-input">Start time</label>' +
                            '<input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"' +
                            'tabindex="1" required>' +
                        '</div>' +
                        '<div class="form-group col-md-6 additional-input">' +
                            '<label class="required-input">End time</label>' +
                            '<input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"' +
                            'tabindex="1" required>' +
                        '</div>'

                $('.additional-form').html(html);
            }
            else{
                $(".additional-input").remove()
            }
        });

        $('#status_edit').change(function(){
            if(this.value == "Pending" || "Ongoing" || "Ended") {
                html = '<div class="form-group col-md-6 additional-input">' +
                            '<label class="required-input">Start time</label>' +
                            '<input type="datetime-local" class="form-control" id="start_datetime_edit" name="start_datetime_edit"' +
                            'tabindex="1" required>' +
                        '</div>' +
                        '<div class="form-group col-md-6 additional-input">' +
                            '<label class="required-input">End time</label>' +
                            '<input type="datetime-local" class="form-control" id="end_datetime_edit" name="end_datetime_edit"' +
                            'tabindex="1" required>' +
                        '</div>'

                $('.additional-form-edit').html(html);
            }
            else{
                $(".additional-input-edit").remove()
            }
        });
        
        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION


        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var fd = new FormData();
            var files = $('#memorandum_file_directory')[0].files[0]
            var form = $("#createForm").serializeArray();
            let data = {}

            fd.append('file', files)

            var form_url = BASE_API +'upload'

            console.log(fd)

            if (files == null){
                form_url = BASE_API

                    var form = $("#createForm").serializeArray();
                    let formdata = {}

                    $.each(form, function(){
                        formdata[[this.name]] = this.value;
                    })

                    console.log(formdata)

                    //ajax opening tag
                    $.ajax({
                        url: form_url,
                        method: "POST",
                        data: JSON.stringify(formdata),
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
                        },
                        error: function(error){
                            console.log(error)
                            console.log(`message: ${error.responseJSON.message}`)
                            console.log(`status: ${error.status}`)
                        }
                    //ajax closing tag
                    })
            }

            else{
                $.ajax({
                    url: form_url,
                    method: "POST",
                    data: fd,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        
                    },
                    success: function(data){
                        //console.log(data)
                        form_url = BASE_API

                        var form = $("#createForm").serializeArray();
                        let formdata = {}

                        formdata['memorandum_file_directory'] = data.path

                        $.each(form, function(){
                            formdata[[this.name]] = this.value;
                        })

                        console.log(formdata)

                        //ajax opening tag
                        $.ajax({
                            url: form_url,
                            method: "POST",
                            data: JSON.stringify(formdata),
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
                            },
                            error: function(error){
                                console.log(error)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }
                        //ajax closing tag
                        })
                    },
                    error: function(error){
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }
                })
            }
            
        });
        // END OF SUBMIT FUNCTION

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var id = this.id;

            window.location.replace(APP_URL+"/acad_head/activity_view/"+id);

            //let form_url =BASE_API+id

            // $.ajax({
            //     url: form_url,
            //     method: "GET",
            //     headers: {
            //         "Accept": "application/json",
            //         "Authorization": API_TOKEN,
            //         "Content-Type": "application/json"
            //     },

            //     success: function(data){
            //         let created_at = moment(data.created_at).format('LLL');
            //         let status = (data.deleted_at === null) ? 'Active' : 'Inactive';
            //         let is_required_view = ""

            //         $('#id_view').html(data.id);
            //         $('#title_view').html(data.title);
            //         $('#description_view').html(data.description);
            //         $('#start_time_view').html(data.start_datetime);
            //         $('#end_time_view').html(data.end_datetime);
            //         $('#activity_type_view').html(data.activity_type.title); 
            //         console.log(data.activity_type)  

            //         if(data.is_required == 0){
            //             is_required_view = "No"
            //         } else{
            //             is_required_view = "Yes"
            //         }

            //         $('#status_view').html(data.status);
            //         $('#is_required_view').html(is_required_view);
            //         //$('#created_at_view').html(created_at);

            //         //console.log(data.memorandum_file_directory)
            //         document.getElementById("memorandum_view").src="http://127.0.0.1:8000/" + data.memorandum_file_directory;
            //         //$('#memorandum_view').src("{{ asset('" + data.memorandum_file_directory + "') }}")

            //         $('#viewModal').modal('show');
            //     }
            // // ajax closing tag
            // })
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
                    $('#activity_type_id_edit').val(data.activity_type.id);
                    //console.log(data.activity_type.id)
                    
                    $('#status_edit').val(data.status);

                    $('#is_required_edit').val(data.is_required);
                    $('#location_edit').val(data.location);
                    $('#memorandum_path').val(data.memorandum_file_directory);
                    //console.log(data.is_required)

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

            var memo_path = $('#memorandum_path').val()

            var new_memo_path = ""

            if($('#memorandum_file_directory_edit')[0].files[0] == null){
                new_memo_path = $('#memorandum_path').val()

                var id = $('#id_edit').val();

                var form_url = BASE_API+id

                let data_form = {
                    "title": $('#title_edit').val(),
                    "description": $('#description_edit').val(),
                    "location": $('#location_edit').val(),
                    "activity_type_id": $('#activity_type_id_edit').val(),
                    "status": $('#status_edit').val(),
                    "is_required": $('#is_required_edit').val(),
                    "memorandum_file_directory": new_memo_path
                }

                console.log(data_form)

                $.ajax({
                    url: form_url,
                    method: "PUT",
                    data: JSON.stringify(data_form),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },

                    success: function(data){
                        refresh()
                        $('#editModal').modal('hide');
                    },
                    error: function(error){
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }

                })
            }
            else{

                let form_url =BASE_API+'replace'

                var fd = new FormData();
                var files = $('#memorandum_file_directory_edit')[0].files[0]

                fd.append('file', files)
                fd.append('old_file', memo_path)

                $.ajax({
                    url: form_url,
                    method: "POST",
                    data: fd,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        
                    },
                    success: function(data){
                        //console.log(data)
                        new_memo_path = data.path
                        console.log(new_memo_path)

                        var id = $('#id_edit').val();

                        var form_url = BASE_API+id

                        let data_form = {
                            "title": $('#title_edit').val(),
                            "description": $('#description_edit').val(),
                            "location": $('#location_edit').val(),
                            "activity_type_id": $('#activity_type_id_edit').val(),
                            "status": $('#status_edit').val(),
                            "is_required": $('#is_required_edit').val(),
                            "memorandum_file_directory": new_memo_path
                        }
                        
                        console.log(data_form)

                        $.ajax({
                            url: form_url,
                            method: "PUT",
                            data: JSON.stringify(data_form),
                            dataType: "JSON",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },

                            success: function(data){
                                refresh()
                                $('#editModal').modal('hide');
                            },
                            error: function(error){
                                console.log(error)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }

                        })
                    }
                })
            }

            
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
                    $('#title_delete').html(data.title);
                    $('#description_delete').html(data.description);

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
            var form_url = APP_URL+'/api/v1/activity/destroy/'+id

            $.ajax({
                url: form_url,
                method: "DELETE",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    refresh()
                    $('#deactivateModal').modal('hide');
                },
                error: function(error){
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