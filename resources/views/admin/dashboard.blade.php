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
            
            {{-- NAV BAR --}}
            <admin-navbar-component></admin-navbar-component>
            {{-- END OF NAV BAR --}}

            {{-- SIDE BAR --}}
            <admin-sidebar-component></admin-sidebar-component>
            {{-- END OF SIDE BAR --}}

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>

                    <div class="section-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary" id="create_card">
                                    <div class="card-header">
                                        <h4 class="text-dark"> <span id="create_card_title">Create</span> User</h4>
                                    </div>
                                    <input type="hidden" id="id" name="id">
                                    <form id="create_form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="required-input">Faculty</label>
                                                    <select class="form-control select2" id="faculty_id"
                                                        name="faculty_id" required
                                                        data-parsley-errors-container="#faculty-errors">
                                                    </select>
                                                    <ul class="parsley-err-msg">
                                                        <li id="faculty-errors"></li>
                                                    </ul>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="required-input">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Email" tabindex="1" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="button" class="btn btn-secondary"
                                                id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                                            <button type="submit" class="btn btn-primary ml-1" id="create_btn">Create <i
                                                    class="fas fa-check"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="text-dark">List of Users</h4>
                                        <div class="card-header-action">
                                            <button class="btn btn-icon btn-primary" id="new_btn">New User <i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex mb-3 justify-content-start">
                                            <div id="dt_btn_div">
                                            </div>
                                        </div>

                                        <table class="table table-striped" id="user_table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Faculty</th>
                                                    <th>Email</th>
                                                    <th>Created At</th>
                                                    <th>Updated At</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>Test</td>
                                                <td>test@gmail.com</td>
                                                <td>May 30, 2022</td>
                                                <td>May 30, 2022</td>
                                                <td><span class="badge badge-success rounded-pill">Active <i
                                                            class="fas fa-check"></i></span></th>
                                                <td>
                                                    <div class="btn-group dropleft">
                                                        <button class="btn btn-sm btn-secondary btn-icon rounded-circle"
                                                            type="button" id="action_menu_btn" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <div class="dropdown-title">Actions</div>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-eye mr-1"></i> View</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-pen text-info mr-1"></i> Update</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-trash text-danger mr-1"></i>
                                                                Deactivate</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-trash-restore-alt text-success mr-1"></i>
                                                                Restore</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fas fa-times-circle text-danger mr-1"></i>
                                                                Delete</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tbody>
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
    </script>
    
</body>

</html>