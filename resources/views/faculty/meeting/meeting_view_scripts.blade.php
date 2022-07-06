
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

        // TIME IN BUTTON FUNCTION
        timeIn = () => 
        {
            swalAlert('warning', 'This function is under maintenance!')
        }
        // END TIME IN BUTTON FUNCTION

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

                    let arrayOfUserRole = []
                    $.each(USER_ROLE.user_role, function(i){
                        arrayOfUserRole.push(USER_ROLE.user_role[i].role.title)
                    })
                    // CHECK THE USER ROLE
                    if(jQuery.inArray("Faculty", arrayOfUserRole) !== -1)
                    {
                        // For meeting_view_content> div#row_right - button top
                        var row_right_top = "";

                        var current_time = new Date(); // current time
                        var hours = current_time.getHours();
                        var mins = current_time.getMinutes();
                        var day = current_time.getDay();


                        var moment_current_time = moment(current_time).format('LT');
                        var moment_current_date = moment(current_time).format('LL')
                        var now = hours+":"+mins+":00";
                        var moment_end_time = moment("2022-06-27 " + responseData.end_time).format('LT');
                        var moment_start_time = moment("2022-06-27 " + responseData.start_time).format('LT');
                        var moment_meeting_date = moment(responseData.date).format('LL')

                        var remainMins = "";

                        console.log("The meeting Date is "+ moment_meeting_date + " and The Current Date is " + moment_current_date);

                        if (moment_meeting_date == moment_current_date)
                        {
                            remainMins = moment().startOf('hour').fromNow();
                        }
                        else if(moment_meeting_date < moment_current_date)
                        {
                            remainMins = moment().startOf('day').fromNow();
                        }
                        
                         
                        if(now >= moment_start_time && moment_end_time <= now) 
                        {
                            console.log("Yes Current time is between " + moment_start_time + " to " + moment_end_time + ", and " + remainMins + " mins left to be time " + moment_end_time);
                            row_right_top +=    '<div class="col-12">' +
                                                    '<button type="button" onClick="return timeIn()" class="btn btn-icon icon-left btn-success btn-lg button-block"><i class="fas fa-check"></i> Time in</button>' +
                                                '</div>' +
                                                '<br>';
                        }
                        else 
                        {
                            row_right_top +=    '<div class="col-12">' +
                                                    '<disabled button type="button" class="btn btn-icon icon-left btn-secondary btn-lg button-block">Done<br>'+ remainMins +'</button>' +
                                                '</div>' +
                                                '<br>';
                            
                        }
                        

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
                        $("#row_right").html(row_right_top);
                        $("#row_right").append(row_right_bottom);
                    }

                },
                error: function ({ responseJSON }) {},
            });
        };
        getMeetingDetails();
        // END FUNCTION TO CHANGE CONTENT

        // FUNCTION FOR REQUIRED FACULTY DATATABLE
        function requiredFacultyDatatable(){
            requiredFacultyDatatable = $('#requiredFacultyDatatable').DataTable()
        }

        requiredFacultyDatatable()
        // END FUNCTION FOR REQUIRED FACULTY DATATABLE

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
                    { data: "meeting_type.title"},
                    { data: "agenda"},
                    { data: "location"},
                    { data: "start_time", render: function(data, type, row){
                        console.log("0000-00-00 "+data)
                        console.log(row.date)
                        return `${moment(row.date).format('LL')} <br> ${moment("2022-06-27 "+data).format('LT')} - ${moment("2022-06-27 "+row.end_time).format('LT')}`
                    }}, // merge date (to be add), start_time, end_time
                    { data: "is_required", render: function (data, type, row) { // required
                          console.log(data)
                          if(data == true)
                          {
                            return `<p>Yes</p>`
                          }
                          else
                          {
                            return `<p>No</p>`
                          }
                        }
                    },
                    { data: "status"},
                    { data: "deleted_at", render: function(data, type, row){    
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                        <div>View Meeting</div></div>
                                        <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                            <div>Edit Meeting</div></div>
                                            <div class="dropdown-divider"</div></div>
                                            <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                            <div style="color: red">Delete Meeting</div></div></div></div>`;
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
            let url = BASE_API;

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

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

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var meeting_id = this.id;
            window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id);

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

            //         $('#id_view').html(data.id);
            //         $('#title_view').html(data.title);
            //         $('#meeting_types_id_view').html(data.meeting_type.title);
            //         $('#agenda_view').html(data.agenda);
            //         $('#description_view').html(data.description);
            //         $('#start_time_view').html(data.start_time);
            //         $('#end_time_view').html(data.end_time);
            //         if(data.is_required == 0) // true
            //         {
            //             data.is_required = "No"
            //         }
            //         else
            //         {
            //             data.is_required = "Yes"
            //         }
            //         $('#is_required_view').html(data.is_required);
            //         $('#status_view').html(data.status);
            //         $('#created_at_view').html(created_at);

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
                    $('#id_edit').val(data.id);
                    $('#title_edit').val(data.title);
                    $('#meeting_types_id_edit').val(data.meeting_types_id);
                    $('#agenda_edit').val(data.agenda);
                    $('#location_edit').val(data.location);
                    $('#description_edit').val(data.description);
                    $('#date_edit').val(data.date);
                    $('#start_time_edit').val(data.start_time);
                    $('#end_time_edit').val(data.end_time);
                    $('#is_required_edit').val(data.is_required);
                    $('#status_edit').val(data.status);
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

            let data = {
                "title": $('#title_edit').val(),
                "meeting_types_id": $('#meeting_types_id_edit').val(),
                "description": $('#description_edit').val(),
                "agenda": $('#agenda_edit').val(),
                "location": $('#location_edit').val(),
                "date": $('#date_edit').val(),
                "start_time": $('#start_time_edit').val(),
                "end_time": $('#end_time_edit').val(),
                "is_required": $('#is_required_edit').val(),
                "status": $('#status_edit').val(),
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
                    $('#meeting_type_delete').html(data.meeting_types_id);
                    $('#agenda_delete').html(data.agenda);
                    $('#location_delete').html(data.location);
                    $('#description_delete').html(data.description);
                    $('#date_delete').html(data.date);
                    $('#start_time_delete').html(data.start_time);
                    $('#end_time_delete').html(data.end_time);
                    $('#is_required_delete').html(data.is_required);
                    $('#status_delete').html(data.status);

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
