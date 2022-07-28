
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity_view/'
        var ATTENDANCE_API = APP_URL + '/api/v1/activity_attendance/'
        var ACTIVITY_ID = "{{$activity_id}}"
        // END OF GLOBAL VARIABLE

        removeLoader()
        
        function getActivity(){
            $.ajax({
                url: APP_URL+"/api/v1/activity/"+ACTIVITY_ID,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    date = moment(new Date).format()

                    var activity_status = data.status

                    var start_date_hours = new Date(data.start_datetime).getHours();
                    var start_date_mins = new Date(data.start_datetime).getMinutes();
                    if (start_date_hours < 10)
                    {
                        start_date_hours = "0"+start_date_hours
                    }
                    if (start_date_mins < 10)
                    {
                        start_date_mins = "0"+start_date_mins
                    }

                    var end_date_hours = new Date(data.end_datetime).getHours();
                    var end_date_mins = new Date(data.end_datetime).getMinutes();
                    if (end_date_hours < 10)
                    {
                        end_date_hours = "0"+end_date_hours
                    }
                    if (end_date_mins < 10)
                    {
                        end_date_mins = "0"+end_date_mins
                    }

                    var current_time = new Date(); // current time
                    var hours = current_time.getHours();
                    var mins = current_time.getMinutes();
                    if (hours < 10)
                    {
                        hours = "0"+hours
                    }
                    if (mins < 10)
                    {
                        mins = "0"+mins
                    }
      
                    var moment_current_date = moment(current_time).format('L')
                    var moment_start_date = moment(data.start_datetime).format('L');
                    var moment_end_date = moment(data.end_datetime).format('L');


                    var now = hours+":"+mins+":00";
                    var start_time = start_date_hours + ":" + start_date_mins + ":00"
                    var end_time = end_date_hours + ":" + end_date_mins + ":00"

                    console.log("Moment Current Date: " + moment_current_date)
                    console.log("Moment Start Date: " + moment_start_date)
                    console.log("Moment End Date: " + moment_end_date)
                    console.log("Now: " + now)
                    console.log("Start Time: " + start_time)
                    console.log("End Time: " + end_time)

                    if(activity_status == "Done" || activity_status == "done")
                    {
                        $.ajax({
                            url: APP_URL + "/api/v1/activity_attendance/faculty_list_time_out_null/" + ACTIVITY_ID,
                            type: "GET",
                            dataType: "JSON",
                            success: function (responseData) 
                            {  
                                if (responseData.length != 0)
                                {
                                    $.each(responseData, function (i, dataOptions) 
                                    {
                                        var time_in = responseData[i].time_in
                                        var time_out = responseData[i].time_out
                                        var attendance_status = responseData[i].attendance_status
                                        var remarks = responseData[i].remarks
                                        var status = responseData[i].status
                                        var proof_of_attendance_file_link = responseData[i].proof_of_attendance_file_link
                                        var faculty_id = responseData[i].faculty_id
                                        var activity_id = responseData[i].activity_id
                                        var id = responseData[i].id

                                        $.ajax(
                                        {
                                            url: APP_URL + '/api/v1/activity_attendance/' + id,
                                            type: "PUT",
                                            data: JSON.stringify(
                                            {		
                                                "time_in": time_in,
                                                "time_out": time_out,
                                                "attendance_status": "Absent",
                                                "remarks": remarks,
                                                "status": status,
                                                "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                                "faculty_id": faculty_id,
                                                "activity_id": activity_id,
                                            }),
                                            dataType: "JSON",
                                            contentType: 'application/json',
                                            processData: false,
                                            cache: false,
                                            success: function (responseJSON) 
                                            {     
                                                refresh();       
                                            },
                                            error: function(error){
                                                $.each(error.responseJSON.errors, function(key,value) {
                                                    swalAlert('warning', value)
                                                });
                                                console.log(error)
                                                console.log(`message: ${error.responseJSON.message}`)
                                                console.log(`status: ${error.status}`)
                                            },
                                        });
                                    });
                                }
                                else
                                {
                                    refresh();
                                }
                            }
                        });
                        refresh();
                    }
                    else if(activity_status == "On Going")
                    {
                        if(moment_current_date > moment_end_date)
                        {
                            let data_data = {
                                "title": data.title,
                                "activity_type_id": data.activity_type_id,
                                "description": data.description,
                                "agenda": data.agenda,
                                "location": data.location,
                                "date": data.date,
                                "start_datetime": data.start_datetime,
                                "end_datetime": data.end_datetime,
                                "memorandum_file_directory": data.memorandum_file_directory,
                                "is_required": data.is_required,
                                "status": "Done",
                            }
                            $.ajax({
                                url: APP_URL+"/api/v1/activity/"+ACTIVITY_ID,
                                method: "PUT",
                                data: JSON.stringify(data_data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"      
                                },
                                success: function(data)
                                {
                                    
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
                        if(moment_current_date == moment_end_date && now > end_time)
                        {                   
                                  
                            let data_data = {
                                "title": data.title,
                                "activity_type_id": data.activity_type_id,
                                "description": data.description,
                                "agenda": data.agenda,
                                "location": data.location,
                                "start_datetime": data.start_datetime,
                                "end_datetime": data.end_datetime,
                                "memorandum_file_directory": data.memorandum_file_directory,
                                "is_required": data.is_required,
                                "status": "Done",
                            }
                            console.log("Here")
                            console.log(data_data)
                            $.ajax({
                                url: APP_URL+"/api/v1/activity/"+ACTIVITY_ID,
                                method: "PUT",
                                data: JSON.stringify(data_data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data)
                                {
                                    
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
                    }

                    let created_at = moment(data.created_at).format('LLL');
                    let status = (data.deleted_at === null) ? 'Active' : 'Inactive';
                    let is_required_view = ""
                    
                    var hero_body = "";

                    if(data.activity_type.category == "Activity")
                    {
                        hero_body = '<span><b>Description: </b>' +
                                    '<span class="" style="white-space: pre-line; text-align: justify; display:block;" id="description">' +
                                        data.description +
                                    '</span>';
                    }
                    else if (data.activity_type.category == "Meeting")
                    {
                        var agenda = data.agenda;

                        console.log(data)

                        if(agenda == null)
                        {
                            agenda = "No agenda given"
                        }
                        else
                        {
                            agenda = data.agenda;
                        }
                        hero_body = '<span><b>Agenda: </b>' +
                                    '<span class="" style="white-space: pre-line; text-align: justify; display:block;" id="agenda">' +
                                        agenda +
                                    '</span>' +
                                    '<br>' +
                                    '<span><b>Description: </b>' +
                                    '<span class="" style="white-space: pre-line; text-align: justify; display:block;" id="description">' +
                                        data.description +
                                    '</span>';
                    }

                    $('#hero_body').html(hero_body);

                    if(data.is_required == 0){
                        is_required_view = "Not required to attend"
                    } else{
                        is_required_view = "Required to attend"
                    }

                    console.log(data.title)
                    var hero_header =   
                                        '<div class="row">' +
                                            '<div class="col-md-10">' +
                                                '<h3 class="text-center"><span id="title"><i class="fa fa-users"aria-hidden="true"></i> &nbsp;' +
                                                    data.title +
                                                '</span></h3>' +
                                            '</div>' +
                                            '<div class="col-md-2">' +
                                                '<div>' +
                                                    '<button type="button" class="btn btn-info"' +
                                                    ' role="button" aria-expanded="false" id="view_memo"' +
                                                    '>View Memo</button>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<br>' +
                                        '<div class="col-12">' +
                                            '<span class="badge badge-info text-dark" style="font-size: 14px">' +
                                                '<span>Posted by </span><span id="created_by">' +
                                                    data.created_by_user.faculty.last_name + ", " + data.created_by_user.faculty.first_name +
                                                '</span>' +
                                            '</span>' +
                                            '<div class="text-dark float-right">' +
                                                '<span class="badge text-dark badge-warning" style="font-size: 14px">' +
                                                    '<span id="act_type">' +
                                                        data.activity_type.title +
                                                    '</span>' +
                                                    '<span> • </span>' +
                                                    '<span id="is_required">' +
                                                        is_required_view +
                                                    '</span>' +
                                                '</span>' +
                                            '</div>' +
                                        '</div>';
                    $('#hero_header').html(hero_header);
                                        
    
                    $('#id_view').html(data.id);
                    $('#start_time').html(moment(data.start_datetime).format('LLL'));
                    $('#end_time').html(moment(data.end_datetime).format('LLL'));
                 

                    activity_status = data.status;

                    if(activity_status == "Pending")
                    {
                        $('#status').html(`<span class="badge badge-warning" style="font-size: 14px">
                                <span>Pending</span>
                                </span>`);
                    }
                    else if(activity_status == "On Going")
                    {
                        $('#status').html(`<span class="badge badge-info" style="font-size: 14px">
                                <span>On Going</span>
                                </span>`);
                        //$('#status').addClass('text-success');
                    }
                    else if(activity_status == "Done")
                    {
                        $('#status').html(`<span class="badge badge-success" style="font-size: 14px">
                                <span>Done</span>
                                </span>`);
                        //$('#status').addClass('text-warning');
                    }
                    
                    
                    $('#is_required').html(is_required_view);
                    $('#location').html(data.location);

                    //$('#created_at_view').html(created_at);

                    // console.log(data.memorandum_file_directory)
                    //document.getElementById("memorandum_view").src=APP_URL + data.memorandum_file_directory;
                    //$('#memorandum_view').src("{{ asset('" + data.memorandum_file_directory + "') }}")

                    $('#view_memo').on('click', function(){

                        if(data.memorandum_file_directory == "NA" || data.memorandum_file_directory == null){
                            swalAlert('warning', 'No Memorandum Uploaded')
                        }
                        else{
                            var tabOrWindow = window.open(APP_URL + "/" +data.memorandum_file_directory, '_blank');
                            tabOrWindow.focus();   
                        }

                    });
                }
            // ajax closing tag
            })
        }
        getActivity()

        function requiredFacultyDatatable(){
            requiredFacultyDatatable = $('#requiredFacultyDatatable').DataTable({
                "ajax": {
                    url: ATTENDANCE_API+"search/"+ACTIVITY_ID,
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "deleted_at"},
                    { data: "faculty.first_name", render: function(data, type, row){
                        let html = ''
                        html += row.faculty.first_name + ' ' + row.faculty.last_name
                        return html
                    }},
                    { data: "status", render: function(data, type, row){
                        if (moment(row.start_datetime).format() < date && moment(row.end_datetime).format() > date){
                            return "Ongoing"
                        }
                        else if (date > moment(row.end_datetime).format() ){
                            return "Ended"
                        }
                        else{
                            return data
                        }
                    }},
                    { data: "time_in", render: function(data, type, row){
                        if (data == null){
                            return "Not yet"
                        }
                        else{
                            return moment(data).format('LLL')
                        }
                    }},
                    { data: "time_out", render: function(data, type, row){
                        if (data == null){
                            return "Not yet"
                        }
                        else{
                            return moment(data).format('LLL')
                        }
                    }},
                    { data: "id", render: function(data, type, row){
                        return `</div>
                                    <button type="button" class="btn btn-sm btn-success btnViewDetails" id="${row.id}">
                                    <div>Check Uploaded Files</div>
                                </button>&nbsp;
                                <button type="button" class="btn btn-sm btn-danger btnRemoveRequired" id="${row.id}">
                                    Unrequire
                                </button>`
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 2] }],
                "order": [[1, "desc"]]
                });
        };

        requiredFacultyDatatable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = ATTENDANCE_API+'search/' + ACTIVITY_ID;

            requiredFacultyDatatable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION
        

        $('#btnEditRequiredFaculty').on('click', function(){
            let form_url = ATTENDANCE_API + "unrequired_faculty/" + ACTIVITY_ID

            $('#requiredFacultyDatatableModal').DataTable().destroy()
            requiredFacultyDatatableModal = $('#requiredFacultyDatatableModal').DataTable({
                "ajax": {
                    url: form_url,
                    dataSrc: ""
                },
                "async": true,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "user.email", render: function(data, type, row){
                        return data
                    }},
                    { data: "first_name", render: function(data, type, row){
                        let html = ''
                        html += row.first_name + ' ' + row.last_name
                        return html
                    }},
                    { data: "user_id", render: function(data, type, row){
                        let user_role = ''
                        
                        $.each(row.user.user_role, function(i){
                            if(i < (row.user.user_role.length) - 1){
                                user_role += row.user.user_role[i].role.title + ', '
                            }
                            else{
                                user_role += row.user.user_role[i].role.title
                            }
                        })
                        return user_role
                    }},
                    { data: "id", render: function(data, type, row){
                        return `<div class="custom-control custom-switch">
                                    <input type="checkbox" name="faculty_required[]" class="custom-control-input faculty_status" id="${row.id}" value="${row.id}" checked>
                                    <label id="status_label" class="custom-control-label" for="${row.id}">Yes</label>
                                </div>`
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]],
                "bPaginate": false,
            });

            $('#editRequiredFacultyModal').modal('show');
        })

        // $(document).on("click", ".faculty_status", function(){
        //     Swal.fire({
        //         icon: 'warning',
        //         text: 'This feature is still under development'
        //     })
        // });


        $('#updateRequiredFacultyForm').on('submit', function(e){
            e.preventDefault()
            // Swal.fire({
            //     icon: 'warning',
            //     text: 'This feature is still under development'
            // })

            let required_faculty = $("input[name='faculty_required[]']:checked")
              .map(function(){
                return {
                "activity_id": ACTIVITY_ID,
                "faculty_id": $(this).val()
                }
            }).get();

            let form_url = ATTENDANCE_API+"multi_insert"


             // ajax opening tag
             $.ajax({
                    url: form_url,
                    method: "POST",
                    data: JSON.stringify(required_faculty),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        console.log(data)
                        notification('success', 'Required Faculty')
                        $('#editRequiredFacultyModal').modal('hide');
                        refresh()
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
        })
        

        $(document).on("click", ".btnViewDetails", function(){
            var id = this.id
            
            $.ajax({
                url: APP_URL+'/api/v1/activity_submitted_proof/' + id,
                type: "GET",
                dataType: "JSON",
                success: function (data){   
                    console.log(data)

                    let html = `<li class="list-group-item d-flex justify-content-between" disabled="">
                                                    <span class="text-primary"><strong>Submitted File/s</strong></span>
                                                    <span class="text-primary"><strong>Date Submitted</strong></span>
                                                </li>`

                    // let header = `<h5 class="text-dark">Faculty: ${data.faculty.last_name}, ${data.faculty.first_name}</h5>`

                    // IF FACULTY DOES NOT HAVE ANY SUBMITTED REQUIREMENTS YET
                    if(data.length == 0){
                        html += `&nbsp;<div class="text-center">Empty Submission
                            </div>`
                    }

                    // PASSING SUBMITTED REQUIREMENTS DATA INTO HTML VAR TO PASS IT TO DOM
                    $.each(data, function(i){
                        let file_id = data[i].id
                        let file_link_directory = APP_URL + "/" + data[i].file_link_directory
                        let file_name = data[i].file_name
                        let date_submitted = data[i].date_submitted

                        html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    <button class="btn btn-info" onclick="window.open('${file_link_directory}')" target="_blank">${file_name}</button>
                                    
                                    <span class="badge badge-light">${moment(date_submitted).format('lll')}</span>
                                 </li>`
                    })

                    $.ajax({
                        url: ATTENDANCE_API + id,
                        method: "GET",
                        dataType: "JSON",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },

                        success: function(data){
                            console.log(data)
                            $("#attendance_id").val(data.id);


                            if(data.proof_of_attendance_file_link == null){
                                $("#proof_link_view").val("No URL");
                            }
                            else{
                                $("#proof_link_view").val(data.proof_of_attendance_file_link);
                            }

                            if(data.remarks == null){
                                $("#proof_remarks").html("No Remarks");
                            }
                            else{
                                $("#proof_remarks").val(data.remarks);
                            }

                            $("#proof_status").val(data.status);
                            
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
                    
                    //$('#fileModalHeader').html(header)
                    $('#fileModalBody').html(html)
                    $('#fileViewerModal').modal('show')
                },
            });
        });

        $('.btnSubmittedUpdate').on('click', function(e){
            
            let id = $('#attendance_id').val()
            let status = $('#proof_status').val()
            let remarks = $('#proof_remarks').val()

            let form_url = ATTENDANCE_API + id
            let form_data = {
                "status": status,
                "remarks": remarks
            }

            console.log(form_data)
            $.ajax({
                    url: form_url,
                    method: "PUT",
                    data: JSON.stringify(form_data),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        console.log(data)
                        notification('info', 'Submitted Requirement/s')
                        $('#fileViewerModal').modal('hide');
                        refresh()
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
        })

        $(document).on("click", "#copyURL", function(){
            /* Get the text field */
            var copyText = document.getElementById("proof_link_view");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

        });
        
        function get_roles(){

        activity_type_url = APP_URL+'/api/v1/role'

            $.ajax({
            url: activity_type_url,
            type: "GET",
            dataType: "JSON",

            success: function(data){

                var html = ""

                for(var i=0; i < data.length; i++){
                html += `<option value="${data[i].title}">${data[i].title}</option>`
                }
                
                $('#role_filter').html(html);

                }
            })
        }
        get_roles()

        $('#role_filter').on('change', function(){

            var table = $('#requiredFacultyDatatableModal').DataTable();

            table.column(4).search(this.value).draw();
        })

        // Remove Required
        $(document).on("click", ".btnRemoveRequired", function(){
            var id = this.id;
            let form_url = ATTENDANCE_API + id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
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
                                url: ATTENDANCE_API + 'destroy/' + data.id,
                                method: "DELETE",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data){
                                    notification('error', 'Required User')
                                    setInterval(() => {
                                        location.reload()
                                    }, 1000);
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

        // ------------------------------------------------------------------------------------------------- //
            // UNSELECT ALL BUTTON ON REQUIRED FACULTY LIST MODAL
                $('#btn_select_all').on('change', function(){

                    let status = $('#btn_select_all').is(":checked")

                    if(status == true){
                        $('#select_all_label').html('Unselect all')
                        $("input[name='faculty_required[]']").prop('checked', true)
                    }
                    else{
                        $('#select_all_label').html('Select all')
                        $("input[name='faculty_required[]']").prop('checked', false)
                    }
                })
            // END UNSELECT ALL BUTTON ON REQUIRED FACULTY LIST MODAL
        // ------------------------------------------------------------------------------------------------- //

    });
</script>
