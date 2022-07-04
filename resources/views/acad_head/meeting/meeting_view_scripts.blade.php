
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
                    console.log(responseData)

                    var isRequired = responseData.is_required
                    var status = responseData.status
                    

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
                        status = '<span class="badge badge-warning">' + responseData.status + '</span>'
                    }
                    else if(status == "Done")
                    {
                        status = '<span class="badge badge-success">' + responseData.status + '</span>'
                    } 


                    // For meeting_view_content> div#row_left
                    var row_left = '<div class="card card-info">' +
                                        '<div class="card-header">' +
                                            '<div class="col-12">' +
                                                '<h3 class="text-primary card-title"><i class="fa fa-users"aria-hidden="true"></i> &nbsp;' + 
                                                    '<span>' + responseData.title + '</span>' +
                                                '</h3>' +
                                                '<span style="color:black"><b>' + responseData.meeting_type.title + '</b></span>' +
                                                '<div class="float-right">' +
                                                    status +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                        '<div class="card-body">' +
                                            '<div class="col-md-12">' +
                                                '<span style="color:black"><b>Agenda: </b>' +
                                            '</div>' +
                                            '<div class="col-md-12">' +
                                                '<span style="white:space: pre-line; color:black; text-align: justify; display:block;">&emsp;' +responseData.agenda +   
                                            '</div>' + 
                                            '<br>' + 
                                            '<div class="col-md-12">' +
                                                '<span style="color:black"><b>Description: </b>' +
                                            '</div>' +
                                            '<div class="col-md-12">' +
                                                '<span style="white:space: pre-line; color:black; text-align: justify; display:block;">&emsp;' +responseData.description +   
                                            '</div>' + 
                                        '</div>' + 
                                    '</div>' ;

                    // CHECK THE USER ROLE

                    let arrayOfUserRole = []
                    $.each(USER_ROLE.user_role, function(i){
                        arrayOfUserRole.push(USER_ROLE.user_role[i].role.title)
                        console.log('test')
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
                                                        '<div class="col-md-7">' +
                                                            '<div class="col-md-12">' +
                                                                '<b>From: </b>' +
                                                            '</div>' +
                                                            '<div class="col-md-12"> -- ' +
                                                                moment("2022-06-27 "+responseData.start_time ).format('LT') +   
                                                            '</div>' + 
                                                        '</div>' +
                                                        '<div class="col-md-5">' +
                                                            '<div class="col-md-12">' +
                                                                '<b>To: </b>' +
                                                            '</div>' +
                                                            '<div class="col-md-12"> -- ' +
                                                                moment("2022-06-27 "+responseData.end_time ).format('LT') +   
                                                            '</div>' + 
                                                        '</div>' +
                                                    '</div> ' +
                                                    '<div class="col-md-12">' +
                                                        '<b>Required? </b>' +
                                                    '</div>' +
                                                    '<div class="col-md-12"> -- ' +
                                                        isRequired +
                                                    '</div>' +  
                                                '</div>' + 
                                            '</div>' + 
                                        '</div>' ;
                                    
                        $("#row_left").html(row_left);
                        $("#row_right").html(row_right_bottom);
                    }
                },
                error: function ({ responseJSON }) {},
            });
        };

        getMeetingDetails();
        // END FUNCTION TO CHANGE CONTENT

// ------------------------------------------------------------------------------------------------- //

        // FUNCTION FOR REQUIRED FACULTY DATATABLE
        function requiredFacultyDatatable(){
                dataTable = $('#requiredFacultyDatatable').DataTable({
                "ajax": {
                    url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search/' + MEETING_ID, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "faculty.first_name", render: function(data, type, row){
                        let html = ''
                        html += row.faculty.first_name + ' ' + row.faculty.last_name
                        return html
                    }},
                    { data: "time_in", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>No Time In Yet</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "time_out", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>No Time Out Yet</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "attendance_status", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>No Attendance Status Yet</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "proof_of_attendance_file_directory", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>No Proof Yet</p>"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "proof_of_attendance_file_link", render: function(data, type, row){
                        if(data == null)
                        {
                            return "<p>No Proof Yet</p>"
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

        // FUNCTION ON EDIT REQUIRED FACULTY LIST BUTTON
        $('#btnEditRequiredFaculty').on('click', function(){
            let form_url = APP_URL+'/api/v1/faculty/'

            $('#requiredFacultyDatatableModal').DataTable().destroy()
            requiredFacultyDatatable = $('#requiredFacultyDatatableModal').DataTable({
                "ajax": {
                    url: form_url,
                    dataSrc: ''
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
                                    <input type="checkbox" class="custom-control-input faculty_status" id="${row.id}" checked>
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

        $(document).on("click", ".faculty_status", function(){
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        });

        $(document).on("click", ".btnViewDetails", function(){
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        });

        $('#updateRequiredFacultyForm').on('submit', function(e){
            e.preventDefault()
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        })
        // ENDFUNCTION ON EDIT REQUIRED FACULTY LIST BUTTON

// ------------------------------------------------------------------------------------------------- //
        
        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = APP_URL + '/api/v1/meeting_attendace_required_faculty_list/search/' + MEETING_ID;

            dataTable.ajax.url(url).load()
        }
        // END REFRESH DATATABLE FUNCTION

// ------------------------------------------------------------------------------------------------- //

        // LOAD MEETING TYPES
        function loadMeetingTypes(){
            $.ajax({
                url: APP_URL+'/api/v1/meeting_type/',
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    $.each(responseData, function (i, dataOptions) 
                    {
                        var options = "";

                        options =
                            "<option value='" +
                            dataOptions.id +
                            "'>" +
                            dataOptions.title +
                            "</option>";

                        $("#meeting_types_id").append(options);
                        $("#meeting_types_id_edit").append(options);
                    });
                    
                },
                error: function ({ responseJSON }) {},
            });
        };

        loadMeetingTypes();
        // END LOAD MEETING TYPES

// ------------------------------------------------------------------------------------------------- //

        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var form_url = BASE_API;
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })
            console.log(JSON.stringify(data))

            var startTime = $('#start_time').val();
            var endTime = $('#end_time').val();

            console.log(startTime);
            console.log(endTime);

            if(endTime < startTime)
            {
                alert("The meeting End Time is Less than to your Start Time. Please pick time properly")
            }
            else
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
                // ajax closing tag
                })
            }
        });
        // END OF SUBMIT FUNCTION

// ------------------------------------------------------------------------------------------------- //

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
