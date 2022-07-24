
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

                    console.log(data)

                    date = moment(new Date).format()

                    let created_at = moment(data.created_at).format('LLL');
                    let status = (data.deleted_at === null) ? 'Active' : 'Inactive';
                    let is_required_view = ""

                    currentDate = moment(new Date()).format('LLL');

                    $('#id_view').html(data.id);
                    $('#title').html(data.title);
                    $('#description').html(data.description);
                    $('#start_time').html(moment(data.start_datetime).format('LLL'));
                    $('#end_time').html(moment(data.end_datetime).format('LLL'));
                    $('#act_type').html(data.activity_type.title); 
                    $('#created_by').html(data.created_by_user.faculty.first_name); 
                    console.log(data.activity_type)  

                    if(data.is_required == 0){
                        is_required_view = "Not required to attend"
                    } else{
                        is_required_view = "Required to attend"
                    }

                    if(moment(data.start_datetime).format('LLL') >= currentDate &&
                        moment(data.end_datetime).format('LLL') < currentDate){
    
                        document.getElementById("time_button").id = "newid";
                    }

                    if(moment(data.start_datetime).format() < date && moment(data.end_datetime).format() > date){
                        $('#status').html(`<span class="badge badge-warning">
                                <span>Ongoing</span>
                                </span>`);
                    }
                    else if(date > moment(data.end_datetime).format()){
                        $('#status').html(`<span class="badge badge-warning">
                                <span>Ended</span>
                                </span>`);
                        //$('#status').addClass('text-success');
                    }
                    else{
                        $('#status').html(`<span class="badge badge-warning">
                                <span>Pending</span>
                                </span>`);
                        //$('#status').addClass('text-warning');
                    }
                    
                    
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
            });
        }

        getActivity()

        // //console.log(USER_ROLE)
        // let arrayOfUserRole = []
        // $.each(USER_ROLE.user_role, function(i){
        //     arrayOfUserRole.push(USER_ROLE.user_role[i].role.title)
        // })
        // // CHECK THE USER ROLE
        // if(jQuery.inArray("Faculty", arrayOfUserRole) !== -1)
        // {
        //     var row_right_top = '<button id="time_in_button" type="button" class="btn time_in_btn btn-icon icon-left btn-primary btn-lg button-block float-right" id="{{$activity_id}}"><i class="fas fa-check"></i> Time in</button>';
        //     $("#time_button").append(row_right_top);
        // }

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

                $.ajax({
                url: ATTENDANCE_API + attendance_id,
                method: "GET",
                dataType: "JSON",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    if(data.attendance_status == null){
                    var row_right_top = '<button id="time_in_button" type="button" class="btn time_in_btn btn-icon icon-left btn-primary btn-lg button-block float-right" id="{{$activity_id}}"><i class="fas fa-check"></i> Time in</button>';
                    $("#time_button").append(row_right_top);
                    }

                    if(data.attendance_status == "Attending"){
                    $("#time_in_button").remove();
                    var row_right_top = '<button id="time_out_button" type="button" class="btn time_out_btn btn-icon icon-left btn-primary btn-lg button-block float-right" id="{{$activity_id}}"'+
                                        'data-toggle="modal" data-target="#timeOutModal"><i class="fas fa-check"></i> Time out</button>';
                    $("#time_button").append(row_right_top);
                    }
                    
                    else if(data.attendance_status == "Attended"){
                    $("#time_in_button").remove();
                    $("#time_out_button").remove();
                    var row_right_top = '<button id="time_out_button" type="button" class="btn time_out_btn btn-icon icon-left btn-primary btn-lg button-block float-right view-proof-btn"'+
                                        'data-toggle="modal" data-target="#viewSubmittedFiles"><i class="fas fa-check"></i> Check uploaded files</button>';
                    $("#time_button").append(row_right_top);
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
                    { data: "faculty_id", render: function(data, type, row){
                        if (data == USER_ROLE.faculty.id){
                            return `</div>
                                    <button type="button" class="btn btn-sm btn-success view-proof-btn" id="${row.id}"
                                    data-toggle="modal" data-target="#viewSubmittedFiles">
                                    <div>Check Uploaded Files</div>
                                </button>`
                        }
                        else{
                            return ``
                        }
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 2] }],
                "order": [[1, "desc"]]
                });
        };

        requiredFacultyDatatable()

    
        $(document).on("click", ".time_in_btn", function(){

            activity_id = this.id
            date = new Date()

            // console.log(ACTIVITY_ID)
            // console.log(USER_ROLE.faculty.id)

            let data = {
            "time_in": moment(date).format('YYYY[-]MM[-]DD HH:mm:ss'),
            "attendance_status": "Attending"
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
                    notification("info", "Activity Attended")
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

        $(".proof_upload").dropzone({ 
            url: ATTENDANCE_PROOF + 'file_uploads',
            acceptedFiles: '.xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf',
            method: "POST",
            addRemoveLinks: true,
            autoProcessQueue: false,

            init: function () {

                var myDropzone = this;

                // Update selector to match your button
                $(".btnUpload").click(function (e) {
                    e.preventDefault();
                    myDropzone.processQueue();
                });

                $.ajax({
                    url: APP_URL+'/api/v1/activity_submitted_proof/' + AA_FACULTY_ID ,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data) 
                    {   
                        $.each(data, function(i){
                            let mockFile = { name: data[i].file_name,
                                             id: data[i].id,
                                             path: APP_URL + "/" + data[i].file_link_directory
                                            };
                            myDropzone.files.push(mockFile)
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("complete", mockFile); 
                        })
                    },
                    error: function ({ responseJSON }) {},
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
                var myDropzone = this;

                let submission_data = [{
                    "aa_faculty_id": AA_FACULTY_ID,
                    "file_link_directory": data,
                    "file_name": response.upload.filename
                }]
                // ajax opening tag
                    $.ajax({
                        url: ATTENDANCE_PROOF + 'multi_insert',
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
                                date = new Date()

                                let data_form = {
                                    "time_out": moment(date).format('YYYY[-]MM[-]DD HH:mm:ss'),
                                    "attendance_status": "Attended",
                                }
                                console.log(data_form)

                                $.ajax({
                                    url: ATTENDANCE_API + "time-in-out/" + ACTIVITY_ID + "/" +USER_ROLE.faculty.id,
                                    method: "PUT",
                                    data: JSON.stringify(data_form),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },

                                    success: function(data){
                                        console.log(data)
                                        // refresh()
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
                                notification('success', response.upload.filename)
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

                

            },

            removedfile: function(file) {
                Swal.fire({
                        title: "Are you sure?",
                        text: "You won't able to undo this.",
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

        $(document).on("click", "#proof_link_submit", function(){

            //activity_id = this.id
            date = new Date()

            // console.log(ACTIVITY_ID)
            // console.log(USER_ROLE.faculty.id)

            let data = {
            "time_out": moment(date).format('YYYY[-]MM[-]DD HH:mm:ss'),
            "attendance_status": "Attended",
            "status": "For checking",
            "proof_of_attendance_file_link": $('#proof_link').val(),
            }

            console.log(data)

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
                        console.log(data)

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

                console.log(data)

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
