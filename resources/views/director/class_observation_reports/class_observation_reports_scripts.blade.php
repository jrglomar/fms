
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/observation/'
        // END OF GLOBAL VARIABLE

        let class_sched_data = class_schedule_response.data
        
        // DATA TABLES FUNCTION
        function dataTable(){
                // FOR FOOTER GENERATE OF INPUT
                $('#dataTable tfoot th').each( function (i) {
                    var title = $('#dataTable thead th').eq( $(this).index() ).text();
                    $(this).html( '<input size="15" class="form-control" type="text" placeholder="'+title+'" data-index="'+i+'" />');
                } );

                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API, 
                    dataSrc: ""
                },'dom': 'Bfrtip',
                'buttons': {
                    dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                    },
                    buttons: [{
                        extend: 'pdfHtml5',  
                        text: 'Export as PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: ':visible', // CAN USE ALSO AN ARRAY OF COLUMN LIKE [ 1, 2, 3, 4, 5, 6, 8, 9 ]
                            modifier: { order: 'current' }
                        },
                        className: 'btn btn-primary mr-2',
                        titleAttr: 'PDF export.',
                        extension: '.pdf',
                        // download: 'open', // FOR NOT DOWNLOADING THE FILE AND OPEN IN NEW TAB
                        title: function() {
                            return "Class Observation Report"
                        },
                        filename: function() {
                            return "Class Observation Report"
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';
                        },
                    }, 
                    {
                        extend: 'excelHtml5',
                        className: 'btn btn-success',
                        titleAttr: 'Excel export.',
                        text: 'Export as XLS',
                        extension: '.xlsx',
                        exportOptions: {
                            columns: ':visible', // CAN USE ALSO AN ARRAY OF COLUMN LIKE [ 1, 2, 3, 4, 5, 6, 8, 9 ]
                            modifier: { order: 'current' }
                        },
                        filename: function() {
                            return "Class Observation Report"
                        },
                        title: function() {
                            return "Class Observation Report"
                        },
                    }]
                },
                // "data": class_sched_data,
                // "paging": true,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "class_schedule_id", render: function(data, row){
                        let row_data = class_sched_data.filter( row => row.id == data)
                        return row_data[0].faculty.full_name
                    }},
                    { data: "date_of_observation", render: function(data, type, row){
                        let class_schedule_id = row.class_schedule_id
                        let row_data = class_sched_data.filter( row => row.id == class_schedule_id)
                        return `${moment(data).format('LL')}, ${row_data[0].time}`
                    }},
                    { data: "status", render: function(data, type, row){
                        let status_html
                        if(data == 'Done'){
                            status_html = `<span class="badge badge-success">${data}</span>`
                        }
                        else if(data == 'Ongoing'){
                            status_html = `<span class="badge badge-info">${data}</span>`
                        }
                        else if(data == 'Cancelled'){
                            status_html = `<span class="badge badge-danger">${data}</span>`
                        }
                        else if(data == 'Pending'){
                            status_html = `<span class="badge badge-secondary">${data}</span>`
                        }
                        else{
                            status_html = data
                        }
                        return status_html
                    }},
                    { data: "date_of_observation" },
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 5] }],
                "order": [[1, "desc"]]
                })
                
                // Filter event handler
                $(dataTable.table().container() ).on( 'keyup', 'tfoot input', function () {
                    console.log(this.value)
                    console.log(dataTable)
                    dataTable
                        .column( $(this).data('index') )
                        .search( this.value )
                        .draw();
                });

                // Extend dataTables search
                $.fn.dataTable.ext.search.push(
                    function( settings, data, dataIndex ) {
                        var min  = $('#date_from').val();
                        var max  = $('#date_to').val();
                        var dateOfObs = data[5] // Our date column in the table
                        
                        if  ( 
                                ( min == "" || max == "" )
                                || 
                                ( moment(dateOfObs).isSameOrAfter(moment(min).format('YYYY-MM-DD' + ' 00:00:00')) && moment(dateOfObs).isSameOrBefore(moment(max).format('YYYY-MM-DD' + ' 23:59:59')) ) 
                            )
                        {
                            return true;
                        }
                        return false;
                    }
                );

                // Re-draw the table when the a date range filter changes
                $('.date-range-filter').change( function() {
                    dataTable.draw();
                });
        }
        // END OF DATATABLE FUNCTION

        $('.btnChangeStatus').on('change', function(){
            let checked = $('input[name="status_options"]:checked').val();
            console.log(checked)
            if(checked == 'All'){
                    dataTable
                        .column(4)
                        .search("")
                        .draw();
            }
            else if(checked == 'Pending'){
                dataTable
                        .column(4)
                        .search($(this).val())
                        .draw();
            }
            else if(checked == 'Ongoing'){
                dataTable
                        .column(4)
                        .search($(this).val())
                        .draw();
            }
            else if(checked == 'Cancelled'){
                dataTable
                        .column(4)
                        .search($(this).val())
                        .draw();
            }
            else if(checked == 'Done'){
                dataTable
                        .column(4)
                        .search($(this).val())
                        .draw();
            }
        })

        

        // CALLING DATATABLE FUNCTION
        dataTable()

        function activity_type(){

            activity_type_url = BASE_API
    
            $.ajax({
            url: activity_type_url,
            type: "GET",
            dataType: "JSON",

            success: function(data){

                console.log(data)
                

            }
            })
        }

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
            var class_schedule_id = $(this).attr('data-value')

            window.location.replace(APP_URL+"/director/class_observation/"+class_schedule_id +"/"+id);

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
