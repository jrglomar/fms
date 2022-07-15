
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

                    let created_at = moment(data.created_at).format('LLL');
                    let status = (data.deleted_at === null) ? 'Active' : 'Inactive';
                    let is_required_view = ""

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

                    if(data.status == "Pending"){
                        $('#status').html(`<span class="badge badge-warning">
                                <span>${data.status}</span>
                                </span>`);
                        //$('#status').addClass('text-primary');
                    }
                    else if(data.status == "Ended"){
                        $('#status').html(`<span class="badge badge-warning">
                                <span>${data.status}</span>
                                </span>`);
                        //$('#status').addClass('text-success');
                    }
                    else if(data.status == "Ongoing"){
                        $('#status').html(`<span class="badge badge-warning">
                                <span>${data.status}</span>
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
            })
        }

        getActivity()

        //console.log(USER_ROLE)
        let arrayOfUserRole = []
        $.each(USER_ROLE.user_role, function(i){
            arrayOfUserRole.push(USER_ROLE.user_role[i].role.title)
        })
        // CHECK THE USER ROLE
        if(jQuery.inArray("Faculty", arrayOfUserRole) !== -1)
        {
            var row_right_top = '<button id="time_in_button" type="button" class="btn time_in_btn btn-icon icon-left btn-primary btn-lg button-block float-right" id="{{$activity_id}}"><i class="fas fa-check"></i> Time in</button>';
            $("#time_button").append(row_right_top);
        }


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

                    if(data.attendance_status == "Attending"){
                    $("#time_in_button").remove();
                    var row_right_top = '<button id="time_out_button" type="button" class="btn time_out_btn btn-icon icon-left btn-primary btn-lg button-block float-right" id="{{$activity_id}}"'+
                                        'data-toggle="modal" data-target="#timeOutModal"><i class="fas fa-check"></i> Time out</button>';
                    $("#time_button").append(row_right_top);
                    }

                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)

                    swalAlert('warning', error.responseJSON.message)
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

                swalAlert('warning', error.responseJSON.message)
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
                    { data: "faculty.user.email", render: function(data, type, row){
                        return data
                    }},
                    { data: "faculty.first_name", render: function(data, type, row){
                        let html = ''
                        html += row.faculty.first_name + ' ' + row.faculty.last_name
                        return html
                    }},
                    { data: "attendance_status"},
                    { data: "faculty_id", render: function(data, type, row){
                        if (data == USER_ROLE.faculty.id){
                            return `</div>
                                    <button type="button" class="btn btn-sm btn-success btnViewDetails" id="${row.id}">
                                    <div>Check Uploaded Files</div>
                                </button>`
                        }
                        else{
                            return ``
                        }
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]]
                });
        };

        requiredFacultyDatatable()

    
        $(document).on("click", ".time_in_btn", function(){

            //activity_id = this.id
            date = new Date()

            // console.log(ACTIVITY_ID)
            // console.log(USER_ROLE.faculty.id)

            let data = {
            "time_in": moment(date).format('HH:mm:ss'),
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
                    refresh()
                    notification("info", "Activity Attended")
                    
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)

                    swalAlert('warning', error.responseJSON.message)
                }
            // ajax closing tag
            })

        });

        $("#proof_upload").dropzone({ 
            url: ATTENDANCE_PROOF + 'file_uploads',
            acceptedFiles: '.xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf',
            method: "POST",
            addRemoveLinks: true,
            autoProcessQueue: false,
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
                
            },

            success: function(response, data){

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
                                        "time_out": moment(date).format('HH:mm:ss'),
                                        "attendance_status": "Attended",
                                    }

                                    $.ajax({
                                        url: ATTENDANCE_API + "time-in-out/" + ACTIVITY_ID + "/" +USER_ROLE.faculty.id,
                                        method: "PUT",
                                        data: fd,
                                        dataType: "JSON",
                                        headers: {
                                            "Accept": "application/json",
                                            "Authorization": API_TOKEN,
                                            "Content-Type": "application/json"
                                        },

                                        success: function(data){
                                            console.log(data)
                                            // refresh()
                                            // $('#timeOutModal').modal('hide');

                                            // notification("info", "Time out")
                                        },
                                        error: function(error){
                                            console.log(error)
                                            console.log(`message: ${error.responseJSON.message}`)
                                            console.log(`status: ${error.status}`)

                                            swalAlert('warning', error.responseJSON.message)
                                        }
                                        // ajax closing tag
                                    })
                                    notification('success', response.upload.filename)
                                }
                            },
                            error: function(error){
                                console.log(error)
                                swalAlert('warning', error.responseJSON.message)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }
                    })
                    // ajax closing tag

            },
        });

        /// TIME OUT SUBMIT FUNCTION
        $('#timeOutForm').on('submit', function(e){
            e.preventDefault()
            //var id = $('#id_delete').val();
            //var form_url = APP_URL+'/api/v1/activity_type/destroy/'+id

            date = new Date()

            url_link = $('#url_link').val()
            proof = $('#file_proof')[0].files[0]
            time_out = moment(date).format('HH:mm:ss')

            if(url_link == null){
                url_link = ""
            }

            if(proof == null){
                proof = ""
            }

            var fd = new FormData();
            
            fd.append('file', proof)
            fd.append('time_out', time_out)
            fd.append('proof_of_attendance_file_link', url_link)
            fd.append('attendance_status', "Attended")

            //console.log(JSON.stringify(fd))
            
            
            
        });
        // END OF TIME OUT SUBMIT FUNCTION

    });
</script>
