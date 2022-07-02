<script>
    function removeLoader(){
            $("#loading_cover").fadeOut();
    };

    function swalAlert(icon, text){
        Swal.fire({
            icon: icon,
            text: text
        })
    }

    $(document).ready(function(){
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
            $('#sidebar_icon').attr("src", APP_URL + "/" + new_user_data.faculty.image)
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
    })
</script>