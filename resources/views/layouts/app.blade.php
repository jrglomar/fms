<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('vendors/toastr/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatable/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/parsley/css/custom-parsley.css') }}">

    <!-- Template CSS -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/custom.css') }}">

    <style>
        #loading_cover {position: fixed; height: 100%; width: 100%; top:0; left: 0; background: rgb(255, 255, 255); z-index:9999;}
    </style>


    <!-- Styles -->
</head>
    <body>
        <div id="loading_cover">
            <div style="position: fixed; height:100%; width:100%; top:50%; left:50%">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
        </div>
        
          
        <div id="">

            {{-- NAVBAR --}}
                @yield('navbar')

            {{-- SIDEBAR --}}
                @yield('sidebar')

                
                <div class="main-content">
                    <section class="section">

                        <div class="section-header">
                            @yield('section_header')
                        </div>

                        <div class="section-body">
                            @yield('content')
                        </div>
                    </section>
                </div>

                @yield('footer')
        </div>

        <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Libraries -->
        <script src="{{ asset('vendors/parsley/js/parsley.min.js') }}"></script>
        <script src="{{ asset('vendors/toastr/js/toastr.min.js') }}"></script>
        <script src="{{ asset('vendors/jquery-cookie/jquery-cookie.js') }}"></script>
        <script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('vendors/datatable/js/datatables.min.js') }}"></script>

        <!-- Template JS File -->
        <script src="{{ asset('stisla/js/stisla.js') }}"></script>
        <script src="{{ asset('stisla/js/scripts.js') }}"></script>
        <script src="{{ asset('stisla/js/custom.js') }}"></script>

        <script src="{{ mix('js/app.js') }}"></script>

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
        

        <!-- Scripts -->
        @yield('script')
    </body>
</html>
