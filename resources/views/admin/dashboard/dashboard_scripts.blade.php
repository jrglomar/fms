
<script>
    $(document).ready(function(){

        /// GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        // END OF GLOBAL VARIABLE

        $.ajax({
              url: APP_URL+'/api/v1/user_role',
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                console.log(data)
                count = data.length
                admin_total = 0
                faculty_total = 0
                acad_head_total = 0
                checker_total = 0

                for (let i=0; i< count; i++){
                    if (data[i].role.title == "Faculty"){
                        faculty_total += 1
                    }
                    else if(data[i].role.title == "Admin"){
                        admin_total += 1
                    }
                    else if(data[i].role.title == "Academic Head"){
                        acad_head_total += 1
                    }
                    else if(data[i].role.title == "Checker"){
                        checker_total += 1
                    }
                }

                $('#total_faculty').html(faculty_total)
                $('#total_admin').html(admin_total)
                $('#total_acad_head').html(acad_head_total)
                $('#total_checker').html(checker_total)

              }
              })

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
