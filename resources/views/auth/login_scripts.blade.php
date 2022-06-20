
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = "Bearer 1|QDOcaqiFz1CG5nPFI2zHYhi3bxwfJPGg2bj6w4EB"
        // END OF GLOBAL VARIABLE


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

                },
                error: function(error){
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

