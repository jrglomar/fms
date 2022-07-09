
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity_view/'
        var ATTENDANCE_API = APP_URL + '/api/v1/activity_attendance/'
        var ACTIVITY_ID = "{{$activity_id}}"

        var USER_ROLE = JSON.parse(USER_DATA)
        // END OF GLOBAL VARIABLE

        removeLoader()
        
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

                    if(data.memorandum_file_directory == null){
                        $('#if_memo').html("<span>No Memorandum uploaded</span>")
                    }
                    else{
                        $('#if_memo').html('<div class="embed-responsive embed-responsive-16by9">'
                        +'<iframe id="memo" class="embed-responsive-item" src="..."></iframe></div>')
                        
                        document.getElementById("memo").src=APP_URL + "/" +data.memorandum_file_directory;
                    }

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
                    let arrayOfActivity = []
                    $.each(USER_ROLE.faculty.activity_attendance_required_faculty_list, function(i){
                        arrayOfActivity.push({"activity_id":USER_ROLE.faculty.activity_attendance_required_faculty_list[i].activity_id,
                                            "status":USER_ROLE.faculty.activity_attendance_required_faculty_list[i].attendance_status})
                    })

                    //console.log(jQuery.inArray(ACTIVITY_ID, arrayOfActivity))

                    for (var i=0; i < arrayOfActivity.length; i++) {
                        if (arrayOfActivity[i].activity_id === ACTIVITY_ID) {
                            if(arrayOfActivity[i].status == "Attended"){
                                $("#time_in_button").remove();
                                var row_right_top = '<button id="time_in_button" type="button" class="btn time_in_btn btn-icon icon-left btn-primary btn-lg button-block float-right" id="{{$activity_id}}"><i class="fas fa-check"></i> Time out</button>';
                                $("#time_button").append(row_right_top);
                            }
                        }
                    }
                    //

                }
            // ajax closing tag
            })
        }

        getActivity()

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
                    { data: "deleted_at"},
                    { data: "id", render: function(data, type, row){
                        return `</div>
                                    <button type="button" class="btn btn-sm btn-success btnViewDetails" id="${row.id}">
                                    <div>Check Uploaded Files</div>
                                </button>`
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]]
                });
        };

        requiredFacultyDatatable()

    
        $(document).on("click", ".time_in_btn", function(){

            activity_id = this.id
            
            //console.log(new Date())
            date = new Date()

            console.log(moment(date).format('YYYY-MM-DD HH:mm:ss'))

            let data = {
            "time_in": moment(date).format('HH:mm:ss'),
            "attendance_status": "Attended"
            }

            $.ajax({
                url: ATTENDANCE_API + activity_id + "/" +USER_ROLE.faculty.id,
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
    });
</script>
