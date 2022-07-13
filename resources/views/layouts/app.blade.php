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
    {{-- <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/dropzonejs/dropzone.css"> --}}
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    

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
        {{-- <script src="https://demo.getstisla.com/assets/modules/dropzonejs/min/dropzone.min.js"></script> --}}
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        {{-- <script src="https://demo.getstisla.com/assets/js/page/components-multiple-upload.js"></script> --}}

        <!-- Template JS File -->
        <script src="{{ asset('stisla/js/stisla.js') }}"></script>
        <script src="{{ asset('stisla/js/scripts.js') }}"></script>
        <script src="{{ asset('stisla/js/custom.js') }}"></script>

        <script src="{{ mix('js/app.js') }}"></script>

        @include('layouts/global_custom_scripts')
        
        <!-- Scripts -->
        @yield('script')
    </body>
</html>
