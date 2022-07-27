
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity_view/'
        var ATTENDANCE_API = APP_URL + '/api/v1/activity_attendance/'
        var ATTENDANCE_PROOF = APP_URL + '/api/v1/activity_submitted_proof/'
        var ACTIVITY_ID = "{{$activity_id}}"

        var USER_ROLE = JSON.parse(USER_DATA)
        var DATA_USER = JSON.parse(USER_DATA)

        let FACULTY_ID = DATA_USER.faculty.id
        var AA_FACULTY_ID = ""
        // END OF GLOBAL VARIABLE

        removeLoader()

        function refresh(){
            let url = ATTENDANCE_API+"search/"+ACTIVITY_ID

            requiredFacultyDatatable.ajax.url(url).load()
        }

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

        $(".tabs-2").click(function(){
            
            $(".tabs-2").removeClass("active");
            $(".tabs-2 h6").removeClass("font-weight-bold");    
            $(".tabs-2 h6").addClass("text-muted");    
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
            url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
            type: "GET",
            dataType: "json",
            success: function (marfData) 
            {
                var marf_list_id = marfData[0].id
                $("#fileupload").dropzone({ 
                    url: APP_URL+'/api/v1/activity_submitted_proof/file_uploads',
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
                            url: APP_URL+'/api/v1/activity_attendance/' + marf_list_id ,
                            type: "GET",
                            dataType: "JSON",
                            success: function (data) 
                            {   
                                console.log(data)
                                $.each(data.activity_submitted, function(i){
                                    let mockFile = { name: data.activity_submitted[i].file_name,
                                                    id: data.activity_submitted[i].id,
                                                    path: APP_URL + "/" + data.activity_submitted[i].file_link_directory
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
                            "aa_faculty_id": marf_list_id,
                            "file_link_directory": data,
                            "file_name": response.upload.filename
                        }]
                        // ajax opening tag
                        $.ajax({
                            url: APP_URL + '/api/v1/activity_submitted_proof/multi_insert',
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
                                    url: APP_URL+'/api/v1/activity_submitted_proof/destroy/' + file.id,
                                    method: "DELETE",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },

                                    success: function(data){
                                        notification('error', 'Submitted Proof')
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
                        url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) 
                        {
                            var start_date_hours = new Date(data.start_datetime).getHours();
                            var start_date_mins = new Date(data.start_datetime).getMinutes();

                            var end_date_hours = new Date(data.end_datetime).getHours();
                            var end_date_mins = new Date(data.end_datetime).getMinutes();

                            var current_time = new Date(); // current time
                            var hours = current_time.getHours();
                            var mins = current_time.getMinutes();
            
                            var moment_current_date = moment(current_time).format('YYYY-MM-DD')
                            var moment_start_date = moment(data.start_datetime).format('L');
                            var moment_end_date = moment(data.end_datetime).format('L');

                            var start_time = start_date_hours + ":" + start_date_mins + ":00"
                            var end_time = end_date_hours + ":" + end_date_mins + ":00"

                            var now = moment_current_date + " " + hours+":"+mins+":00"


                            var time_in = data[0].time_in
                            var time_out = data[0].time_out
                            var attendance_status = data[0].attendance_status
                            var remarks = data[0].remarks
                            var status = data[0].status
                            var proof_of_attendance_file_link = data[0].proof_of_attendance_file_link
                            var faculty_id = FACULTY_ID
                            var activity_id = ACTIVITY_ID
                            var id = data[0].id

                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/activity_attendance/' + id,
                                type: "PUT",
                                data: JSON.stringify(
                                {		
                                    "time_in": now,
                                    "time_out": time_out,
                                    "attendance_status": "Present",
                                    "remarks": remarks,
                                    "status": status,
                                    "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                    "faculty_id": faculty_id,
                                    "activity_id": ACTIVITY_ID,
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
                        url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) 
                        {
                            var time_in = data[0].time_in
                            var time_out = data[0].time_out
                            var attendance_status = data[0].attendance_status
                            var remarks = data[0].remarks
                            var status = data[0].status
                            var proof_of_attendance_file_link = data[0].proof_of_attendance_file_link
                            var faculty_id = FACULTY_ID
                            var activity_id = ACTIVITY_ID
                            var id = data[0].id

                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/activity_attendance/' + id,
                                type: "PUT",
                                data: JSON.stringify(
                                {		
                                    "time_in": time_in,
                                    "time_out": time_out,
                                    "attendance_status": "Request to Excuse",
                                    "remarks": remarks,
                                    "status": status,
                                    "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                    "faculty_id": faculty_id,
                                    "ACTIVITY_ID": ACTIVITY_ID,
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
                        url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) 
                        {
                            var start_date_hours = new Date(data.start_datetime).getHours();
                            var start_date_mins = new Date(data.start_datetime).getMinutes();

                            var end_date_hours = new Date(data.end_datetime).getHours();
                            var end_date_mins = new Date(data.end_datetime).getMinutes();

                            var current_time = new Date(); // current time
                            var hours = current_time.getHours();
                            var mins = current_time.getMinutes();
            
                            var moment_current_date = moment(current_time).format('YYYY-MM-DD')
                            var moment_start_date = moment(data.start_datetime).format('L');
                            var moment_end_date = moment(data.end_datetime).format('L');

                            var start_time = start_date_hours + ":" + start_date_mins + ":00"
                            var end_time = end_date_hours + ":" + end_date_mins + ":00"

                            var now = moment_current_date + " " + hours+":"+mins+":00"

                            var time_in = data[0].time_in
                            var time_out = data[0].time_out
                            var attendance_status = data[0].attendance_status
                            var remarks = data[0].remarks
                            var status = data[0].status
                            var proof_of_attendance_file_link = data[0].proof_of_attendance_file_link
                            var faculty_id = FACULTY_ID
                            var activity_id = ACTIVITY_ID
                            var id = data[0].id

                            $.ajax(
                            {
                                url: APP_URL + '/api/v1/activity_attendance/' + id,
                                type: "PUT",
                                data: JSON.stringify(
                                {		
                                    "time_in": time_in,
                                    "time_out": now,
                                    "attendance_status": attendance_status,
                                    "remarks": remarks,
                                    "status": status,
                                    "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                    "faculty_id": faculty_id,
                                    "ACTIVITY_ID": ACTIVITY_ID,
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
        
        function getActivity(){
            $.ajax({
                url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                type: "GET",
                dataType: "json",
                success: function (marfData) 
                {
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
                                hero_body = '<span><b>Description: </b> <br>' +
                                            '<span class="" style="white-space: pre-line; text-align: justify; display:block;" id="description">' +
                                                '&emsp;&emsp;&nbsp;' + data.description +
                                            '</span>';
                            }
                            else if (data.activity_type.category == "Meeting")
                            {
                                var agenda = data.agenda;
                                var description = data.description

                                if(agenda == null)
                                {
                                    agenda = "No agenda given"
                                }
                                else
                                {
                                    agenda = data.agenda;
                                }
                                hero_body = '<span style="font-size: 16px"><b>Agenda: </b> <br>' +
                                            '<span class="" style="white-space: pre-line; text-align: justify; display:block;" id="agenda">' +
                                                agenda +
                                            '</span>' +
                                            '<br>' +
                                            '<span><b>Description: </b> <br>' +
                                            '<span class="" style="white-space: pre-line; text-align: justify; display:block;" id="description">' +
                                                description +
                                            '</span>';
                            }

                            $('#hero_body').html(hero_body);

                            if(data.is_required == 0){
                                is_required_view = "Not required to attend"
                            } else{
                                is_required_view = "Required to attend"
                            }

                            var hero_header =   
                                                '<div class="row">' +
                                                    '<div class="col-md-10">' +
                                                        '<h3 class="text-center"><span id="title"><i class="fa fa-users"aria-hidden="true"></i> &nbsp;' +
                                                            data.title +
                                                        '</span></h3>' +
                                                    '</div>' +
                                                    '<div class="col-md-2">' +
                                                        '<div>' +
                                                            '<button type="button" class="btn btn-primary"' +
                                                            'data-toggle="modal" data-target="#memo_card" role="button" aria-expanded="false" aria-controls="memo_card"' +
                                                            '>View Memo</button>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<br>' +
                                                '<div class="col-12">' +
                                                    '<span class="badge badge-info">' +
                                                        '<span>Posted by </span><span id="created_by">' +
                                                            data.created_by_user.faculty.last_name + ", " + data.created_by_user.faculty.first_name +
                                                        '</span>' +
                                                    '</span>' +
                                                    '<div class="text-dark float-right">' +
                                                        '<span class="badge badge-warning">' +
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
                                activity_status = '<span class="badge badge-warning"><span>Pending</span></span>';
                            }
                            else if(activity_status == "On Going")
                            {
                                activity_status = '<span class="badge badge-warning"><span>On Going</span></span>';
                            }
                            else if(activity_status == "Done")
                            {
                                activity_status = '<span class="badge badge-warning"><span>Done</span></span>';
                            }


                            var right_side = "";

                            if(marfData[0].time_in == null)
                            {
                                //20:07        //19:38               //19:51           //20:38             
                                if((moment_current_date >= moment_start_date && moment_current_date <= moment_end_date)) 
                                {
                                    if(marfData[0].attendance_status == null)
                                    {
                                        right_side +=    '<div class="col-12">' +
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

                                        right_side +=    '<div class="alert alert-light alert-has-icon">' +
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
                                else if(moment_start_date == moment_current_date && now < start_time &&  now < end_time) 
                                {
                                    right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                            '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                            '<div class="alert-body text-center">' +
                                                                '<b>Not yet started, please wait.</b>' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<br>';
                                }
                                else if(moment_start_date > moment_current_date) 
                                {
                                    
                                    right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                            '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                            '<div class="alert-body text-center">' +
                                                                '<b>Not yet started, please wait.</b>' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<br>';
                                }
                                else if(moment_end_date < moment_current_date) 
                                {
                                    if(marfData[0].attendance_status == null)
                                    {
                                        right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Already done</b>' +
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
                                            right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Already done. Your request was also submitted, Please upload a valid reason to check</b>' +
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
                                            right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Already done. You was also request submitted, Please upload a valid reason to check</b>' +
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
                                else if(moment_end_date == moment_current_date || now > start_time &&  now > end_time) 
                                {
                                    if(marfData[0].attendance_status == null)
                                    {
                                        right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Already done</b>' +
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
                                            right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Already done. Your request was also submitted, Please upload a valid reason to Check</b>' +
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
                                            right_side +=    '<div class="alert alert-secondary alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fa fa-exclamation" aria-hidden="true"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Already done. Your request was also submitted, Please upload a valid reason to check</b>' +
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
                                    console.log("Here1")
                                    console.log(moment_current_date)
                                    console.log(moment_start_date)
                                    console.log(moment_end_date)
                                    if((moment_end_date == moment_current_date) && (now > start_time &&  now > end_time))
                                    {
                                        right_side +=    '<div class="alert alert-light alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="far fa-lightbulb"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    '<b>Note: </b> Please time out within 10 mins after the activity, and upload your proof of attendance.' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<div class="col-12">' +
                                                                '<button type="button" onClick="return timeOut()" class="btn btn-icon icon-left btn-success btn-lg button-block"><b>Time Out</b></button>' +
                                                            '</div>' +
                                                            '<br>';
                                    }
                                    else if((moment_current_date >= moment_start_date && moment_current_date <= moment_end_date))
                                    {
                                        console.log("Here2")
                                        right_side +=    '<div class="alert alert-info alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    'You already Timed In. Please wait for the activity to end. <b>Note: </b> Please time out within 10 mins after the activity, and upload your proof of attendance.' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<br>';
                                    }
                                    else if(moment_end_date < moment_current_date)
                                    {
                                        right_side +=    '<div class="alert alert-light alert-has-icon">' +
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
                                    if(marfData[0].activity_submitted.length == 0)
                                    {
                                        if (marfData[0].proof_of_attendance_file_link != null)
                                        {
                                            var modalTab02 = '<h6 class="text-muted">Upload Link</h6>';
                                            $("#tab02").html(modalTab02);
                                            var headerForTab2 = 'Upload Link';
                                            $("#header5forTab2").html(headerForTab2);
                                            
                                            right_side +=    '<div class="alert alert-light alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    'You already Timed Out and Activity was already done.' +
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

                                            right_side +=    '<div class="alert alert-light alert-has-icon">' +
                                                                '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                                '<div class="alert-body text-center">' +
                                                                    'You already Timed Out and Activity was already done.' +
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

                                        var modalTab02 = '<h6 class="text-muted">Upload Link</h6>';
                                        $("#tab02").html(modalTab02);
                                        var headerForTab2 = 'Upload Link';
                                        $("#header5forTab2").html(headerForTab2);
                                        
                                        right_side +=    '<div class="alert alert-light alert-has-icon">' +
                                                            '<div class="alert-icon"><i class="fas fa-check"></i></div>' +
                                                            '<div class="alert-body text-center">' +
                                                                'You already Timed Out and Activity was already done.' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<div class="col-12">' +
                                                            '<button type="button" onClick="" data-toggle="modal" data-target="#myModal" class="btn btn-icon icon-left btn-success btn-lg button-block"><b>Check Uploaded Files / Link</b></button>' +
                                                        '</div>' +
                                                        '<br>';
                                    }   
                                }
                            }

                            right_side +=   '<div class="hero text-white hero-bg-image hero-bg-parallax"' +
                                                `style="background-image: url({{ URL::to('/images/designs/green_activity.png') }})">` +
                                                '<div class="hero-inner">' +
                                                    '<div class="row"> ' +
                                                        '<div class="d-flex justify-content-between col-md-9">' +
                                                            '<h5> <i class="fa fa-info-circle"></i> Activity Details</h5>' +
                                                        '</div>' +
                                                    '</div>' +          
                                                '</div>' +
                                                '<div class="card-body">' +
                                                    '<div class="row">' +
                                                        '<div class="col-md-6">' +
                                                            '<div class="form-group" style="margin-bottom: 0px">' +
                                                                '<label class="font-weight-bold text-warning" for="">Start time:</label>' +
                                                                '<p>' +
                                                                    data.start_datetime +
                                                                '</p>' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<div class="col-md-6">' +
                                                            '<div class="form-group" style="margin-bottom: 0px">' +
                                                                '<label class="font-weight-bold text-warning" for="">End time:</label>' +
                                                                '<p>' +
                                                                    data.end_datetime +
                                                                '</p>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                    '<div class="row">' +
                                                        '<div class="col-6">' +
                                                            '<div class="form-group" style="margin-bottom: 0px">' +
                                                                '<label class="font-weight-bold text-warning" for="">Location:</label>' +
                                                                '<p>' +
                                                                    data.location +
                                                                '</p>' +
                                                            '</div>' +
                                                        '</div>' +
                                                        '<div class="col-6">' +
                                                            '<div class="form-group" style="margin-bottom: 0px">' +
                                                                '<label class="font-weight-bold text-warning" for="">Status:</label>' +
                                                                '<p>' +
                                                                    activity_status +
                                                                '</p>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>';

                            $('#right_side').html(right_side);
                            
                            
                            $('#is_required').html(is_required_view);
                            $('#location').html(data.location);

                            //$('#created_at_view').html(created_at);

                            // console.log(data.memorandum_file_directory)
                            //document.getElementById("memorandum_view").src=APP_URL + data.memorandum_file_directory;
                            //$('#memorandum_view').src("{{ asset('" + data.memorandum_file_directory + "') }}")

                            if(data.memorandum_file_directory == "NA"){
                                $('#if_memo').html("<span>No Memorandum uploaded</span>")
                            }
                            else{
                                $('#if_memo').html('<div class="embed-responsive embed-responsive-16by9">'
                                +'<iframe id="memo" class="embed-responsive-item" src="..."></iframe></div>')
                                
                                document.getElementById("memo").src=APP_URL + "/" +data.memorandum_file_directory;
                            }
                        }
                    // ajax closing tag
                    })
                }
            })
        }
        getActivity()

        // CHECK STATUS OF ATTENDANCE AND OR IF INCLUDED
        $.ajax({
            url: APP_URL+"/api/v1/faculty/"+USER_ROLE.faculty.id,
            method: "GET",
            dataType: "JSON",
            headers: {
                "Accept": "application/json",
                "Authorization": API_TOKEN,
                "Content-Type": "application/json"
            },
            success: function(data){
                let arrayOfActivity = []
                $.each(data.activity_attendance_required_faculty_list, function(i){
                    arrayOfActivity.push({"activity_id":data.activity_attendance_required_faculty_list[i].activity_id,
                                        "attendance_id":data.activity_attendance_required_faculty_list[i].id})
                })
                for (var i=0; i < arrayOfActivity.length; i++) {
                    if (arrayOfActivity[i].activity_id === ACTIVITY_ID) {
                        attendance_id = arrayOfActivity[i].attendance_id
                        AA_FACULTY_ID = attendance_id
                    }
                }
            },
            error: function(error){ 
                console.log(error)
                console.log(`message: ${error.responseJSON.message}`)
                console.log(`status: ${error.status}`)

                $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
            }
        })
        // ajax closing tag


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
                    { data: "attendance_status", render: function(data, type, row){
                        if (data == null){
                            return "-----"
                        }
                        else{
                            return data
                        }
                    }},
                    { data: "time_in", render: function(data, type, row){
                        if (data == null){
                            return "-----"
                        }
                        else{
                            return moment(data).format('LLL')
                        }
                    }},
                    { data: "time_out", render: function(data, type, row){
                        if (data == null){
                            return "-----"
                        }
                        else{
                            return moment(data).format('LLL')
                        }
                    }},
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 2] }],
                "order": [[1, "desc"]]
                });
        };
        requiredFacultyDatatable()

    

        // PROOF LINK - ON UPLOAD FILES MODAL
        $.ajax(
        {
            url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
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
                                url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                                type: "GET",
                                dataType: "json",
                                success: function (data) 
                                { 
                                    var time_in = data[0].time_in
                                    var time_out = data[0].time_out
                                    var attendance_status = data[0].attendance_status
                                    var proof_of_attendance_file_link = proof_of_attendance_link
                                    var faculty_id = FACULTY_ID
                                    var activity_id = ACTIVITY_ID
                                    var id = data[0].id

                                    $.ajax(
                                    {
                                        url: APP_URL + '/api/v1/activity_attendance/' + id,
                                        type: "PUT",
                                        data: JSON.stringify(
                                        {		
                                            "time_in": time_in,
                                            "time_out": time_out,
                                            "attendance_status": attendance_status,
                                            "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                            "faculty_id": faculty_id,
                                            "activity_id": ACTIVITY_ID,
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
                                        url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                                        type: "GET",
                                        dataType: "json",
                                        success: function (data) 
                                        { 
                                            var time_in = data[0].time_in
                                            var time_out = data[0].time_out
                                            var attendance_status = data[0].attendance_status
                                            var proof_of_attendance_file_link = proof_of_attendance_link
                                            var faculty_id = FACULTY_ID
                                            var activity_id = ACTIVITY_ID
                                            var id = data[0].id

                                            $.ajax(
                                            {
                                                url: APP_URL + '/api/v1/activity_attendance/' + id,
                                                type: "PUT",
                                                data: JSON.stringify(
                                                {		
                                                    "time_in": time_in,
                                                    "time_out": time_out,
                                                    "attendance_status": attendance_status,
                                                    "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                                    "faculty_id": faculty_id,
                                                    "activity_id": ACTIVITY_ID,
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
                                url: APP_URL + '/api/v1/activity_attendance/search_specific_activity_and_faculty/' + ACTIVITY_ID + "/" + FACULTY_ID,
                                type: "GET",
                                dataType: "json",
                                success: function (data) 
                                { 
                                    var time_in = data[0].time_in
                                    var time_out = data[0].time_out
                                    var attendance_status = data[0].attendance_status
                                    var proof_of_attendance_file_link = proof_of_attendance_link
                                    var faculty_id = FACULTY_ID
                                    var activity_id = ACTIVITY_ID
                                    var id = data[0].id

                                    $.ajax(
                                    {
                                        url: APP_URL + '/api/v1/activity_attendance/' + id,
                                        type: "PUT",
                                        data: JSON.stringify(
                                        {		
                                            "time_in": time_in,
                                            "time_out": time_out,
                                            "attendance_status": attendance_status,
                                            "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                            "faculty_id": faculty_id,
                                            "activity_id": ACTIVITY_ID,
                                        }),
                                        dataType: "JSON",
                                        contentType: 'application/json',
                                        processData: false,
                                        cache: false,
                                        success: function (responseJSON) 
                                        {
                                            notification("info", "Link");
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
                            });
                        });
                    }
                }
            }
        });
        // END PROOF LINK - ON UPLOAD FILES MODAL
        

        $(document).on("click", "#proof_link_submit", function(){

            //activity_id = this.id
            date = new Date()

            let data = {
            "time_out": moment(date).format('YYYY[-]MM[-]DD HH:mm:ss'),
            "attendance_status": "Attended",
            "status": "For checking",
            "proof_of_attendance_file_link": $('#proof_link').val(),
            }

                $.ajax({
                    url: ATTENDANCE_API + "time-in-out/" + ACTIVITY_ID + "/" +USER_ROLE.faculty.id,
                    method: "PUT",
                    data: JSON.stringify(data),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },

                    success: function(data){
                        $('#timeOutModal').modal('hide');
                        notification("info", "Time out")

                        location.reload()
                    },
                    error: function(error){
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)

                        $.each(error.responseJSON.errors, function(key, value){
                                swalAlert('warning', value)
                        })
                    }
                // ajax closing tag
                })

            });

            $(document).on("click", ".view-proof-btn", function(){

                $.ajax({
                    url: ATTENDANCE_API + AA_FACULTY_ID,
                    method: "GET",
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },

                    success: function(data){
                        $("#proof_link_view").val(data.proof_of_attendance_file_link);
                        $("#proof_status").html(data.status);

                        if(data.remarks == null){
                            $("#proof_remarks").html("No Remarks");
                        }
                        else{
                            $("#proof_remarks").html(data.remarks);
                        }
                        
                        // $('#timeOutModal').modal('hide');
                        // notification("info", "Time out")

                        // location.reload()
                    },
                    error: function(error){
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)

                        $.each(error.responseJSON.errors, function(key, value){
                                swalAlert('warning', value)
                        })
                    }
                // ajax closing tag
                })

            });

            $(document).on("click", "#proof_link_edit", function(){

                let data = {
                "status": "For checking",
                "proof_of_attendance_file_link": $('#proof_link_view').val(),
                }

                    $.ajax({
                        url: ATTENDANCE_API + "time-in-out/" + ACTIVITY_ID + "/" +USER_ROLE.faculty.id,
                        method: "PUT",
                        data: JSON.stringify(data),
                        dataType: "JSON",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },

                        success: function(data){
                            $('#timeOutModal').modal('hide');
                            notification("info", "URL Edited")

                            location.reload()
                        },
                        error: function(error){
                            console.log(error)
                            console.log(`message: ${error.responseJSON.message}`)
                            console.log(`status: ${error.status}`)

                            $.each(error.responseJSON.errors, function(key, value){
                                    swalAlert('warning', value)
                            })
                        }
                    // ajax closing tag
                    })

                });


    });
</script>
