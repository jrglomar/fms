
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/faculty/'
        var USER_ID = "{{ $user_id }}"
        var FACULTY_ID

        // END OF GLOBAL VARIABLE

        // SUBMIT EDUCATIONAL PROFILE FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();
            
            var faculty_id = $('#faculty_id').val()

            console.log(faculty_id);

            var form_url = APP_URL + '/api/v1/faculty_education_profile/'
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })

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
                    notification("success", "Faculty Education Profile");
                    $("#createForm").trigger("reset")
                    $("#create_educational_profile_card").collapse("hide")
                    getFacultyEducationalProfile();
                    $('#degree').val('').trigger("change");
                    scrollDiv();
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        });
        // END OF SUBMIT EDUCATIONAL PROFILE FUNCTION

        // GET LIST OF F_TYPES DATATABLE FUNCTION
        function getFacultyTypeList(){
            var form_url = APP_URL+'/api/v1/faculty_type';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    let id_select = '<option disabled selected>List of faculty types/s</option>'
                    $.each(data, function (i){
                        id_select += `<option value="${data[i].id}">${data[i].title}</option>`
                    })

                    $('#faculty_type_id').html(id_select)
                    // $('#faculty_type_id_edit').html(id_select)
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        }
        // GET LIST OF F_TYPES DATATABLE FUNCTION

        // FOR FACULTY PROGRAM ADD BUTTON
        $('#createFacultyProgram').on('click', function(){
            $('#createFacultyProgramModal').modal('show')
        })
        // END FOR FACULTY PROGRAM ADD BUTTON

        // ADD FACULTY PROGRAM FUNCTION
        $('#createFacultyProgramForm').on('submit', function(e){
            e.preventDefault();


            var faculty_id = $('#faculty_id').val()

            var form_url = APP_URL + '/api/v1/faculty_program'
            var form = $("#createFacultyProgramForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })

            var program_id = data.program_id

            console.log("116")
            console.log(faculty_id)
            console.log(program_id)
            console.log(data)


            $.ajax({
                url: APP_URL + '/api/v1/faculty_program/search_existing/' + faculty_id + '/' + program_id,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    if(responseData.length == 0)
                    {
                        console.log(responseData)
                        //  ajax opening tag
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
                                notification('success', 'Faculty Program')
                                $("#createFacultyProgramForm").trigger("reset")
                                $('#createFacultyProgramModal').modal('hide')
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
                            }
                        // ajax closing tag
                        })
                    }
                    else if (responseData.length > 0)
                    {
                        swalAlert('warning', 'The program is already added.')
                    }        
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            });
        });
        // END ADD FACULTY PROGRAM FUNCTION

        // FOR REMOVING THE PROGRAM OF FACULTY FUNCTION
        $(document).on("click", ".btnDeactivateFacultyProgram", function(){
            var id = this.id;

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
                        url: APP_URL + '/api/v1/faculty_program/destroy/' + id,
                        method: "DELETE",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },

                        success: function(data){
                            notification('error', 'Faculty Program')
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
                        }
                    // ajax closing tag
                    })
                }
            });
        });
        
        // END FOR REMOVING THE PROGRAM OF FACULTY FUNCTION


        // GET LIST OF ROLE DATATABLE FUNCTION
        function getRoleList(){
            var form_url = APP_URL+'/api/v1/role';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    let id_select = ''
                    $.each(data, function (i){
                        id_select += `<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" class="role_id_input" name="role_id_input[]" id="${data[i].id}" value="${data[i].id}">
                                        <label class="form-check-label" for="${data[i].id}">${data[i].title}</label>
                                        </div>`
                    })

                    $('#role_id').html(id_select)
                    // $('#role_id_edit').html(id_selet)
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        }

        // GET LIST OF ACADEMIC RANKS DATATABLE FUNCTION
        function getAcademicRankList(){
            var form_url = APP_URL+'/api/v1/academic_rank';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    let id_select = '<option disabled selected>List of academic rank/s</option>'
                    $.each(data, function (i){
                        id_select += `<option value="${data[i].id}">${data[i].title}</option>`
                    })

                    $('#academic_rank_id').html(id_select)
                    // $('#faculty_type_id_edit').html(id_select)
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        }
        // GET LIST OF ACADEMIC RANKS DATATABLE FUNCTION

        // GET LIST OF DESIGNATION DATATABLE FUNCTION
        function getDesignationList(){
            var form_url = APP_URL+'/api/v1/designation';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    let id_select = '<option disabled selected>List of designation/s</option>'
                    $.each(data, function (i){
                        id_select += `<option value="${data[i].id}">${data[i].title}</option>`
                    })

                    $('#designation_id').html(id_select)
                    // $('#faculty_type_id_edit').html(id_select)
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        }
        // GET LIST OF DESIGNATION DATATABLE FUNCTION

        // GET LIST OF SPECIALIZATION DATATABLE FUNCTION
        function getSpecializationList(){
            var form_url = APP_URL+'/api/v1/specialization';

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){

                    let id_select = '<option disabled selected>List of specialization/s</option>'
                    $.each(data, function (i){
                        id_select += `<option value="${data[i].id}">${data[i].title}</option>`
                    })

                    $('#specialization_id').html(id_select)
                    // $('#faculty_type_id_edit').html(id_select)
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        }
        // GET LIST OF SPECIALIZATION DATATABLE FUNCTION

        // LOAD LOAD PROGRAMS IN MODAL
        function loadPrograms(){
            $.ajax({
                url: APP_URL+'/api/v1/program/',
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

                    $("#program_id").html(html);
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            });
        };

        loadPrograms();
        // END LOAD PROGRAMS IN MODAL

       // PROGRAM FUNCTION
       function getProgramList(){

            var program_url = APP_URL+'/api/v1/program'

            $.ajax({
                url: program_url,
                type: "GET",
                dataType: "JSON",

                success: function(data){

                    var html = '<option value="" disabled selected>List of Program/s</option>'

                    for(var i=0; i < data.length; i++){
                    html += `<option value="${data[i].id}">${data[i].title}</option>`
                    }
                    
                    $('#program_id').html(html);
                    console.log(html)
                }
            })
        }
        // END OF PROGRAM FUNCTION

        // GET EDUCAITONAL PROFILE FUNCTION
        function getFacultyEducationalProfile(){
            var form_url = APP_URL+'/api/v1/user/'+USER_ID;

            $.ajax({
                url: form_url,
                method: "GET",
                async: true,
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data)
                {
                    var faculty_educ_profile_url = APP_URL + '/api/v1/faculty_education_profile/get_all_educational_background_of_faculty/' + data.faculty.id;
                    $.ajax({
                        url: faculty_educ_profile_url,
                        method: "GET",
                        async: true,
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },
                        success: function(responseData)
                        {
                            // Ticket Details
							$("#educational_profile_card_body").empty();

                            var faculty_education = "";

                            console.log(responseData)
                            if (responseData.length == 0)
                            {
                                faculty_education =     '<div class="row">' +
                                                            '<div class="col-md-12 text-center">' +
                                                                '<span> No Educational Profile added yet.</span>'
                                                            '</div>' +
                                                        '</div>';
                                $("#educational_profile_card_body").html(faculty_education);
                            }
                            else 
                            {
                                for(var i=0; i < responseData.length; i++)
                                {
                                    var school = responseData[i].school
                                    var year_of_attendance = responseData[i].year_of_attendance

                                    if (school == null)
                                    {
                                        school = ""
                                    }
                                    else
                                    {
                                        school = responseData[i].school
                                    }
                                    if (year_of_attendance == null)
                                    {
                                        year_of_attendance = ""
                                    }
                                    else
                                    {
                                        year_of_attendance = responseData[i].year_of_attendance
                                    }
                                    console.log(responseData.length);
                                    console.log(responseData[i].degree);
                                    faculty_education +=    '<div class="row">' +
                                                                [i+1] +
                                                                '&emsp;&emsp;' +
                                                                '<div class="btn-group">' +
                                                                    '<button class="button btn-info text-center btnEdit" id="' + responseData[i].id + '""><i class="fas fa-edit"></i></button>' +
                                                                    '<button class="button btn-danger text-center btnDeactivate" id="' + responseData[i].id + '""><i class="fas fa-trash-alt"></i></button>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<br>' +
                                                            '<div class="row">' +
                                                                '<div class="col-md-3" id="faculty_degree">' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span><b>Degree: </b>' +
                                                                    '</div>' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span>&nbsp;&nbsp;- ' + 
                                                                            responseData[i].degree +
                                                                        '</span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-md-4" id="faculty_program">' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span><b>Program: </b>' +
                                                                    '</div>' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span>&nbsp;&nbsp;- ' + 
                                                                            responseData[i].program +
                                                                        '</span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-md-3" id="faculty_school">' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span><b>School: </b>' +
                                                                    '</div>' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span>&nbsp;&nbsp;- ' + 
                                                                            school +
                                                                        '</span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<div class="col-md-2" id="faculty_year_of_attendance">' +
                                                                    '<div class="col-md-12 text-center">' +
                                                                        '<span><b>Year of Attendance: </b>' +
                                                                    '</div>' +
                                                                    '<div class="col-md-12">' +
                                                                        '<span>&nbsp;&nbsp;- ' + 
                                                                            year_of_attendance +
                                                                        '</span>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>' +
                                                            '<hr class="solid">';
                                }
                                $("#educational_profile_card_body").append(faculty_education);       
                            }
                            
                        }
                    });
                }
            })
        }
        
        // GET USER DETAILS DATATABLE FUNCTION
        function getUserDetails(){
            var form_url = APP_URL+'/api/v1/user/'+USER_ID;

            $.ajax({
                url: form_url,
                method: "GET",
                async: true,
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    console.log('specific')
                    console.log(data)
                    $('#email').val(data.email);

                    $.each(data.user_role, function(i){
                        $('#'+data.user_role[i].role.id).prop('checked', true);
                    })

                    // CHECK IF FACULTY DETAILS IS SET
                    if(data.faculty == null){
                        removeLoader()
                    }

                    if(data.status == "Active"){
                        $('#status').prop('checked', true);
                        $('#status_label').html('Active')
                    }
                    else{
                        $('#status').prop('checked', false);
                        $('#status_label').html('Inactive')
                    }

                    // $("input[name=gender]").val(data.faculty.gender);
                    $("input[name=gender][value=" + data.faculty.gender + "]").attr('checked', 'checked')

                    if(data.faculty.image != null){
                        $('#faculty_image').attr("src", APP_URL + "/" + data.faculty.image)
                        console.log(APP_URL + "/" + data.faculty.image)
                    }

                    if(data.faculty.faculty_program.length != 0)
                    {
                        let FacultyProgramList = `<li class="list-group-item d-flex justify-content-between" disabled>
                                                    <span class="text-primary"><strong>Program</strong></span>
                                                </li>`;
                        $.each(data.faculty.faculty_program, function(i){
                            let requiredDocumentTitle = data.faculty.faculty_program[i].program.title 
                            FacultyProgramList += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span class="text-primary">${requiredDocumentTitle}</span>
                                                        <button type="button" class="btn btn-danger btnDeactivateFacultyProgram" id="${data.faculty.faculty_program[i].id}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                    </li>`;
                        })
                        $('#FacultyProgramList').html(FacultyProgramList)
                    }
                    else
                    {
                        let FacultyProgramList = `<li class="list-group-item d-flex justify-content-between" disabled>
                                                    <span class="text-primary"><strong>No Program added yet</strong></span>
                                                </li>`; 
                        
                        $('#FacultyProgramList').html(FacultyProgramList)
                    }

                    $('#FacultyProgramList').html(FacultyProgramList)

                    // FOR EDUCATIONAL BACKGROUND
                    $('#faculty_id').val(data.faculty.id);
                    // END FOR EDUCATIONAL BACKGROUND
                    $('#faculty_type_id').val(data.faculty.faculty_type_id);
                    $('#academic_rank_id').val(data.faculty.academic_rank_id);
                    $('#designation_id').val(data.faculty.designation_id);
                    $('#specialization_id').val(data.faculty.specialization_id);
                    $('#program_id').val(data.faculty.program_id);
                    $('#barangay').val(data.faculty.barangay);
                    $('#birthdate').val(data.faculty.birthdate);
                    $('#birthplace').val(data.faculty.birthplace);
                    $('#city').val(data.faculty.city);
                    $('#street').val(data.faculty.street);
                    $('#salutation').val(data.faculty.salutation);
                    $('#first_name').val(data.faculty.first_name);
                    $('#hire_date').val(data.faculty.hire_date);
                    $('#house_number').val(data.faculty.house_number);
                    $('#last_name').val(data.faculty.last_name);
                    $('#middle_name').val(data.faculty.middle_name);
                    $('#phone_number').val(data.faculty.phone_number);
                    $('#province').val(data.faculty.province);
                    $('#salutation').val(data.faculty.salutation);

                    // SETTINGS FACULTY ID
                    FACULTY_ID = data.faculty.id;
                    removeLoader()
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        }

        $('#status').on('change', function(e){
            if(this.checked == true){
                $('#status_label').html('Active')
            }
            else{
                $('#status_label').html('Inactive')
            }

            let form_data = {
                "status": $('#status_label').html()
            }

            $.ajax({
                url: APP_URL+'/api/v1/user/'+USER_ID,
                method: "PUT",
                data: JSON.stringify(form_data),
                dataType: "JSON",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data){
                    console.log('Update Success')
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        })

        // FORM SUBMIT
        $('#updateForm').on('submit', function(e){
            e.preventDefault()

            var check_form_url = APP_URL+'/api/v1/faculty/check_user_exist/'+USER_ID;
            var create_form_url = BASE_API
            var update_form_url = BASE_API+FACULTY_ID

            var form = $("#updateForm").serializeArray();
            let form_data = {
                "user_id": USER_ID
            }

            $.each(form, function(){
                form_data[[this.name]] = this.value;
            })



            $.ajax({
                url: check_form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data){
                    if(data == true){
                        // UPDATE FORM
                        console.log('update')
                        $.ajax({
                            url: update_form_url,
                            method: "PUT",
                            data: JSON.stringify(form_data),
                            dataType: "JSON",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },
                            success: function(data){
                                notification('info', 'Faculty Details')
                                console.log('Update Success')
                                setInterval(() => {
                                    location.reload();
                                }, 1500);
                            },
                            error: function(error){
                                $.each(error.responseJSON.errors, function(key,value) {
                                    swalAlert('warning', value)
                                });
                            }
                        // ajax closing tag
                        })
                    }
                    else{
                        // CREATE FOR
                        console.log('create')
                        // ajax opening tag
                        console.log(form_data)
                        $.ajax({
                            url: create_form_url,
                            method: "POST",
                            data: JSON.stringify(form_data),
                            dataType: "JSON",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },
                            success: function(data){
                                notification('success', 'Faculty Details')
                                console.log('Create Success')
                                setInterval(() => {
                                    location.reload();
                                }, 1500);
                            },
                            error: function(error){
                                $.each(error.responseJSON.errors, function(key,value) {
                                    swalAlert('warning', value)
                                });
                            }
                        // ajax closing tag
                        })
                    }
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        });

        $('#btnUploadImage').on('click', function(){
            // swalAlert('warning', 'This feature is still under development')
            $("#uploadImage").click();
        })

        $("#uploadImage").on('change', function(){
            let uploadImage = $('#uploadImage')[0].files[0]
            let imgUrl = URL.createObjectURL(uploadImage)
            $('#faculty_image').attr("src", imgUrl)
        });
        

        // FORM SUBMIT
        $('#updateUserForm').on('submit', function(e){
            e.preventDefault()

            var uploadImage = $('#uploadImage')[0].files[0]
            var Extension;
            // var files = $('#memorandum_file_directory')[0].files[0]
            console.log(uploadImage)
            

            let role_id_input = $("input[name='role_id_input[]']:checked")
              .map(function(){
                return {
                "role_id": $(this).val(),
                "user_id": USER_ID
                }
            }).get();


            let role_form_url = APP_URL + '/api/v1/user_role/multi_insert' 
            console.log(role_id_input)

            $.ajax({
                    url: role_form_url,
                    method: "POST",
                    data: JSON.stringify(role_id_input),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        notification('info', 'User Role')
                    },
                    error: function(error){
                        $.each(error.responseJSON.errors, function(key,value) {
                            swalAlert('warning', value)
                        });
                    }
                // ajax closing tag
            })


            if (uploadImage != null){
                Extension = uploadImage.name.substring(
                uploadImage.name.lastIndexOf('.') + 1).toLowerCase();

                let form_data = new FormData();
                form_data.append('file', uploadImage)
                console.log(form_data)

                if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
                    if($('#uploadImage').val() == ''){
                            swalAlert('warning', 'Please select an image')
                    }
                    else{
                        let upload_form_url = BASE_API + 'faculty_image_upload'
                        $.ajax({
                                url: upload_form_url,
                                method: "POST",
                                data: form_data,
                                dataType: "JSON",
                                processData: false,
                                contentType: false,
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                },
                                success: function(data){
                                    notification('success', 'Image Update Successfully')
                                    
                                    let update_data = {}
                                    update_data['image'] = data.path
                                    var update_form_url = BASE_API+FACULTY_ID
                                    console.log(JSON.stringify(update_data))
                                    console.log(JSON.stringify(update_form_url))

                                    // UPDATE IMAGE PATH IN DB
                                    $.ajax({
                                        url: update_form_url,
                                        method: "PUT",
                                        data: JSON.stringify(update_data),
                                        dataType: "JSON",
                                        headers: {
                                            "Accept": "application/json",
                                            "Authorization": API_TOKEN,
                                            "Content-Type": "application/json"
                                        },
                                        success: function(data){
                                            // notification('info', 'Faculty Details')
                                            setInterval(() => {
                                                location.reload();
                                            }, 1500);
                                        },
                                        error: function(error){
                                            $.each(error.responseJSON.errors, function(key,value) {
                                                swalAlert('warning', value)
                                            });
                                        }
                                    // ajax closing tag
                                    })
                                },
                                error: function(error){
                                    $.each(error.responseJSON.errors, function(key,value) {
                                        swalAlert('warning', value)
                                    });
                                }
                            // ajax closing tag
                            })
                    }
                }
                else{
                    swalAlert('warning', 'Invalid file extension. File must be png, jpeg, jpg');
                }
            }
            // END OF UPLOAD IMAGE

        });

        // EDIT FUNCTION
        $(document).on("click", ".btnEdit", function(){
            var id = this.id;
            let form_url = APP_URL + '/api/v1/faculty_education_profile/' + id
            console.log(id)

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
                    $('#degree_edit').val(data.degree);
                    $('#program_edit').val(data.program);
                    $('#school_edit').val(data.school);
                    $('#year_of_attendance_edit').val(data.year_of_attendance);
                    $('#faculty_id_edit').val(data.faculty_id);

                    $('#educ_profile_editModal').modal('show');
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        });
        // END OF EDIT FUNCTION

        // UPDATE FUNCTION
        $('#educ_profile_updateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_edit').val();
            var form_url = APP_URL + '/api/v1/faculty_education_profile/' + id

            let data = {
                "degree": $('#degree_edit').val(),
                "program": $('#program_edit').val(),
                "school": $('#school_edit').val(),
                "year_of_attendance": $('#year_of_attendance_edit').val(),
                "faculty_id": $('#faculty_id_edit').val(),
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
                    notification("info", "Educational Profile");
                    getFacultyEducationalProfile()
                    $('#educ_profile_editModal').modal('hide');
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                }
            // ajax closing tag
            })
        });
        // END OF UPDATE FUNCTION

        // DELETE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
            var id = this.id;
            let form_url = APP_URL + '/api/v1/faculty_education_profile/' + id
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
                                url: APP_URL + '/api/v1/faculty_education_profile/destroy/' + data.id,
                                method: "DELETE",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },

                                success: function(data){
                                    notification('error', 'One of Faculty Educational Profile')
                                    getFacultyEducationalProfile()
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

        // CALL FUNCTION
        getRoleList()
        getFacultyTypeList()
        getAcademicRankList()
        getDesignationList()
        getSpecializationList()
        getProgramList()
        getUserDetails()
        getFacultyEducationalProfile()

        scrollDiv = () => 
        {
            var elem = document.getElementById("educ_profile");
            elem.scrollIntoView();
        }

    // END OF JQUERY FUNCTIONS
    });
</script>
