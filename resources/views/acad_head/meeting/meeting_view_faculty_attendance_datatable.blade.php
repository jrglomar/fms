<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="text-dark">Attendance / Required Faculty List</h4>
                    <div class="card-header-action">
                        <button type="button" id="btnEditRequiredFaculty" class="btn btn-primary btn-sm">Edit Required Faculty List <i class="fa fa-edit" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3 justify-content-start">
                        <div id="dt_btn_div">
                        </div>
                    </div>
                    <input id="pdf_filename" value="download" hidden>
                    <input id="pdf_title" value="dynamic title" hidden>
                    <table class="table table-sm" id="requiredFacultyDatatable" style="width:100%">
                        <thead>
                            <tr>
                                <th class="hidden">ID</th>
                                <th>Date Created</th>
                                <th>Faculty Name</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Attendance Status</th>
                                <th>Proof of Attendance / Excuse Reason File Directory</th>
                                <th>Proof of Attendance Link / Excuse Reason</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>