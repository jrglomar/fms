{{-- NAVS

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li>
    </ul>&nbsp; --}}
{{-- DATATABLES --}}
<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">List of Class Schedules</h4>
                    {{-- <div class="card-header-action">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_card"
                        aria-expanded="false" aria-controls="create_card">New activity <i
                        class="fas fa-plus"></i></button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-start">
                        <div id="dt_btn_div">
                        </div>
                    </div>

                    <table class="table table-hover table-sm" id="dataTable" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>ID</th>
                                <th>Created at</th>
                                <th width="10%">Assignment Code</th>
                                <th>Faculty</th>
                                <th>Subject Code</th>
                                <th>Subject Title</th>
                                <th width="5%">Units</th>
                                <th>Year & Section</th>
                                <th>Room</th>
                                <th>Schedule</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th hidden>ID</th>
                                <th hidden>Created at</th>
                                <th width="10%">Assignment Code</th>
                                <th>Faculty</th>
                                <th>Subject Code</th>
                                <th>Subject Title</th>
                                <th width="5%">Units</th>
                                <th>Year & Section</th>
                                <th>Room</th>
                                <th>Schedule</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
