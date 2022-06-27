@extends('layouts.login')

@section('content')

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // GLOBAL VARIABLE
            var APP_URL = {!! json_encode(url('/')) !!}
            var API_TOKEN = localStorage.getItem("API_TOKEN")
            // END OF GLOBAL VARIABLE

            function logout(){
                var form_url = APP_URL+'/api/v1/logout/'

                // ajax opening tag
                $.ajax({
                    url: form_url,
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        localStorage.removeItem('API_TOKEN');
                        localStorage.removeItem('USER_DATA');
                        window.location.href = APP_URL+'/login';
                    },
                    error: function(error){
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                        window.location.href = APP_URL+'/login';
                    }
                // ajax closing tag
                })
            }

            logout()

        });
    </script>
@endsection
