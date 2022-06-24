
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/role/'
        var USER_ID = "{{ $user_id }}"
        // END OF GLOBAL VARIABLE



    // END OF JQUERY FUNCTIONS
    });
</script>
