
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/meeting/'
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))

        var USER_ROLE = JSON.parse(USER_DATA)


        let MEETING_ID = "{{ $meeting_id }}"
        // END OF GLOBAL VARIABLE

// ------------------------------------------------------------------------------------------------- //

        // FUNCTION TO CHANGE CONTENT
        function getMeetingDetails(){
            $.ajax({
                url: BASE_API + MEETING_ID,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    var meeting_status = responseData.status

                    if(meeting_status == "Done" || meeting_status == "done")
                    {
                        $.ajax({
                            url: APP_URL + "/api/v1/meeting_attendance_required_faculty_list/faculty_list_time_out_null/" + MEETING_ID,
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
                                        var proof_of_attendance_file_link = responseData[i].proof_of_attendance_file_link
                                        var faculty_id = responseData[i].faculty_id
                                        var meeting_id = responseData[i].meeting_id
                                        var id = responseData[i].id

                                        $.ajax(
                                        {
                                            url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/' + id,
                                            type: "PUT",
                                            data: JSON.stringify(
                                            {		
                                                "time_in": time_in,
                                                "time_out": time_out,
                                                "attendance_status": "Absent",
                                                "remarks": remarks,
                                                "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                                "faculty_id": faculty_id,
                                                "meeting_id": meeting_id,
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
                    else if(meeting_status == "On Going")
                    {
                        if(moment_current_date > moment_meeting_date)
                        {
                            console.log("On Going to Done 364")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_meeting_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + responseData.start_time)
                            console.log("End Time: " + responseData.end_time)
                            let data = {
                                "title": responseData.title,
                                "meeting_type_id": responseData.meeting_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "date": responseData.date,
                                "start_time": responseData.start_time,
                                "end_time": responseData.end_time,
                                "is_required": responseData.is_required,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + meeting_id,
                                method: "PUT",
                                data: JSON.stringify(data),
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
                        if(moment_current_date == moment_meeting_date && now > responseData.end_time)
                        {
                            console.log("On Going to Done 567")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_meeting_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + responseData.start_time)
                            console.log("End Time: " + responseData.end_time)
                            let data = {
                                "title": responseData.title,
                                "meeting_type_id": responseData.meeting_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "date": responseData.date,
                                "start_time": responseData.start_time,
                                "end_time": responseData.end_time,
                                "is_required": responseData.is_required,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + MEETING_ID,
                                method: "PUT",
                                data: JSON.stringify(data),
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
                    

                    var isRequired = responseData.is_required
                    var status = responseData.status

                    
                    $("#pdf_title").val("Meeting_"+moment(responseData.created_at).format('YYYY_MMMM_DD'))
                    $("#pdf_filename").val("Meeting_"+moment(responseData.created_at).format('YYYY_MMMM_DD'))

                    var pdf_title = $("#pdf_title").val()
                    var pdf_filename = $("#pdf_filename").val()

                    // Changing Boolean value of is_required to text
                    if(isRequired == true)
                    {
                        isRequired = 'Yes'
                    }
                    else
                    {
                        isRequired = 'No'
                    } 

                    // IF Else Condition to specify if the Status is Done or Pending
                    if(status == "Pending")
                    {
                        status = '<span class="badge badge-warning" style="font-size: 16px">Meeting Status: ' + responseData.status + '</span>'
                    }
                    else if(status == "Done" || status == "done")
                    {
                        status = '<span class="badge badge-success" style="font-size: 16px">Meeting Status: ' + responseData.status + '</span>'
                    } 
                    else if(status == "On Going")
                    {
                        status = '<span class="badge badge-info" style="font-size: 16px">Meeting Status: ' + responseData.status + '</span>'
                    } 


                    // For meeting_view_content> div#row_left
                    var row_left = '<div class="col-12 col-sm-12 col-lg-12">' +
                                        '<div class="hero text-white hero-bg-image hero-bg-parallax"' +
                                        'style="background-image: url({{ URL::to("/images/designs/meeting_card_lightblue.png") }})">' +
                                            '<div class="hero-inner">' +
                                                '<div class="col-12">' +
                                                    '<h3 class="card-title text-center"><i class="fa fa-users"aria-hidden="true"></i> &nbsp;' + 
                                                        '<span >' + responseData.title + '</span>' +
                                                    '</h3>' +
                                                    
                                                    '<span class="badge badge-info" style="color:black; font-size: 16px" ><b>' + responseData.meeting_type.title + '</b></span>' +
                                                    '<div class="float-right"><b>' +
                                                        status +
                                                    '</b></div>' +
                                                '</div>' +
                                            '</div>' +
                                            '<br>' +
                                            '<div class="hero-inner">' +
                                                '<div class="col-md-12">' +
                                                    '<span style="font-size: 16px"><b>Agenda: </b>' +
                                                '</div>' +
                                                '<div class="col-md-12">' +
                                                    '<span style="white:space: pre-line; text-align: justify; display:block;">&emsp;&emsp;&emsp;' +responseData.agenda +   
                                                '</div>' + 
                                                '<br>' + 
                                                '<div class="col-md-12">' +
                                                    '<span style="font-size: 16px"><b>Description: </b>' +
                                                '</div>' +
                                                '<div class="col-md-12">' +
                                                    '<span style="white:space: pre-line; text-align: justify; display:block;">&emsp;&emsp;&emsp;' +responseData.description +   
                                                '</div>' + 
                                            '</div>' + 
                                        '</div>' +
                                    '</div>' +
                                    '<br>';

                    // CHECK THE USER ROLE

                    let arrayOfUserRole = []
                    $.each(USER_ROLE.user_role, function(i){
                        arrayOfUserRole.push(USER_ROLE.user_role[i].role.title)
                        
                    })
                    // if(USER_ROLE.user_role[0].role.title == "Academic Head")
                    if(jQuery.inArray("Academic Head", arrayOfUserRole) !== -1)
                    {
                        // For meeting_view_content> div#row_right - card bottom
                        var row_right_bottom = '<div class="card card-success">' +
                                                    '<div class="card-body">' +
                                                        '<div class="align-items-start">' +
                                                            '<h5 class="text-primary card-title"><i class="fa fa-info-circle" aria-hidden="true"></i> ' + 
                                                                '<span>Meeting Details: </span>' +
                                                            '</h5>' +
                                                        '</div>' +
                                                        '<div class="text-dark">' + 
                                                            '<div class="col-md-12">' +
                                                                '<b>Date: </b>' +
                                                            '</div>' +
                                                            '<div class="col-md-12"> -- ' +
                                                                moment(responseData.date).format('dddd, MMMM D, YYYY') +   
                                                            '</div>' +  
                                                            '<div class="col-md-12">' +
                                                                '<b>Location: </b>' +
                                                            '</div>' +
                                                            '<div class="col-md-12"> -- ' +
                                                                responseData.location +   
                                                            '</div>' + 
                                                            '<div class="row">' +
                                                                '<div class="col-md-6">' +
                                                                    '<div class="col-md-12">' +
                                                                        '<b>From: </b>' +
                                                                    '</div>' +
                                                                    '<div class="col-md-12"> -- ' +
                                                                        moment("2022-06-27 "+responseData.start_time ).format('LT') +   
                                                                    '</div>' + 
                                                                '</div>' +
                                                                '<div class="col-md-6">' +
                                                                    '<div class="col-md-12">' +
                                                                        '<b>To: </b>' +
                                                                    '</div>' +
                                                                    '<div class="col-md-12"> -- ' +
                                                                        moment("2022-06-27 "+responseData.end_time ).format('LT') +   
                                                                    '</div>' + 
                                                                '</div>' +
                                                            '</div> ' +
                                                        '</div>' + 
                                                    '</div>' + 
                                                '</div>' ;
                                    
                        $("#row_left").html(row_left);
                        $("#row_right").html(row_right_bottom);
                    }
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
        };

        getMeetingDetails();
        // END FUNCTION TO CHANGE CONTENT

// ------------------------------------------------------------------------------------------------- //

        // FUNCTION FOR REQUIRED FACULTY DATATABLE
        function requiredFacultyDatatable()
        {
            dataTable = $('#requiredFacultyDatatable').DataTable({
                "ajax": {
                    url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search/' + MEETING_ID, 
                    dataSrc: ''
                },
                "dom": 'Bfrtip',
                "buttons":[
                    {
                        extend: 'pdfHtml5', 
                        text: 'Save to PDF File',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7 ],
                            modifier: { order: 'index' }
                        },
                        title: function() {
                            return $('#pdf_title').val()
                        },
                        titleAttr : 'PDF',
                        filename: function() {
                            return $('#pdf_filename').val()
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';
                        },
                    }
                ],
                "columns": [
                    { data: "id"},
                    { data: "created_at", render: function(data, type, row){
                        return moment(row.created_at).format('LL')
                    }},
                    { data: "faculty.first_name", render: function(data, type, row){
                        let html = ''
                        html += row.faculty.first_name + ' ' + row.faculty.last_name
                        return html
                    }},
                    { data: "time_in", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>-----</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "time_out", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>-----</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "attendance_status", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>-----</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "id", render: function(data, type, row){
                        if(row.meeting_submitted.length != 0)
                        {
                            return `</div>
                                    <button type="button" class="btn btn-sm btn-success btnViewDetails" id="${row.faculty_id}">
                                        <div>Check Proof of Attendance</div>
                                    </button>`
                        }
                        else
                        {
                            return `</div>
                                        <div>-----</div>`                         
                        }
                    }},
                    { data: "proof_of_attendance_file_link", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>-----</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]]
                })
        }

            // CALLING DATATABLE FUNCTION
            requiredFacultyDatatable()

        // END FUNCTION FOR REQUIRED FACULTY DATATABLE

// ------------------------------------------------------------------------------------------------- //
        
    $(document).on("click", ".btnViewDetails", function(){
        var faculty_id = this.id
        $('#marf_id').val(faculty_id)

        console.log(MEETING_ID)
        console.log(faculty_id)
        
        $.ajax({
            url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + faculty_id,
            type: "GET",
            dataType: "JSON",
            success: function (responseData)
            {   
                console.log()
                let html = `<li class="list-group-item d-flex justify-content-between" disabled="">
                                                <span class="text-primary"><strong>Submitted File/s</strong></span>
                                                <span class="text-primary"><strong>Date Submitted</strong></span>
                                            </li>`

                let header = `<h5 class="text-dark">Faculty: ${responseData[0].faculty.last_name}, ${responseData[0].faculty.first_name}</h5>`

                // IF FACULTY DOES NOT HAVE ANY SUBMITTED REQUIREMENTS YET
                if(responseData[0].meeting_submitted.length == 0){
                    html += `&nbsp;<div class="text-center">Empty Submission
                        </div>`
                }

                // PASSING SUBMITTED REQUIREMENTS DATA INTO HTML VAR TO PASS IT TO DOM
                $.each(responseData[0].meeting_submitted, function(i){
                    let file_id = responseData[0].meeting_submitted[i].id
                    let proof_of_attendance_file_directory = APP_URL + "/" + responseData[0].meeting_submitted[i].proof_of_attendance_file_directory
                    let file_name = responseData[0].meeting_submitted[i].file_name
                    let date_submitted = responseData[0].meeting_submitted[i].date_submitted

                    html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                <button class="btn btn-info" onclick="window.open('${proof_of_attendance_file_directory}')" target="_blank">${file_name}</button>
                                
                                <span class="badge badge-light">${moment(date_submitted).format('lll')}</span>
                                </li>`
                })

                // PASSING VAR DATA TO DOM
                $('#fileModalHeader').html(header)
                $('#fileModalBody').html(html)
                $('#fileViewerModal').modal('show')
            },
        });
    });

// ------------------------------------------------------------------------------------------------- //

    // REFRESH DATATABLE FUNCTION
    function refresh(){
        let url = APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search/' + MEETING_ID;

        dataTable.ajax.url(url).load()
    }
    // END REFRESH DATATABLE FUNCTION

// ------------------------------------------------------------------------------------------------- //

        // FUNCTION ON EDIT REQUIRED FACULTY LIST BUTTON
        $('#btnEditRequiredFaculty').on('click', function(){
            let form_url = APP_URL+'/api/v1/faculty/get_all_faculties_that_does_not_on_meeting/' + MEETING_ID

            $('#requiredFacultyDatatableModal').DataTable().destroy()
            requiredFacultyDatatableModal = $('#requiredFacultyDatatableModal').DataTable({
                "ajax": {
                    url: form_url,
                    dataSrc: "",
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

        $('#updateRequiredFacultyForm').on('submit', function(e){
            e.preventDefault()
            // Swal.fire({
            //     icon: 'warning',
            //     text: 'This feature is still under development'
            // })

            let required_faculty = $("input[name='faculty_required[]']:checked")
              .map(function(){
                return {
                "meeting_id": MEETING_ID,
                "faculty_id": $(this).val()
                }
            }).get();

            let form_url = APP_URL + '/api/v1/meeting_attendance_required_faculty_list/multi_insert'


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
                    notification('success', 'Required Faculty');
                    $('#editRequiredFacultyModal').modal('hide');
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
            })
            // ajax closing tag
        })
        // ENDFUNCTION ON EDIT REQUIRED FACULTY LIST BUTTON

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

        // FUNCTION FOR UPDATING SUBMITTED REQUIREMENTS
        $('.btnSubmittedUpdate').on('click', function(e){
            let status = $('#marf_status').val()
            let remarks = $('#marf_remarks').val()
            let faculty_id = $('#marf_id').val()

            $.ajax(
            {
                url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + faculty_id,
                type: "GET",
                dataType: "json",
                success: function (data) 
                { 
                    var time_in = data[0].time_in
                    var time_out = data[0].time_out
                    var attendance_status = data[0].attendance_status
                    var proof_of_attendance_file_link = data[0].proof_of_attendance_link
                    var faculty_id = faculty_id
                    var meeting_id = MEETING_ID
                    var id = data[0].id

                    $.ajax(
                    {
                        url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/' + id,
                        type: "PUT",
                        data: JSON.stringify(
                        {		
                            "time_in": time_in,
                            "time_out": time_out,
                            "attendance_status": attendance_status,
                            "proof_of_attendance_file_link": proof_of_attendance_file_link,
                            "remarks": remarks,
                            "status": status,
                            "faculty_id": faculty_id,
                            "meeting_id": meeting_id,
                        }),
                        dataType: "JSON",
                        contentType: 'application/json',
                        processData: false,
                        cache: false,
                        success: function (responseJSON) 
                        {
                            console.log(data)
                            notification('info', 'Submitted Proof/s / Submitten Reason/s')
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
                        },
                    }); 
                }
            });
        })

// ------------------------------------------------------------------------------------------------- //
        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
