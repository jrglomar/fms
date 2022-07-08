
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
                    var row_left = '<div class="col-12 col-sm-12 col-lg-12">' +
                                        '<div class="hero bg-success text-white">' +
                                            '<div class="hero-inner">' +
                                                '<div class="col-12">' +
                                                    '<h3 class="card-title text-center"><i class="fa fa-users"aria-hidden="true"></i> &nbsp;' + 
                                                        '<span>' + responseData.title + '</span>' +
                                                    '</h3>' +
                                                    
                                                    '<span class="badge badge-info" style="color:black"><b>' + responseData.meeting_type.title + '</b></span>' +
                                                    '<div class="float-right"><b>' +
                                                        status +
                                                    '</b></div>' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="card-body">' +
                                                '<div class="col-md-12">' +
                                                    '<span><b>Agenda: </b>' +
                                                '</div>' +
                                                '<div class="col-md-12">' +
                                                    '<span style="white:space: pre-line; text-align: justify; display:block;">&emsp;' +responseData.agenda +   
                                                '</div>' + 
                                                '<br>' + 
                                                '<div class="col-md-12">' +
                                                    '<span><b>Description: </b>' +
                                                '</div>' +
                                                '<div class="col-md-12">' +
                                                    '<span style="white:space: pre-line; text-align: justify; display:block;">&emsp;' +responseData.description +   
                                                '</div>' + 
                                            '</div>' + 
                                        '</div>' +
                                    '</div>' +
                                    '<br>';

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

        $(document).on("click", ".btnViewDetails", function(){
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        });

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
                    console.log(error)
                    swalAlert('warning', error.responseJSON.message)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            })
            // ajax closing tag
        })
        // ENDFUNCTION ON EDIT REQUIRED FACULTY LIST BUTTON

// ------------------------------------------------------------------------------------------------- //

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
