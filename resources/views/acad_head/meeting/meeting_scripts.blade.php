
<script>
    $(document).ready(function(){

    // Initialize the Summernote WYSIWYG TEXT AREA
        $('#agenda').summernote({
            placeholder: 'Agenda...',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ]
        });
        $('#description').summernote({
            placeholder: 'Description...',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ]
        });
    // END Initialize the Summernote WYSIWYG TEXT AREA

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/meeting/'
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))

        var USER_ROLE = JSON.parse(USER_DATA)
        // END OF GLOBAL VARIABLE

        // PAST DATE RESTRICTION ON INPUT="DATE"
            // To set the minimum of date picker.....
            FilterPastDate = () =>
            {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                
                if (dd < 10) {
                dd = '0' + dd;
                }
                
                if (mm < 10) {
                mm = '0' + mm;
                } 
                    
                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("date").setAttribute("min", today); // "min" or "max"
                document.getElementById("date_edit").setAttribute("min", today); // "min" or "max"
                // document.getElementById("date").setAttribute("max", today); // "min" or "max"
            }
            FilterPastDate()
        // END PAST DATE RESTRICTION ON INPUT="DATE"

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
                        return `<span class="badge badge-info">${moment(row.date).format('LL')}, 
                            ${moment("2022-06-27 "+data).format('LT')} - ${moment("2022-06-27 "+row.end_time).format('LT')
                            }</span>`
                    }}, // merge date (to be add), start_time, end_time
                    { data: "is_required", render: function (data, type, row) { // required
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
                                if (data == null)
                                {
                                    if(row.status == "Done" || row.status == "done" || row.status == "On Going")
                                    {
                                        return `<div class="text-center dropdown">
                                                    <div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                                            <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                                            <div>View</div>
                                                        </div>
                                                        <div class="dropdown-divider"</div></div>
                                                        <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                                            <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                                            <div style="color: red">Delete</div>
                                                        </div>
                                                    </div>
                                                </div>`;
                                    }
                                    else
                                    {
                                        return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                                    <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                                        <div>View</div>
                                                    </div>
                                                <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                                    <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                                    <div>Edit</div>
                                                </div>
                                                <div class="dropdown-divider"</div></div>
                                                    <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                                        <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                                        <div style="color: red">Delete</div>
                                                    </div>
                                                </div>`;
                                    }
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 3, 4, 5, 7, 8] }],
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

            var startTime = $('#start_time').val();
            var endTime = $('#end_time').val();
  
            var meeting_type = $("#meeting_types_id").val()

                if(endTime < startTime)
                {
                    swalAlert('warning', "The meeting End Time is less than Start Time. Please pick time properly")
                }
                else if (endTime == startTime)
                {
                    swalAlert('warning', "The meeting End Time and Start Time appears to be the same. Please pick time properly")
                }
                else if(endTime > startTime)
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
                            notification("success", "Meeting");
                            $("#createForm").trigger("reset");
                            $("#create_card").collapse("hide");
                            $('.select2').val('').trigger("change");
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
            // }
        });
        // END OF SUBMIT FUNCTION

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var meeting_id = this.id;

            // FUNCTION TO UPDATE MEETING STATUS UPON VIEWING
            $.ajax({
                url: BASE_API + meeting_id,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {  
                    
                    var meeting_status = responseData.status
                    var current_time = new Date(); // current time
                    var hours = current_time.getHours();
                    var mins = current_time.getMinutes();
                    if(mins < 10)
                    {
                        mins = "0"+mins
                    }
                    else
                    {
                        mins = mins;
                    }
                    
                    var moment_current_date = moment(current_time).format('L')
                    var moment_meeting_date = moment(responseData.date).format('L');

                    var now = hours+":"+mins+":00";
                    // console.log("the end time is: " + responseData.end_time + ",and the current time is: " + now)

                    if(meeting_status == "Pending")
                    {

                        if(moment_meeting_date == moment_current_date && now >= responseData.start_time &&  now <= responseData.end_time) 
                        {
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
                                "status": "On Going",
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
                                    setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
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
                        else if(moment_current_date > moment_meeting_date)
                        {
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
                                    setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
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
                        else if(moment_current_date < moment_meeting_date)
                        {
                            setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
                        }
                        else if(moment_current_date == moment_meeting_date && now > responseData.end_time)
                        {
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
                                    setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
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
                        else if(moment_current_date == moment_meeting_date && now < responseData.start_time && now < responseData.end_time)
                        {
                            setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
                        }
                    }
                    else if(meeting_status == "On Going")
                    {
                        // var add_required_faculty_button = "";

                        // add_required_faculty_button = '<button type="button" id="btnEditRequiredFaculty" class="btn btn-primary btn-sm">Edit Required Faculty List <i class="fa fa-edit" aria-hidden="true"></i></button>';

                        // $("#add_required_faculty").html(add_required_faculty_button);
                        
                        if(moment_current_date > moment_meeting_date)
                        {
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
                                    setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
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
                        else if(moment_current_date == moment_meeting_date && now > responseData.end_time)
                        {
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
                                    setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
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
                        else
                        {
                            setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
                        }
                    }
                    else if(meeting_status == "Done" || meeting_status == "done")
                    {
                        $.ajax({
                            url: APP_URL + "/api/v1/meeting_attendance_required_faculty_list/faculty_list_time_out_null/" + meeting_id,
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
                                                setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)                     
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
                                    setInterval(window.location.replace(APP_URL + '/acad_head/meeting/'+meeting_id), 1500)
                                }
                            }
                        });
                    }
                },
                error: function(error)
                {
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                },
            });
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
                    $('#meeting_type_id_edit').val(data.meeting_types_id);
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
            if ($(this).parsley().isValid()) 
            {
                var id = $('#id_edit').val();
                var form_url = BASE_API+id
                
                let data = {
                    "title": $('#title_edit').val(),
                    "meeting_type_id": $('#meeting_type_id_edit').val(),
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
                        notification("info", "Meeting");
                        refresh()
                        $('#editModal').modal('hide');
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
            else
            {
                $('#updateForm').parsley().reset();
                swalAlert('warning', "Please put a valid input!");
            }
        });
        // END OF UPDATE FUNCTION

        // DELETE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
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
                                    notification('error', 'Meeting')
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
                    notification("error", "Meeting")
                    refresh()
                    $('#deactivateModal').modal('hide');
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
        });
        // END OF ACTIVATE FUNCTION

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
