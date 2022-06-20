<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Designation &mdash; PUPQCSS</title>

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
</head>

<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            
            <!-- NAV BAR  -->
            <admin-navbar-component></admin-navbar-component>
            {{-- END OF NAV BAR  --}}

            <!-- SIDE BAR -->
            <admin-sidebar-component></admin-sidebar-component>
            <!-- END OF SIDE BAR  -->

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Designation</h1>
                    </div>

                    <div class="section-body">

                        {{-- Designation Creation Form Component--}}
                        <designation-create-form></designation-create-form>
                        
                        {{-- Designation Table --}}
                        <designation-datatable></designation-datatable>
                    </div>
                </section>
                {{-- Designation Update Modal Component--}}
                <designation-update-modal></designation-update-modal>
            </div>
            <!-- Main Content -->

             <!-- FOOTER -->
             <admin-footer-component></admin-footer-component>
             <!-- END OF FOOTER  -->

        </div>
    </div>


    <!-- General JS Scripts -->
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

    <script src="{{ mix('/js/app.js') }}"></script>

    <script>
        $("#create_form").parsley()

    </script>
    
</body>

</html>