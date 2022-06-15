<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard &mdash; PUPQCSS</title>

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
                        <h1>Activity</h1>
                    </div>

                    <div class="section-body">

                        {{-- Activity Creation Form Component--}}
                        <activity-create-form></activity-create-form>
                        
                        {{-- Activity Table --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="text-dark">List of Activities</h4>
                                        <div class="card-header-action">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_card"
                                            aria-expanded="false" aria-controls="create_card">New Activity <i
                                            class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex mb-3 justify-content-start">
                                            <div id="dt_btn_div">
                                            </div>
                                        </div>

                                        <table class="table table-striped" id="activity_table" style="width:100%">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Title</th>
                                                  <th>Type</th>
                                                  <th>Starts</th>
                                                  <th>Ends</th>
                                                  <th>Action</th>
                                                </tr>
                                              </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> <a href="#">PUPQC</a>
                </div>
                <div class="footer-right">
                    1.0
                </div>
            </footer>

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

        function dataTable(){
            activityTable = $('#activity_table').DataTable({
              "ajax": {url: "http://127.0.0.1:8000/api/v1/activity/",
                    dataSrc: ''},
              "columns": [
                  {data: "id"},
                  {data: "title"},
                  {data: "activity_type_id"},
                  {data: "start_datetime"},
                  {data: "end_datetime"},
                  {data: "deleted_at", render: function(data, type, row){
                        if (data == null){
                            return '<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                                '<div class="dropdown-item d-flex btn_view" id="'+ row.id +'" role="button">' +
                                  '<div style="width: 2rem"><i class="fas fa-eye"></i></div>' +
                                  '<div>View Category</div></div>' +
                                  '<div class="dropdown-item d-flex btn_edit" id="'+ row.id +'" role="button">' +
                                    '<div style="width: 2rem"><i class="fas fa-edit"></i></div>' +
                                    '<div>Edit Category</div></div>' +
                                    '<div class="dropdown-divider"</div></div>' +
                                    '<div class="dropdown-item d-flex btn_delete" id="'+ row.id +'" role="button">' +
                                      '<div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>' +
                                      '<div style="color: red">Delete Category</div></div></div></div>';
                        }
                        else{
                          return '<button class="btn btn-danger btn-sm">Activate</button>';
                        }
                      }
                  }
                ],
        
              "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
              "order": [[1, "desc"]]
        
            })
        
        };

        dataTable();
    </script>
    
</body>

</html>