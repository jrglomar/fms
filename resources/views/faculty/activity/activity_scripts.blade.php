
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity/'
        var FACULTY_ID = JSON.parse(USER_DATA).faculty.id

        // END OF GLOBAL VARIABLE

        // DATA TABLES FUNCTION
        function dataTable(){
                date = moment(new Date).format()
                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API + 'get_required_activity/' + FACULTY_ID, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "title"},
                    { data: "activity_type.title"},
                    { data: "description"},
                    { data: "status"},
                    { data: "start_datetime", render: function(data, type, row){
                        return `<span class="badge badge-info">${moment(data).format('LLL')} - ${moment(row.end_datetime).format('LLL')}</span>` 
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                    <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                    <div>View</div></div>`;
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

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var activity_id = this.id;

            // FUNCTION TO UPDATE MEETING STATUS UPON VIEWING
            $.ajax({
                url: BASE_API + activity_id,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {  
                    var status = responseData.status

                    var start_date_hours = new Date(responseData.start_datetime).getHours();
                    var start_date_mins = new Date(responseData.start_datetime).getMinutes();

                    var end_date_hours = new Date(responseData.end_datetime).getHours();
                    var end_date_mins = new Date(responseData.end_datetime).getMinutes();

                    var current_time = new Date(); // current time
                    var hours = current_time.getHours();
                    var mins = current_time.getMinutes();
      
                    var moment_current_date = moment(current_time).format('L')
                    var moment_start_date = moment(responseData.start_datetime).format('L');
                    var moment_end_date = moment(responseData.end_datetime).format('L');


                    var now = hours+":"+mins+":00";
                    var start_time = start_date_hours + ":" + start_date_mins + ":00"
                    var end_time = end_date_hours + ":" + end_date_mins + ":00"
                    
                    if(status == "Pending")
                    {
                        if(moment_start_date == moment_current_date && now >= start_time &&  now <= end_time) 
                        {
                            console.log("Pending to On Going 299")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "On Going",
                                
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
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
                                    setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
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
                        else if(moment_current_date > moment_start_date)
                        {
                            console.log("Pending to Done 344")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
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
                                    setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
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
                        else if(moment_current_date < moment_start_date)
                        {
                            console.log("Pending to Pending 389")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
                        }
                        else if((moment_current_date == moment_start_date) && (now > end_time))
                        {
                            console.log("Pending to Done 399")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
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
                                    setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
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
                        else if(moment_current_date == moment_start_date && now < start_time && now < end_time)
                        {
                            console.log("Pending to Pending 444")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
                        }
                    }
                    else if(status == "On Going")
                    {
                        
                        // var add_required_faculty_button = "";

                        // add_required_faculty_button = '<button type="button" id="btnEditRequiredFaculty" class="btn btn-primary btn-sm">Edit Required Faculty List <i class="fa fa-edit" aria-hidden="true"></i></button>';

                        // $("#add_required_faculty").html(add_required_faculty_button);
                        
                        if(moment_current_date > moment_start_date)
                        {
                            console.log("On Going to Done 364")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
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
                                    setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
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
                        else if(moment_current_date == moment_start_date && now > end_time)
                        {
                            console.log("On Going to Done 509")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
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
                                    setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
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
                            console.log("On Going to On Going 554")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                            setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
                        }
                    }
                    else if(status == "Done" || status == "done")
                    {
                            console.log("Done to Update Faculty Status 565")
                            console.log("Now: "+now)
                            console.log("Meeting Date: " + moment_start_date)
                            console.log("Current Date: " + moment_current_date)
                            console.log("Start Time: " + start_time)
                            console.log("End Time: " + end_time)
                        $.ajax({
                            url: APP_URL + "/api/v1/meeting_attendance_required_faculty_list/faculty_list_time_out_null/" + activity_id,
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
                                        var activity_id = responseData[i].activity_id
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
                                                "activity_id": activity_id,
                                            }),
                                            dataType: "JSON",
                                            contentType: 'application/json',
                                            processData: false,
                                            cache: false,
                                            success: function (responseJSON) 
                                            {     
                                                setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)                     
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
                                    setInterval(window.location.replace(APP_URL+"/faculty/activity/"+activity_id), 1500)
                                }
                            }
                        });
                    }
                },
            // window.location.replace(APP_URL+"/acad_head/activity/"+id);
            });
       });
        // END OF VIEW FUNCTION


        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
