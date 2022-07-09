<script>
    function removeLoader(){
            $("#loading_cover").fadeOut();
    };

    function swalAlert(icon, text){
        Swal.fire({
            icon: icon,
            text: text
        })
    };

    function notification(type, name){
        if(type == 'success'){
            return toastr[type](`${name} added successfully.`)
        }
        else if(type == 'info'){
            return toastr[type](`${name} updated sucessfully.`)
        }
        else if(type == 'error'){
            return toastr[type](`${name} removed.`)
        }
        else if(type == 'custom'){
            return toastr['success'](`${name}`)
        }
    }
    
    $(document).ready(function(){

        // FUNCTION TO RESET FORM WHEN CANCEL BUTTON CLICKED
        $("#create_cancel_btn").on('click', function() {
            $("#createForm").trigger("reset")
            $("#create_card").collapse("hide")
            $('#createForm').parsley().reset();
        });

        $('#editModal').on('show.bs.modal', function() {
            $('#updateForm').parsley().reset();
        });

        // FOR AJAX BUTTON
            // FOR DISABLING SUBMIT BUTTON ON CREATE FORM
            $(document).ajaxStart(function() {
                $("#create_btn").prop('disabled', true);
            }).ajaxStop(function() {
                $("#create_btn").prop('disabled', false);
            });

            // FOR DISABLING UPDATE CHANGES BUTTON ON UPDATE FORM
            $(document).ajaxStart(function() {
                $(".btnUpdate").prop('disabled', true);
            }).ajaxStop(function() {
                $(".btnUpdate").prop('disabled', false);
            });
        // END FOR AJAX BUTTON

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        let new_user_data = (JSON.parse(USER_DATA))
        console.log(new_user_data)
        let middle_name = ''
        let user_role = ''

        if(new_user_data.faculty == null){
            $('#userNameSidebar').html('Not set')
            $('#userRoleSidebar').html('Not set')
            $('#userNameNavbar').html('Not set')
        }
        else{
            if(new_user_data.faculty.image != null){
                $('#sidebar_icon').attr("src", APP_URL + "/" + new_user_data.faculty.image)
            }
            if(new_user_data.faculty.middle_name == null){
                middle_name = ''
            }

            $('#userNameSidebar').html(new_user_data.faculty.first_name + ' ' + middle_name + ' ' + new_user_data.faculty.last_name)
            $.each(new_user_data.user_role, function(i){
                if(i < (new_user_data.user_role.length) - 1){
                    user_role += new_user_data.user_role[i].role.title + ', '
                }
                else{
                    user_role += new_user_data.user_role[i].role.title
                }
            })
            $('#userRoleSidebar').html(user_role)
            $('#userNameNavbar').html(new_user_data.faculty.first_name)
        }

        $("#create_cancel_btn").on('click', function() {
            $("#createForm").trigger("reset")
            $("#create_card").collapse("hide")
            $('#createForm').parsley().reset();
        });
    })
</script>