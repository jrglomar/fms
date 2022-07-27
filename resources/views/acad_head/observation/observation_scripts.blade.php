
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity/'
        // END OF GLOBAL VARIABLE

        let class_sched_data = class_schedule_response.data
        console.log(class_sched_data)


        // DATA TABLES FUNCTION
        function dataTable(){
                $('#dataTable tfoot th').each( function (i) {
                    var title = $('#dataTable thead th').eq( $(this).index() ).text();
                    console.log(title)
                    $(this).html( '<input size="15" class="form-control" type="text" placeholder="'+title+'" data-index="'+i+'" />');
                } );

                dataTable = $('#dataTable').DataTable({
                // "ajax": {
                //     url: BASE_API, 
                //     dataSrc: ""
                // },
                "data": class_sched_data,
                // "paging": true,
                // "searching": false,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "faculty", render: function(data, row){
                        let img = `<img class="mr-2 rounded-circle" width="20" height="20" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png">`
                        if(data.image !=null){
                            img = `<img class="mr-2 rounded-circle" width="20" height="20"  src="${APP_URL + '/' + data.image}">`
                        }
                        return `${img}` + data.first_name + ' ' + data.last_name;
                    }},
                    { data: "assignment_code", render: function(data, row){
                        return `<p class="ml-4">${data}</p>`
                    }},
                    { data: "subject_code"},
                    { data: "subject_offering.curriculum_subject.subject.title"},
                    { data: "subject_offering.curriculum_subject.subject.units"},
                    { data: "subject_offering.section.name"},
                    { data: "room.room_building"},
                    { data: "start_time", render: function(data, type, row){
                        return `${row.day} - ${moment('2022-08-05' + ' ' + row.start_time).format('LT')} - ${moment('2022-08-05' + ' ' + row.end_time).format('LT')}` 
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `
                                            <button class="btn btn-info btnView" id="${row.id}"><i class="fas fa-eye"></i></button>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0,1] }],
                "order": [[1, "desc"]]
                })

                // Filter event handler
                $(dataTable.table().container() ).on( 'keyup', 'tfoot input', function () {
                    dataTable
                        .column( $(this).data('index') )
                        .search( this.value )
                        .draw();
                });
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
                            'tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:00:00"); }}" data-parsley-excluded="true">' +
                        '</div>' +
                        '<div class="form-group col-md-6 additional-input">' +
                            '<label class="required-input">End time</label>' +
                            '<input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"' +
                            'tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:01:00"); }}" data-parsley-excluded="true">' +
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
                            'tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:01:00"); }}" required> data-parsley-excluded="true"' +
                        '</div>' +
                        '<div class="form-group col-md-6 additional-input">' +
                            '<label class="required-input">End time</label>' +
                            'tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:01:00"); }}" data-parsley-excluded="true"' +
                            'tabindex="1">' +
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


        $("#memo_upload").dropzone({ 
            url: BASE_API +'upload',
            acceptedFiles: 'image/*, .pdf',
            maxFiles: 1,
            addRemoveLinks: true,
            autoProcessQueue: false,
            // renameFile: function (file) {
            //     let file_name = file.name.substr(0, file.name.lastIndexOf('.')) || file.name;
            //     file_name = file_name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');

            //     ext = file.name.substring(file.name.lastIndexOf('.') + 1).toLowerCase();

            //     return file_name + '_' + FACULTY_LAST_NAME + '_' + new Date().getTime() + '.' + ext;
            // },
            init: function () {

                var myDropzone = this;

                // Update selector to match your button

                $('#createForm').on('submit', function(e){

                    e.preventDefault()

                   // myDropzone.processQueue();

                    if (myDropzone.getQueuedFiles().length === 0){

                    form_url_no_memo = BASE_API

                    let data_form = {
                        "title": $('#title').val(),
                        "description": $('#description').val(),
                        "location": $('#location').val(),
                        "start_datetime": $('#start_datetime').val(),
                        "end_datetime": $('#end_datetime').val(),
                        "activity_type_id": $('#activity_type_id').val(),
                        "status": $('#status').val(),
                        "is_required": $('#is_required').val(),
                        "memorandum_file_directory": "NA"
                    }

                    console.log(data_form)
                        if($('#start_datetime').val() > "{{ date('Y-m-d 00:00:00'); }}" && $('#end_datetime').val() > "{{ date('Y-m-d 00:01:00'); }}" ){
                            //ajax opening tag
                            $.ajax({
                                url: form_url_no_memo,
                                method: "POST",
                                data: JSON.stringify(data_form),
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

                                    notification("success", "Activity")
                                },
                                error: function(error){
                                    $.each(error.responseJSON.errors, function(key,value) {
                                        swalAlert('warning', value)
                                    });
                                    console.log(error)
                                    console.log(`message: ${error.responseJSON.message}`)
                                    console.log(`status: ${error.status}`)
                                }
                            //ajax closing tag
                            })
                        }
                        else{
                            swalAlert('warning', 'Invalid datetime')
                        }
                    }
                    else{
                        //console.log(myDropzone)
                        myDropzone.processQueue();
                    }
                })
                
            },

            success: function(response, data){
            
                //console.log(data)
                form_url = BASE_API

                var form = $("#createForm").serializeArray();
                let formdata = {}

                formdata['memorandum_file_directory'] = data.path

                $.each(form, function(){
                    formdata[[this.name]] = this.value;
                })

                console.log(formdata)

                if($('#start_datetime').val() > "{{ date('Y-m-d 00:00:00'); }}" && $('#end_datetime').val() > "{{ date('Y-m-d 00:01:00'); }}" ){
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

                            notification("success", "Activity")
                        },
                        error: function(error){
                            $.each(error.responseJSON.errors, function(key,value) {
                                swalAlert('warning', value)
                            });
                            console.log(error)
                            console.log(`message: ${error.responseJSON.message}`)
                            console.log(`status: ${error.status}`)
                        }
                    //ajax closing tag
                    })
                }
                else{
                    swalAlert('warning', 'Invalid datetime')
                }

            },
        });


        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var id = this.id;

            window.location.replace(APP_URL+"/acad_head/schedule/"+id);

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
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
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

                if($('#start_datetime_edit').val() > "{{ date('Y-m-d 00:00:00'); }}" && $('#end_datetime_edit').val() > "{{ date('Y-m-d 00:00:01'); }}" ){
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

                            notification("info", "Activity")
                        },
                        error: function(error){
                            $.each(error.responseJSON.errors, function(key,value) {
                                swalAlert('warning', value)
                            });
                            console.log(error)
                            console.log(`message: ${error.responseJSON.message}`)
                            console.log(`status: ${error.status}`)
                        }

                    })
                }
                else{
                    swalAlert('warning', 'Invalid datetime')
                }
                
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

                                notification("info", "Activity")
                            },
                            error: function(error){
                                $.each(error.responseJSON.errors, function(key,value) {
                                    swalAlert('warning', value)
                                });
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

        // DELETE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
            var id = this.id;
            let form_url = BASE_API + id
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
                                    notification('error', 'Activity')
                                    refresh();
                                },
                                error: function(error){
                                    $.each(error.responseJSON.errors, function(key,value) {
                                        swalAlert('warning', value)
                                    });
                                    console.log(error)
                                    console.log(`message: ${error.responseJSON.message}`)
                                    console.log(`status: ${error.status}`)
                                }
                            // ajax closing tag
                            })
                        }
                    });
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END DELETE FUNCTION

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

                    notification("error", "Activity")
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
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

        // ACTIVATE FUNCTION
        $(document).on("click", ".btnSetObservation", function(){
            var id = this.id;
            console.log(id)

            
        });
        // END OF ACTIVATE FUNCTION

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
