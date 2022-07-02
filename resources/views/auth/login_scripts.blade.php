
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        // END OF GLOBAL VARIABLE

        function checkLoggedIn(){
            if(localStorage.getItem("USER_DATA") != null){
                let USER_DATA = localStorage.getItem("USER_DATA")
                let new_user_data = (JSON.parse(USER_DATA))
                console.log(new_user_data)

                let role = []

                $.each(new_user_data.user_role, function(i){
                    role.push(new_user_data.user_role[i].role.title)
                })
            
                if(role.includes('Admin')){
                window.location.href = "/admin/dashboard"
                }
                else if(role.includes('Academic Head')){
                    window.location.href = "/acad_head/dashboard"
                }
                else if(role.includes('Faculty')){
                    window.location.href = "/faculty/dashboard"
                }
                else if(role.includes('Checker')){
                    window.location.href = "/checker/dashboard"
                }
                else{
                    window.location.href = "/"
                }
            }
            else{
                removeLoader()
            }
        }
        
        checkLoggedIn()

        $('#loginForm').on('submit', function(e){
            e.preventDefault()

            var form_url = APP_URL+'/api/v1/login/'
            var form = $("#loginForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })

            console.log(JSON.stringify(data))
            // ajax opening tag
            $.ajax({
                url: form_url,
                method: "POST",
                data: JSON.stringify(data),
                dataType: "JSON",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                success: function(data){
                    console.log(data)
                    localStorage.setItem('API_TOKEN', data.token);
                    localStorage.setItem('USER_DATA', JSON.stringify(data.user));

                    let role = []

                    $.each(data.user.user_role, function(i){
                        role.push(data.user.user_role[i].role.title)
                    })
                    
                    toastr.success('Login Success')
                    setInterval(function(){
                        if(role.includes('Admin')){
                        window.location.href = "/admin/dashboard"
                        }
                        else if(role.includes('Academic Head')){
                            window.location.href = "/acad_head/dashboard"
                        }
                        else if(role.includes('Faculty')){
                            window.location.href = "/faculty/dashboard"
                        }
                        else if(role.includes('Checker')){
                            window.location.href = "/checker/dashboard"
                        }
                        else{
                            window.location.href = "/"
                        }
                    }, 2000)
                },
                error: function(error){
                    swalAlert('warning', `${error.responseJSON.message}`)
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        })

    // END OF JQUERY FUNCTIONS
    });
</script>

