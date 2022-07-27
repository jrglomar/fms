
<script>



    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var JSON_USER_DATA = (JSON.parse(USER_DATA))
        var BASE_API = APP_URL + '/api/v1/requirement_list_type/'
        var FACULTY_LAST_NAME = JSON_USER_DATA.faculty.last_name

        let RR_FACULTY_LIST_ID = "{{ $rr_faculty_list_id }}"
        let R_BIN_ID = "{{ $requirement_bin_id }}"
        // END OF GLOBAL VARIABLE

        $("#fileupload").dropzone({
            url: APP_URL+'/api/v1/submitted_requirement/file_uploads',
            acceptedFiles: '.xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf',
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
                    url: APP_URL+'/api/v1/requirement_required_faculty_list/' + RR_FACULTY_LIST_ID ,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data)
                    {
                        console.log(data)
                        if(data.submission_status == 'Submitted'){
                            myDropzone.disable();
                            $('#btnMDone').attr('class', 'btn btn-secondary');
                            $('#btnMDone').html('Unsubmit');
                        }

                        removeLoader()
                        $.each(data.submitted_requirements, function(i){
                            let mockFile = { name: data.submitted_requirements[i].file_name,
                                             id: data.submitted_requirements[i].id,
                                             path: APP_URL + "/" + data.submitted_requirements[i].file_link_directory,
                                             status: data.submitted_requirements[i].status
                                            };
                            myDropzone.files.push(mockFile)
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("complete", mockFile);
                        })
                    },
                    error: function ({ responseJSON }) {},
                });

                myDropzone.on("complete", function(file) {
                    if(file.status == 'Submitted'){ 
                        file.previewElement.querySelector('.dz-size').innerHTML = '';
                        file.previewElement.querySelector('.dz-image').innerHTML = `<img src="${APP_URL + '/images/designs/file_submitted.png'}">`;
                    }
                    else{
                        file.previewElement.querySelector('.dz-size').innerHTML = '';
                        file.previewElement.querySelector('.dz-image').innerHTML = `<img src="${APP_URL + '/images/designs/file_upload.png'}">`;
                    }
                    
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

            success: function(response, data, file){

                let submission_data = {
                    "rr_faculty_list_id": RR_FACULTY_LIST_ID,
                    "file_link_directory": data,
                    "file_name": response.upload.filename
                }
                // ajax opening tag
                        $.ajax({
                            url: APP_URL + '/api/v1/submitted_requirement/',
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
                                console.log(data)
                                response.path = APP_URL+ '/' + data.file_link_directory
                                response.id = data.id
                            },
                            error: function(error){
                                console.log(error)
                                $.each(error.responseJSON.errors, function(key, value){
                                        swalAlert('warning', value)
                                })
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
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

        $('#btnDone').on('click', function(){
            let btnStatus = $('#btnMDone').html()
            console.log(btnStatus)

            if(btnStatus == 'Unsubmit'){
                // UPDATING RR_FACULTY AND BTN
                $.ajax({
                    url: APP_URL+'/api/v1/requirement_required_faculty_list/' + RR_FACULTY_LIST_ID,
                    method: "PUT",
                    data: JSON.stringify({"submission_status": ""}),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        $('#btnMDone').attr('class', 'btn btn-warning');
                        $('#btnMDone').html('Mark as Done');
                        notification('custom', 'Files unsubmitted')
                        setInterval(() => {
                            location.reload()
                        }, 1000);

                    },
                    error: function(error){
                        console.log(error)
                        $.each(error.responseJSON.errors, function(key, value){
                                swalAlert('warning', value)
                        })
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }
                })
            // ajax closing tag
            }
            else{
                // ajax opening tag
                $.ajax({
                    url: APP_URL+'/api/v1/requirement_required_faculty_list/' + RR_FACULTY_LIST_ID,
                    method: "GET",
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        notification('custom', 'Submitted Requirements marked as Done')
                        $.each(data.submitted_requirements, function(i){
                                $.ajax({
                                    url: APP_URL+'/api/v1/submitted_requirement/' + data.submitted_requirements[i].id,
                                    method: "PUT",
                                    data: JSON.stringify({"status": "Submitted"}),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data){

                                    },
                                    error: function(error){
                                        console.log(error)
                                        $.each(error.responseJSON.errors, function(key, value){
                                                swalAlert('warning', value)
                                        })
                                        console.log(`message: ${error.responseJSON.message}`)
                                        console.log(`status: ${error.status}`)
                                    }
                                })
                            // ajax closing tag
                            })
                    },
                    error: function(error){
                        console.log(error)
                        $.each(error.responseJSON.errors, function(key, value){
                                swalAlert('warning', value)
                        })
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }
                })

                $.ajax({
                    url: APP_URL+'/api/v1/requirement_required_faculty_list/' + RR_FACULTY_LIST_ID,
                    method: "PUT",
                    data: JSON.stringify({"submission_status": "Submitted"}),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        $('#btnMDone').attr('class', 'btn btn-secondary');
                        $('#btnMDone').html('Unsubmit');
                        console.log(data)
                        setInterval(() => {
                            location.reload()
                        }, 1000);
                    },
                    error: function(error){
                        console.log(error)
                        $.each(error.responseJSON.errors, function(key, value){
                                swalAlert('warning', value)
                        })
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }
                })
            }


        })

        // FUNCTION TO CHANGE PAGE HEADER/TITLE
        function getRequirementBinDetails(){

            $.ajax({
                url: APP_URL+'/api/v1/requirement_bin/' + R_BIN_ID ,
                type: "GET",
                dataType: "JSON",
                success: function (responseData)
                {
                    console.log("307")
                    console.log(responseData)
                    var title = responseData.title;
                    var description = responseData.description

                    var deadline = responseData.deadline
                    var deadline_hours = new Date(deadline).getHours();
                    var deadline_mins = new Date(deadline).getMinutes();
                    
                    if (deadline_hours < 10)
                    {
                        deadline_hours = "0"+deadline_hours
                    }
                    if (deadline_mins < 10)
                    {
                        deadline_mins = "0"+deadline_mins
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
      
                    var moment_current_date = moment(current_time).format('YYYY-MM-DD')
                    var moment_deadline = moment(deadline).format('YYYY-MM-DD');


                    var now = hours+":"+mins+":00";
                    var deadline_time = deadline_hours + ":" + deadline_mins + ":00"

                    console.log("Moment Current Date: " + moment_current_date)
                    console.log("Moment Start Date: " + moment_deadline)
                    console.log("Now: " + now)
                    console.log("Deadline in Time: " + deadline_time)
                    
                    console.log("Deadline")
                    console.log(deadline)

                    if(responseData.status == "On Going")
                    {
                        if(moment_current_date > moment_deadline)
                        {
                            let data_data = {
                                "title": title,
                                "description": description,
                                "deadline": deadline,
                                "status": "Done",
                            }
                            $.ajax({
                                url: APP_URL+"/api/v1/requirement_bin/"+R_BIN_ID,
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
                        if(moment_current_date == moment_deadline && now > deadline_time)
                        {                   
                                  
                            let data_data = {
                                "title": title,
                                "description": description,
                                "deadline": deadline,
                                "status": "Done",
                            }
                            $.ajax({
                                url: APP_URL+"/api/v1/requirement_bin/"+R_BIN_ID,
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

                    let requiredDocumentList = 'Required Document/s: '

                        $.each(responseData.requirement_list_type, function(i){
                            requiredDocumentList += '<li class="">' + responseData.requirement_list_type[i].requirement_type.title + '</li>'
                        })


                    if(moment(responseData.deadline).format() < moment(new Date).format()){
                        document.getElementById("date_badge").classList.add('badge-danger');
                    }
                    else if(moment(responseData.deadline).format() > moment(new Date).format()){
                        document.getElementById("date_badge").classList.add('badge-success');
                    }

                    $("#created_at").html(moment(responseData.deadline).format('LL'));
                    $('#requiredDocumentList').html(requiredDocumentList)
                    $("#created_by").html(`${responseData.created_by_user.faculty.first_name} ${responseData.created_by_user.faculty.last_name}` );
                    $("#title").html(title);
                    var status_html = "";
                    var status = responseData.status
                    console.log(responseData);

                    // if(status == "On Going" || status == "Ongoing")
                    // {
                    //     status_html =   '<span class="badge badge-info">' + 
                    //                         '<span style="font-size: 14px">Status: </span><span style="font-size: 14px">' + status + '</span>' +
                    //                     '</span>';
                    // }
                    // else if(status == "Done")
                    // {
                    //     status_html =   '<span class="badge badge-danger">' + 
                    //                         '<span style="font-size: 14px">Status: </span><span style="font-size: 14px">Past Due</span>' +
                    //                     '</span>';
                    // }
                    $("#status").html(status_html);
                    // $("#deadline").html("Deadline: " + deadline);
                    $("#description").html(description);
                },
                error: function ({ responseJSON }) {},
            });
        };

        getRequirementBinDetails();
        // END FUNCTION TO CHANGE PAGE HEADER/TITLE

        // DATA TABLES FUNCTION


        // LOAD REQUIREMENT TYPES
        function loadRequirementTypes(){
            $.ajax({
                url: APP_URL+'/api/v1/requirement_type/',
                type: "GET",
                dataType: "JSON",
                success: function (responseData)
                {
                    let html = ""
                    $.each(responseData, function (i, dataOptions)
                    {
                        html +=
                            "<option value='" +
                            dataOptions.id +
                            "'>" +
                            dataOptions.title +
                            "</option>";
                    });

                    $("#requirement_type_id").html(html);
                    $("#requirement_type_id_edit").html(html);
                    $("#requirement_type_id2").html(html);
                    $("#requirement_type_id_edit2").html(html);

                },
                error: function ({ responseJSON }) {},
            });
        };


        loadRequirementTypes();
        // END LOAD REQUIREMENT TYPES



    // END OF JQUERY FUNCTIONS
    });
</script>
