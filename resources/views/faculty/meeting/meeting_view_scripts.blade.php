
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/meeting/'

        var USER_ROLE = JSON.parse(USER_DATA)
        var DATA_USER = JSON.parse(USER_DATA)


        let MEETING_ID = "{{ $meeting_id }}"
        let FACULTY_ID = DATA_USER.faculty.id
        // END OF GLOBAL VARIABLE
    
// ------------------------------------------------------------------------------------------------- //

        // UPLOAD FILES MODAL TABS
        $(".tabs").click(function(){
            
            $(".tabs").removeClass("active");
            $(".tabs h6").removeClass("font-weight-bold");    
            $(".tabs h6").addClass("text-muted");    
            $(this).children("h6").removeClass("text-muted");
            $(this).children("h6").addClass("font-weight-bold");
            $(this).addClass("active");

            current_fs = $(".active");

            next_fs = $(this).attr('id');
            next_fs = "#" + next_fs + "1";

            $("fieldset").removeClass("show");
            $(next_fs).addClass("show");

            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });
        // END UPLOAD FILES MODAL TABS

        // FILE UPLOADS
        $.ajax(
        {
            url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
            type: "GET",
            dataType: "json",
            success: function (marfData) 
            {
                var marf_list_id = marfData[0].id
                $("#fileupload").dropzone({ 
                    url: APP_URL+'/api/v1/meeting_submitted_proof/file_uploads',
                    acceptedFiles: 'image/*,.pdf',
                    addRemoveLinks: true,
                    autoProcessQueue: false,
                    parallelUploads: 10,
                    // renameFile: function (file) {
                    //     let file_name = file.name.substr(0, file.name.lastIndexOf('.')) || file.name;
                    //     file_name = file_name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');

                    //     ext = file.name.substring(file.name.lastIndexOf('.') + 1).toLowerCase();

                    //     return file_name + '_' + FACULTY_LAST_NAME + '_' + new Date().getTime() + '.' + ext;
                    // },
                    init: function () {

                        var myDropzone = this;

                        // Update selector to match your button
                        $("#btnUpload").click(function (e) {
                            e.preventDefault();
                            myDropzone.processQueue();
                        });

                        $.ajax({
                            url: APP_URL+'/api/v1/meeting_attendance_required_faculty_list/' + marf_list_id ,
                            type: "GET",
                            dataType: "JSON",
                            success: function (data) 
                            {   
                                console.log(data)
                                $.each(data.meeting_submitted, function(i){
                                    let mockFile = { name: data.meeting_submitted[i].file_name,
                                                    id: data.meeting_submitted[i].id,
                                                    path: APP_URL + "/" + data.meeting_submitted[i].proof_of_attendance_file_directory
                                                    };
                                    myDropzone.files.push(mockFile)
                                    myDropzone.emit("addedfile", mockFile);
                                    myDropzone.emit("complete", mockFile); 
                                })
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

                        myDropzone.on("complete", function(file) {
                            
                            file.previewElement.querySelector('.dz-size').innerHTML = '';
                            file.previewElement.querySelector('.dz-image').innerHTML = `<img src="${APP_URL + '/images/designs/file_upload.png'}">`;

                            file.previewElement.addEventListener("click", function() {
                                // console.log(file)
                                window.open(file.path);
                            });
                        });

                        myDropzone.on("addedfile", function(file) {
                            // file.previewElement.querySelector('.dz-size').innerHTML = '';
                            // file.previewElement.querySelector('.dz-image').innerHTML = `<img src="${APP_URL + '/images/designs/file_upload.png'}">`;

                            file.previewElement.addEventListener("click", function() {
                                // console.log(file)
                            });
                        });
                        
                    },

                    success: function(response, data){
                        let submission_data = [{
                            "marf_id": marf_list_id,
                            "proof_of_attendance_file_directory": data,
                            "file_name": response.upload.filename
                        }]
                        // ajax opening tag
                        $.ajax({
                            url: APP_URL + '/api/v1/meeting_submitted_proof/multi_insert',
                            method: "POST",
                            data: JSON.stringify(submission_data),
                            dataType: "JSON",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },
                            success: function(data){
                                if(data.status == "success"){
                                    notification('success', response.upload.filename)
                                }
                            },
                            complete: function() {
                                setInterval(() => {
                                        location.reload()
                                    }, 1000);
                            },
                            error: function(error){
                                $.each(error.responseJSON.errors, function(key, value){
                                        swalAlert('warning', value)
                                })
                            }
                        })
                        // ajax closing tag
                    },
                    removedfile: function(file) {
                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't able to remove this.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "red",
                            confirmButtonText: "Yes, remove it!",
                        }).then((result) => {
                            if (file.id != null && result.isConfirmed) {
                                $.ajax({
                                    url: APP_URL+'/api/v1/submitted_requirement/destroy/' + file.id,
                                    method: "DELETE",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },

                                    success: function(data){
                                        notification('error', 'Submitted Requirement')
                                        file.previewElement.remove();
                                    },
                                    error: function(error){
                                        console.log(error)
                                        $.each(error.responseJSON.errors, function(key, value){
                                                swalAlert('warning', value)
                                        })
                                        console.log(`message: ${error.responseJSON.message}`)
                                        console.log(`status: ${error.status}`)
                                    }
                                // ajax closing tag
                                })
                            }
                            else if(result.isConfirmed){
                                file.previewElement.remove();
                            }
                        });
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
            },
        });

        $('#btnDone').on('click', function(){
            swalAlert('warning', 'This feature is under maintenance')
        })
        // END FILE UPLOADS

        // TIME IN BUTTON FUNCTION
        timeIn = () => 
        {
            Swal.fire(
            {
                title: "Are you sure you?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes!",
            })
            .then(function (t) 
            {
                // if user clickes yes.
                if (t.value) 
                {
                    $.ajax(
                    {
                        url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) 
                        {
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
                            if(hours < 10)
                            {
                                hours = "0"+hours
                            }
                            else
                            {
                                hours = hours;
                            }
                            var moment_current_date = moment(current_time).format('LL')
                            var now = hours+":"+mins+":00";

                            var time_in = data[0].time_in
                            var time_out = data[0].time_out
                            var attendance_status = data[0].attendance_status
                            var remarks = data[0].remarks
                            var proof_of_attendance_file_link = data[0].proof_of_attendance_file_link
                            var faculty_id = FACULTY_ID
                            var meeting_id = MEETING_ID
                            var id = data[0].id

                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/' + id,
                                type: "PUT",
                                data: JSON.stringify(
                                {		
                                    "time_in": now,
                                    "time_out": time_out,
                                    "attendance_status": "Present",
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
                                    // notification("success", "Success!"); 
                                    $(".button-block").prop('disabled', true); // disable button
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
                                },
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
                }
            });
        }
        // END TIME IN BUTTON FUNCTION

        // REQUEST TO EXCUSE BUTTON FUNCTION
        requestToExcuse = () => 
        {
            Swal.fire(
            {
                title: "Are you sure you?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes!",
            })
            .then(function (t) 
            {
                // if user clickes yes.
                if (t.value) 
                {
                    console.log("Excused")
                    $.ajax(
                    {
                        url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) 
                        {
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
                            if(hours < 10)
                            {
                                hours = "0"+hours
                            }
                            else
                            {
                                hours = hours;
                            }
                            var moment_current_date = moment(current_time).format('LL')
                            var now = hours+":"+mins+":00";

                            var time_in = data[0].time_in
                            var time_out = data[0].time_out
                            var attendance_status = data[0].attendance_status
                            var remarks = data[0].remarks
                            var proof_of_attendance_file_link = data[0].proof_of_attendance_file_link
                            var faculty_id = FACULTY_ID
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
                                    "attendance_status": "Request to Excuse",
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
                                    // notification("success", "Success!"); 
                                    $(".button-block").prop('disabled', true); // disable button
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
                                },
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
                }
            });
        }
        // END REQUEST TO EXCUSE BUTTON FUNCTION

        // TIME OUT BUTTON FUNCTION
        timeOut = () => 
        {
            Swal.fire(
            {
                title: "Are you sure you?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes!",
            })
            .then(function (t) 
            {
                // if user clickes yes.
                if (t.value) 
                {
                    $.ajax(
                    {
                        url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) 
                        {
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
                            if(hours < 10)
                            {
                                hours = "0"+hours
                            }
                            else
                            {
                                hours = hours;
                            }
                            var moment_current_date = moment(current_time).format('LL')
                            var now = hours+":"+mins+":00";

                            var time_in = data[0].time_in
                            var time_out = data[0].time_out
                            var attendance_status = data[0].attendance_status
                            var remarks = data[0].remarks
                            var proof_of_attendance_file_link = data[0].proof_of_attendance_file_link
                            var faculty_id = FACULTY_ID
                            var meeting_id = MEETING_ID
                            var id = data[0].id

                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/' + id,
                                type: "PUT",
                                data: JSON.stringify(
                                {		
                                    "time_in": time_in,
                                    "time_out": now,
                                    "attendance_status": attendance_status,
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
                                    // notification("success", "Success!");
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
                                },
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
                }
            });
        }
        // END TIME OUT BUTTON FUNCTION

        // FUNCTION TO CHANGE CONTENT
        function getMeetingDetails(){
            $.ajax({
                url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                type: "GET",
                dataType: "json",
                success: function (marfData) 
                {
                    $.ajax({
                        url: BASE_API + MEETING_ID,
                        type: "GET",
                        dataType: "JSON",
                        success: function (responseData) 
                        {   
                            console.log("This is it")
                            console.log(marfData)
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
                            if(hours < 10)
                            {
                                hours = "0"+hours
                            }
                            else
                            {
                                hours = hours;
                            }

                            var moment_current_date = moment(current_time).format('L')
                            var moment_meeting_date = moment(responseData.date).format('L');

                            var now = hours+":"+mins+":00";

                            var meeting_status = responseData.status

                            if(meeting_status == "On Going")
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
                                status = '<span class="badge badge-warning">Meeting Status: ' + responseData.status + '</span>'
                            }
                            else if(status == "Done" || status == "done")
                            {
                                status = '<span class="badge badge-success">Meeting Status: ' + responseData.status + '</span>'
                            } 
                            else if(status == "On Going")
                            {
                                status = '<span class="badge badge-info">Meeting Status: ' + responseData.status + '</span>'
                            }


                            // For meeting_view_content> div#row_left
                            var row_left = '<div class="col-12 col-sm-12 col-lg-12">' +
                                                '<div class="hero text-white hero-bg-image hero-bg-parallax"' +
                                                'style="background-image: url({{ URL::to("/images/designs/meeting_card_orange.png") }})">' +
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
                                                    '<br>' +
                                                    '<div class="hero-inner">' +
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
                                if(mins < 10)
                                {
                                    mins = "0"+mins
                                }
                                else
                                {
                                    mins = mins;
                                }
                                if(hours < 10)
                                {
                                    hours = "0"+hours
                                }
                                else
                                {
                                    hours = hours;
                                }
                                

                                var moment_current_date = moment(current_time).format('L')
                                var moment_meeting_date = moment(responseData.date).format('L');

                                var now = hours+":"+mins+":00";
                                
                                if(marfData[0].time_in == null)
                                {

                                    //20:07        //19:38               //19:51           //20:38             
                                    if(moment_meeting_date == moment_current_date && now >= responseData.start_time &&  now <= responseData.end_time) 
                                    {
                                        console.log(marfData[0])
                                        if(marfData[0].attendance_status == null)
                                        {
                                            row_right_top +=    '<div class="col-12">' +
                                                                '<button type="button" onClick="return timeIn()" class="btn btn-icon icon-left btn-success btn-lg button-block"><i class="fas fa-check"></i> Time in</button>' +
                                                                '</div>' +
                                                                '<br>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="requestToExcuse()" class="btn btn-icon icon-left btn-danger btn-lg button-block"> Request to Excuse </button>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                        else if (marfData[0].attendance_status == "Request to Excuse" || marfData[0].attendance_status == "Excused")
                                        {
                                            var modalTab02 = '<h6 class="text-muted">Upload Reason Why</h6>';
                                            $("#tab02").html(modalTab02);
                                            var headerForTab2 = 'Reason Why....';
                                            $("#header5forTab2").html(headerForTab2);

                                            row_right_top +=    '<div class="alert alert-light alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    'Request Submitted, Please Upload a Valid reason to Check' +
                                                                '</div>' +
                                                                '</div>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-warning btn-lg button-block"><b>Upload</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                        
                                    }
                                    else if(moment_meeting_date == moment_current_date && now < responseData.start_time &&  now < responseData.end_time) 
                                    {
                                        row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Meeting is not yet started, please wait.</b>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<br>';
                                    }
                                    else if(moment_meeting_date > moment_current_date) 
                                    {
                                        
                                        row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Meeting is not yet started, please wait.</b>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<br>';
                                    }
                                    else if(moment_meeting_date < moment_current_date) 
                                    {
                                        if(marfData[0].attendance_status == null)
                                        {
                                            row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Meeting was already done</b>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                        else if (marfData[0].attendance_status == "Request to Excuse" || marfData[0].attendance_status == "Excused")
                                        {
                                            var modalTab02 = '<h6 class="text-muted">Upload Reason Why</h6>';
                                            $("#tab02").html(modalTab02);
                                            var headerForTab2 = 'Reason Why....';
                                            $("#header5forTab2").html(headerForTab2);

                                            if(marfData[0].proof_of_attendance_file_link == null)
                                            {
                                                row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Meeting was already done. Your Request was also Submitted, Please Upload a Valid reason to Check</b>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-warning btn-lg button-block"><b>Upload Reason Why</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                            }
                                            else
                                            {
                                                row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Meeting was already done. You was also Request Submitted, Please Upload a Valid reason to Check</b>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-warning btn-lg button-block"><b>Check my Uploaded Reason Why</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                            }
                                        }
                                        console.log("559")
                                        
                                    }
                                    else if(moment_meeting_date > moment_current_date || now > responseData.start_time &&  now > responseData.end_time) 
                                    {
                                        console.log("570")
                                        console.log("Pending to On Going 299")
                                        console.log("Now: "+now)
                                        console.log("Meeting Date: " + moment_meeting_date)
                                        console.log("Current Date: " + moment_current_date)
                                        console.log("Start Time: " + responseData.start_time)
                                        console.log("End Time: " + responseData.end_time)
                                        console.log(marfData[0].attendance_status)
                                        if(marfData[0].attendance_status == null)
                                        {
                                            row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Meeting was already done</b>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                        else if (marfData[0].attendance_status == "Request to Excuse" || marfData[0].attendance_status == "Excused")
                                        {
                                            var modalTab02 = '<h6 class="text-muted">Upload Reason Why</h6>';
                                            $("#tab02").html(modalTab02);
                                            var headerForTab2 = 'Reason Why....';
                                            $("#header5forTab2").html(headerForTab2);

                                            if(marfData[0].proof_of_attendance_file_link == null)
                                            {
                                                row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Meeting was already done. Your Request was also Submitted, Please Upload a Valid reason to Check</b>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-warning btn-lg button-block"><b>Upload Reason Why</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                            }
                                            else
                                            {
                                                row_right_top +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Meeting was already done. Your Request was also Submitted, Please Upload a Valid reason to Check</b>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-warning btn-lg button-block"><b>Check my Uploaded Reason Why</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    if(marfData[0].time_out == null)
                                    {
                                        if(moment_meeting_date == moment_current_date && now >= responseData.start_time &&  now <= responseData.end_time)
                                        {
                                            row_right_top +=    '<div class="alert alert-info alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        'You already Timed In. Please wait for the meeting to end. <b>Note: </b> Please time out within 10 mins after the meeting, and upload your proof of attendance.' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                        else if(moment_meeting_date == moment_current_date && now > responseData.start_time &&  now > responseData.end_time)
                                        {
                                            row_right_top +=    '<div class="alert alert-light alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="far fa-lightbulb"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Note: </b> Please time out within 10 mins after the meeting, and upload your proof of attendance.' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="return timeOut()" class="btn btn-icon icon-left btn-success btn-lg button-block"><b>Time Out</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                        else if(moment_meeting_date < moment_current_date)
                                        {
                                            row_right_top +=    '<div class="alert alert-light alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="far fa-lightbulb"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        '<b>Note: </b> Please time out, and upload your proof of attendance.' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="return timeOut()" class="btn btn-icon icon-left btn-success btn-lg button-block"><b>Time Out</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                        }
                                    }
                                    else
                                    {
                                        if(marfData[0].meeting_submitted.length == 0)
                                        {
                                            console.log("Marf Data")
                                            console.log(marfData[0].meeting_submitted)
                                            if (marfData[0].proof_of_attendance_file_link != null)
                                            {
                                                var modalTab02 = '<h6 class="text-muted">Upload Link</h6>';
                                                $("#tab02").html(modalTab02);
                                                var headerForTab2 = 'Upload Link';
                                                $("#header5forTab2").html(headerForTab2);
                                                
                                                console.log("Marf Data")
                                                console.log(marfData[0].meeting_submitted)
                                                console.log("Meeting Submitted not equal to zero")
                                                row_right_top +=    '<div class="alert alert-light alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        'You already Timed Out and Meeting was already done.' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-success btn-lg button-block"><b>Check Uploaded Files / Link</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                            }
                                            else
                                            {
                                                var modalTab02 = '<h6 class="text-muted">Upload Link</h6>';
                                                $("#tab02").html(modalTab02);
                                                var headerForTab2 = 'Upload Link';
                                                $("#header5forTab2").html(headerForTab2);

                                                console.log("Marf Data")
                                                console.log(marfData[0].meeting_submitted)
                                                console.log("Meeting Submitted equal to zero")
                                                row_right_top +=    '<div class="alert alert-light alert-has-icon">' +
                                                                    '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                    '<div class="alert-body text-center">' +
                                                                        'You already Timed Out and Meeting was already done.' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-12">' +
                                                                    '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-warning btn-lg button-block"><b>Upload a Proof of Attendance (File / Link)</b></button>' +
                                                                '</div>' +
                                                                '<br>';
                                            }
                                        }
                                        else
                                        {
                                            console.log("Marf Data")
                                            console.log(marfData[0].meeting_submitted)
                                            var modalTab02 = '<h6 class="text-muted">Upload Link</h6>';
                                            $("#tab02").html(modalTab02);
                                            var headerForTab2 = 'Upload Link';
                                            $("#header5forTab2").html(headerForTab2);
                                            
                                            console.log("Meeting Submitted not equal to zero")
                                            row_right_top +=    '<div class="alert alert-light alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    'You already Timed Out and Meeting was already done.' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="col-12">' +
                                                                '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-success btn-lg button-block"><b>Check Uploaded Files / Link</b></button>' +
                                                            '</div>' +
                                                            '<br>';
                                        }   
                                    }
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
                                $("#row_right").html(row_right_top);
                                $("#row_right").append(row_right_bottom);
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
                }
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
                        return `${moment(row.date).format('LL')} <br> ${moment("2022-06-27 "+data).format('LT')} - ${moment("2022-06-27 "+row.end_time).format('LT')}`
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

        // PROOF LINK - ON UPLOAD FILES MODAL
        $.ajax(
        {
            url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
            type: "GET",
            dataType: "json",
            success: function (data) 
            {
                if (data[0].proof_of_attendance_file_link == null)
                { 
                    if (data[0].time_in != null)
                    {
                        var LinkOrReasonContent =   `<input type="text" class="form-control" id="proof_of_attendance_file_link" name="proof_of_attendance_file_link"
                                                    placeholder="Link" tabindex="1" required>`;
                        $("#LinkOrReasonContent").html(LinkOrReasonContent);
                        var proofSubmitBtn = "Submit";
                        $("#proofCreateBtn").html(proofSubmitBtn);

                        $('#proofLinkForm').on('submit', function(e){
                            e.preventDefault();

                            var proof_of_attendance_link = $("#proof_of_attendance_file_link").val()
                            console.log(proof_of_attendance_link);
                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                                type: "GET",
                                dataType: "json",
                                success: function (data) 
                                { 
                                    var time_in = data[0].time_in
                                    var time_out = data[0].time_out
                                    var attendance_status = data[0].attendance_status
                                    var proof_of_attendance_file_link = proof_of_attendance_link
                                    var faculty_id = FACULTY_ID
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
                                            "faculty_id": faculty_id,
                                            "meeting_id": meeting_id,
                                        }),
                                        dataType: "JSON",
                                        contentType: 'application/json',
                                        processData: false,
                                        cache: false,
                                        success: function (responseJSON) 
                                        {
                                            notification("success", "Success!");
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
                                        },
                                    }); 
                                }
                            })
                        });
                    }
                    else
                    {
                        var LinkOrReasonContent =   `<textarea class="form-control" rows="4" cols="50" id="proof_of_attendance_file_link" 
                                                    name="proof_of_attendance_file_link" form="createForm" placeholder="" tabindex="1" required></textarea>`;
                        $("#LinkOrReasonContent").html(LinkOrReasonContent);
                        var proofSubmitBtn = "Submit";
                        $("#proofCreateBtn").html(proofSubmitBtn);

                        $('#proofLinkForm').on('submit', function(e){
                            e.preventDefault();
                            Swal.fire(
                            {
                                title: "Are you sure you?",
                                text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: !0,
                                confirmButtonColor: "#34c38f",
                                cancelButtonColor: "#f46a6a",
                                confirmButtonText: "Yes!",
                            })
                            .then(function (t) 
                            {
                                // if user clickes yes.
                                if (t.value) 
                                {
                                    var proof_of_attendance_link = $("#proof_of_attendance_file_link").val()
                                    console.log(proof_of_attendance_link);
                                    $.ajax(
                                    {
                                        url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                                        type: "GET",
                                        dataType: "json",
                                        success: function (data) 
                                        { 
                                            var time_in = data[0].time_in
                                            var time_out = data[0].time_out
                                            var attendance_status = data[0].attendance_status
                                            var proof_of_attendance_file_link = proof_of_attendance_link
                                            var faculty_id = FACULTY_ID
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
                                                    "faculty_id": faculty_id,
                                                    "meeting_id": meeting_id,
                                                }),
                                                dataType: "JSON",
                                                contentType: 'application/json',
                                                processData: false,
                                                cache: false,
                                                success: function (responseJSON) 
                                                {
                                                    notification("success", "Success!");
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
                                                },
                                            }); 
                                        }
                                    })
                                }
                            }); 
                        });
                    }
                }
                else
                {
                    console.log(data)
                    if (data[0].attendance_status == "Request to Excuse" || data[0].attendance_status == "Excused")
                    {
                        // var proofSubmitBtn = "Update";
                        // $("#proofCreateBtn").html(proofSubmitBtn);
                        document.getElementById('proofCreateBtn').style.visibility = 'hidden'
                        $('#proof_of_attendance_file_link').val(data[0].proof_of_attendance_file_link);

                        var LinkOrReasonContent =   '<div class="col-md-12">' +
                                                        '<span style="white:space: pre-line; text-align: justify; display:block;">&emsp;' + data[0].proof_of_attendance_file_link +   
                                                    '</div>';
                        $("#LinkOrReasonContent").html(LinkOrReasonContent);
                    }
                    else
                    {
                        console.log(data[0])
                        var LinkOrReasonContent =   `<input type="text" class="form-control" id="proof_of_attendance_file_link" name="proof_of_attendance_file_link"
                                                    placeholder="Link" tabindex="1" required>`;
                        $("#LinkOrReasonContent").html(LinkOrReasonContent);
                        var proofSubmitBtn = "Update";
                        $("#proofCreateBtn").html(proofSubmitBtn);
                        $('#proof_of_attendance_file_link').val(data[0].proof_of_attendance_file_link);

                        $('#proofLinkForm').on('submit', function(e){
                            e.preventDefault();
                            var proof_of_attendance_link = $("#proof_of_attendance_file_link").val()
                            console.log(proof_of_attendance_link);
                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/meeting_attendance_required_faculty_list/search_specific_meeting_and_faculty/' + MEETING_ID + "/" + FACULTY_ID,
                                type: "GET",
                                dataType: "json",
                                success: function (data) 
                                { 
                                    var time_in = data[0].time_in
                                    var time_out = data[0].time_out
                                    var attendance_status = data[0].attendance_status
                                    var proof_of_attendance_file_link = proof_of_attendance_link
                                    var faculty_id = FACULTY_ID
                                    var meeting_id = MEETING_ID
                                    var id = data[0].id
                                    notification("success", "Link");
                                    console.log(data)
                                }
                            });
                        });
                    }
                }
            }
        });
        // END PROOF LINK - ON UPLOAD FILES MODAL

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
