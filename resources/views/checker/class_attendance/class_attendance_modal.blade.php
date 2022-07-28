
{{-- VIEW MODAL --}}
<div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View {{ $page_title }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="viewForm" class="needs-validation" novalidate="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <p id="title_view" class="card-text"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Activity Type</label>
                                <p id="activity_type_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <p id="description_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <p id="status_view" class="card-text"></p>
                                <ul class="parsley-err-msg">
                                    <li id="activity-type-errors"></li>
                                </ul>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Required to attend</label>
                                <p id="is_required_view" class="card-text"></p>
                                <ul class="parsley-err-msg">
                                    <li id="activity-type-errors"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Start Time</label>
                                <p id="start_time_view" class="card-text"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Time</label>
                                <p id="end_time_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Memorandum</label>
                                <embed id="memorandum_view" src="" 
                                width="640" height="512" scale="tofit"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
{{-- END OF VIEW MODAL --}}

{{-- EDIT MODAL --}}
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{ $page_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" data-parsley-validate>
                    <div class="card-body">
                        <div class="form-group col-md-12" hidden>
                            <label class="required-input">ID</label>
                            <input type="text" class="form-control" id="id_edit" name="id_edit"
                            placeholder="ID" tabindex="1" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required-input">Title</label>
                                <input type="text" class="form-control" id="title_edit" name="title_edit"
                                placeholder="Title" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">Activity Type</label>
                                <select class="form-control" id="activity_type_id_edit"
                                    name="activity_type_id_edit" required
                                    data-parsley-errors-container="#activity-type-errors">
                                </select>
                                <ul class="parsley-err-msg">
                                    <li id="activity-type-errors"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="">Description</label>
                                <input type="text" class="form-control" id="description_edit" name="description_edit"
                                placeholder="Description" tabindex="1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="">Location</label>
                                <input type="text" class="form-control" id="location_edit" name="location_edit"
                                placeholder="Location" tabindex="1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required-input">Status</label>
                                <select class="form-control" id="status_edit"
                                    name="status_edit" required
                                    data-parsley-errors-container="#status-edit-errors">
                                    <option value="" disabled>-- Select Status --</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Ended">Ended</option>
                                </select>
                                <ul class="parsley-err-msg">
                                    <li id="status-edit-errors"></li>
                                </ul>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">Required to attend</label>
                                <select class="form-control" id="is_required_edit"
                                    name="is_required_edit" required
                                    data-parsley-errors-container="#req-edit-errors">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <ul class="parsley-err-msg">
                                    <li id="req-edit-errors"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="required-input">Memorandum</label>
                                <input hidden type="text" id="memorandum_path">
                                <input type="file" accept=".jpg, .png, .jpeg, .pdf" class="form-control" id="memorandum_file_directory_edit" name="memorandum_file_directory_edit"
                                tabindex="1">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btnUpdate">Update changes</button>
            </div>
                </form>
        </div>
    </div>
  </div>
{{-- END OF VIEW MODAL --}}

{{-- DEACTIVATE MODAL --}}
<div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deactivate {{ $page_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deactivateForm" class="needs-validation" novalidate="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="id_delete" name="id_delete"
                                placeholder="ID" tabindex="1">
                            </div>
                            <div class="form-group col-md-12">
                                <label>
                                    Are you sure you want to delete this activity ? <span id="description_delete"></span>?
                                </label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Confirm</button>
            </div>
                </form>
        </div>
    </div>
  </div>
{{-- DEACTIVATE OF VIEW MODAL --}}



{{-- EDIT CLASS ATTENDANCE --}}
<div id="editProofOfAttendanceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class Schedule Attendance </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProofOfAttendanceForm" data-parsley-validate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="d-flex justify-content-between">
                                    <h5> Subject Details </h5>
                                </div>        
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Assignment Code: <span id="assignment_code_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Teaching Hours: <span id="teaching_hours_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Subject Code: <span id="subject_code_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Status: <span id="subject_status_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Subject Schedule: <span id="subject_schedule_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Subject Description: <span id="subject_description_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-between">
                                    <h5> Room Details </h5>
                                </div>         
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Building: <span id="room_building_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Room Number: <span id="room_number_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Floor: <span id="room_floor_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Room Type: <span id="room_type_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-dark" style="margin-bottom: 0px">
                                                <label class="font-weight-bold" for="">Status: <span id="room_status_modal" class="font-weight-light">-</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="class_attendance_id_e" name="class_attendance_id_e"
                                placeholder="ID" tabindex="1" required disabled>
                            </div>
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="class_schedule_id_e" name="class_schedule_id_e"
                                placeholder="ID" tabindex="1" required disabled>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Date of Class</label>
                                <input type="date" class="form-control date_of_class_e" id="date_of_class_e" name="date_of_class_e"
                                placeholder="Select Date Schedule" tabindex="1" required disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">Start Time</label>
                                <input type="time" class="form-control" id="start_time_input_e" name="start_time_input_e"
                                disabled tabindex="1" required disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">End Time</label>
                                <input type="time" class="form-control" id="end_time_input_e" name="end_time_input_e"
                                disabled tabindex="1" required disabled>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label class="required-input">Proof of Attendance <span class="text-red">(.png, .jpg, jpeg)</span></label>
                            </div>
                        </div>

                    </form>
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="dropzone" style="border: 2px dashed #a6c4ff"
                                        id="editFileupload">
                                </form>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Status</label>
                            <select class="form-control js-example-basic-single" id="status_e" name="status_e">
                                <option selected disabled value="">Choose status</option>
                                <option value="For Revision">For Revision</option>
                                <option value="Declined">Declined</option>
                                <option value="Approved">Approved</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control" id="remarks_e" name="remarks_e"
                            placeholder="Remarks" tabindex="1"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="btnUpdateAttendanceStatus">Update Changes</button>
                    </div>
            </div>
        </div>
    </div>
</div>
