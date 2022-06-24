
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/faculty/'
        var USER_ID = "{{ $user_id }}"
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
                    console.log(data)

                    let id_select = ''
                    $.each(data, function (i){
                        id_select += `<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="role_id_input[]" id="${data[i].id}" value="${data[i].id}">
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
                    $.each(data.user_role, function(i){
                        $('#'+data.user_role[i].role.id).prop('checked', true);
                    })
                },
                error: function(error){
                    console.log(error)
                    // console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        }

        // FORM SUBMIT
        $('#updateForm').on('submit', function(e){
            
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
