<script>
    $(document).ready(function(){
        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/class_attendance/'
        var SCHEDULE_ID = "{{ $schedule_id }}"
        var CLASS_SCHEDULE_ID
        var CLASS_SCHEDULE_DATA
        var NEW_USER_DATA = JSON.parse(USER_DATA)
        var USER_ID = NEW_USER_DATA.id
        var FACULTY_ID = NEW_USER_DATA.faculty.id
        // END OF GLOBAL VARIABLE


        // ADD FILE UPLOAD
        $("#editFileupload").dropzone({
            url: APP_URL+'/api/v1/class_attendance/file_uploads',
            acceptedFiles: 'image/*',
            addRemoveLinks: false,
            autoProcessQueue: false,
            parallelUploads: 1,
            maxFiles: 1,

            init: function () {

                var myDropzone = this;

                myDropzone.disable()
                // Update selector to match your button
                $(".btnUpdateProofOfAttendance").click(function (e) {
                    e.preventDefault();

                    let edit_check_data = {
                        "start_time": $('#start_time_input_e').val(),
                        "end_time": $('#end_time_input_e').val(),
                        "date_of_class": $('#date_of_class_e').val(),
                        "class_schedule_id": $('#class_schedule_id_e').val(),
                        "faculty_id": FACULTY_ID,
                        "id": $('#class_attendance_id_e').val(),
                    }
                    if(edit_check_data.date_of_class == ""){
                        swalAlert('warning', 'Date of class is required')
                    }
                    else if(edit_check_data.start_time == "start_time" || edit_check_data.end_time == "end_time"){
                        swalAlert('warning', 'Time of class is required')
                    }
                    else{
                        myDropzone.processQueue();
                    }
                });

                $(document).on("click", ".btnEditProofOfAttendance", function(){
                    let class_attendance_id = this.id
                    

                    $.ajax({
                        url: BASE_API + class_attendance_id,
                        method: "GET",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },

                        
                        success: function(data){
                            console.log(data)
                            myDropzone.removeAllFiles(true);
                            $('#class_attendance_id_e').val(data.id)
                            $('#class_schedule_id_e').val(data.class_schedule_id)
                            $('.date_of_class_e').attr('placeholder', moment(data.date_of_class).format('ll'))
                            $('#date_of_class_e').val(data.date_of_class)
                            $('#start_time_input_e').val(data.start_time)
                            $('#end_time_input_e').val(data.end_time)

                            let mockFile = { 
                                name: data.proof_of_attendance_file_name,
                                id: data.id,
                                path: APP_URL + "/" + data.proof_of_attendance_file,
                                status: data.status
                            };

                            myDropzone.files.push(mockFile)
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("complete", mockFile);

                            $('#editProofOfAttendanceModal').modal('show')
                        }
                    })
                });

                myDropzone.on("complete", function(file) {
                    console.log(file)
                    if(file.status == 'Submitted'){ 
                        file.previewElement.querySelector('.dz-size').innerHTML = '';
                        file.previewElement.querySelector('.dz-image').innerHTML = `<img 
                        style="object-fit: fill; width:100%"; height:100%; display:block; margin-left: auto;margin-right: auto;" 
                        src="${file.path}">`;
                    }
                    else{
                        file.previewElement.querySelector('.dz-size').innerHTML = '';
                        file.previewElement.querySelector('.dz-image').innerHTML = `<img 
                        style="object-fit: fill; width:100%"; height:100%; display:block; margin-left: auto;margin-right: auto;" 
                        src="${file.path}">`;
                    }
                    
                    file.previewElement.addEventListener("click", function() {
                        // console.log(file)
                        window.open(file.path);
                    });
                });

                myDropzone.on("addedfile", function(file) {
                    // file.previewElement.querySelector('.dz-size').innerHTML = '';
                    // file.previewElement.querySelector('.dz-image').innerHTML = `<img src="${APP_URL + '/images/designs/file_upload.png'}">`;
                    let file_length = myDropzone.files.length
                    
                    if(file_length > 1){
                        this.removeFile(file);
                        swalAlert('warning', 'Maximum of 1 file. Please remove existing file first.')
                    }

                    file.previewElement.addEventListener("click", function() {
                        // console.log(file)
                    });
                });


            },

            success: function(response, data, file){

                

            },

            removedfile: function(file) {
                file.previewElement.remove();
            }
        });


        
    })
</script>