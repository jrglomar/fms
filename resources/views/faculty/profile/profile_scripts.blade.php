
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
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        }
        // GET LIST OF F_TYPES DATATABLE FUNCTION

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
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
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
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
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
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        }
        // GET LIST OF DESIGNATION DATATABLE FUNCTION

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
                    $('#email').html(data.email);

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

                    let user_role = ''
                    $.each(data.user_role, function(i){
                        if(i < (data.user_role.length) - 1){
                            user_role += data.user_role[i].role.title + ', '
                        }
                        else{
                            user_role += data.user_role[i].role.title
                        }
                    })

                    $('#user_role').html(user_role)

                    $('#faculty_type_id').val(data.faculty.faculty_type_id);
                    $('#academic_rank_id').val(data.faculty.academic_rank_id);
                    $('#designation_id').val(data.faculty.designation_id);
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
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
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
                    console.log(error)
                    alert(error.status)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
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
                                swalAlert('warning', error.responseJSON.message)
                                console.log(error)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
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
                                swalAlert('warning', error.responseJSON.message)
                                console.log(error)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }
                        // ajax closing tag
                        })
                    }
                },
                error: function(error){
                    swalAlert('warning', error.responseJSON.message)
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });

        $('#btnUploadImage').on('click', function(){
            swalAlert('warning', 'This feature is still under development')
            // $("#uploadImage").click();
        })

        // FORM SUBMIT
        $('#updateUserForm').on('submit', function(e){
            e.preventDefault()

            var uploadImage = $('#uploadImage')[0].files[0]
            // var files = $('#memorandum_file_directory')[0].files[0]
            var Extension = uploadImage.name.substring(
                uploadImage.name.lastIndexOf('.') + 1).toLowerCase();

            console.log(uploadImage)

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
                                        notification('info', 'Faculty Details')
                                        console.log('Update Success')
                                        console.log(data)
                                        setInterval(() => {
                                            location.reload();
                                        }, 1500);
                                    },
                                    error: function(error){
                                        swalAlert('warning', error.responseJSON.message)
                                        console.log(error)
                                        console.log(`message: ${error.responseJSON.message}`)
                                        console.log(`status: ${error.status}`)
                                    }
                                // ajax closing tag
                                })
                            },
                            error: function(error){
                                swalAlert('warning', error.responseJSON.message)
                                console.log(error)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }
                        // ajax closing tag
                        })
                }
            }
            else{
                swalAlert('warning', 'Invalid file extension. File must be png, jpeg, jpg');
            }

        });

        // CALL FUNCTION
        getRoleList()
        getFacultyTypeList()
        getAcademicRankList()
        getDesignationList()
        getUserDetails()

    // END OF JQUERY FUNCTIONS
    });
</script>
