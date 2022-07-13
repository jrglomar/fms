
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
                    "rr_faculty_list_id": RR_FACULTY_LIST_ID,
                    "file_link_directory": data,
                    "file_name": response.upload.filename
                }]
                // ajax opening tag
                        $.ajax({
                            url: APP_URL + '/api/v1/submitted_requirement/multi_insert',
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

        $('#btnDone').on('click', function(){
            swalAlert('warning', 'This feature is under maintenance')
        })


        // FUNCTION TO CHANGE PAGE HEADER/TITLE
        function getRequirementBinDetails(){
            console.log('test')

            $.ajax({
                url: APP_URL+'/api/v1/requirement_bin/' + R_BIN_ID ,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    console.log(responseData)
                    var title = responseData.title;
                    var deadline = responseData.deadline
                    var description = responseData.description

                    let requiredDocumentList = 'Required Document/s: '

                        $.each(responseData.requirement_list_type, function(i){
                            if(i < (responseData.requirement_list_type.length) - 1){
                                requiredDocumentList += responseData.requirement_list_type[i].requirement_type.title + ', '
                            }
                            else{
                                requiredDocumentList += responseData.requirement_list_type[i].requirement_type.title
                            }
                        })


                    $('#requiredDocumentList').html(requiredDocumentList)
                    $("#created_by").html(`${responseData.created_by_user.faculty.first_name} ${responseData.created_by_user.faculty.last_name}` );
                    $("#created_at").html(moment(responseData.deadline).format('LL'));
                    $("#title").html(title);
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
 

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
