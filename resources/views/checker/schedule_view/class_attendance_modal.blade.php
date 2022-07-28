
{{-- ADD CLASS ATTENDANCE --}}
<div id="proofOfAttendanceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class Schedule Attendance </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="proofOfAttendanceForm" data-parsley-validate>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="class_schedule_id_a" name="class_schedule_id"
                                placeholder="ID" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Date of Class</label>
                                <input type="date" class="form-control" id="date_of_class_a" name="date_of_class_a"
                                placeholder="Select Date Schedule" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">Start Time</label>
                                <input type="time" class="form-control" id="start_time_input_a" name="start_time_input"
                                disabled tabindex="1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">End Time</label>
                                <input type="time" class="form-control" id="end_time_input_a" name="end_time_input"
                                disabled tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Proof of Attendance <span class="text-red">(.png, .jpg, jpeg)</span></label>
                            </div>
                            
                        </div>

                    </form>
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <form class="dropzone" style="border: 2px dashed #a6c4ff"
                                        id="fileupload">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btnSubmitProofOfAttendance">Submit</button>
                    </div>
            </div>
        </div>
    </div>
</div>


{{-- VIEW CLASS ATTENDANCE --}}

<div id="viewProofOfAttendanceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class Schedule Attendance </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="viewProofOfAttendance" data-parsley-validate>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Date of Class: </label>
                                <p class="text-dark" id="view_date_of_class"></p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Start Time: </label>
                                <p class="text-dark" id="view_start_time"></p>
                            </div>
                            <div class="form-group col-md-4">
                                <label>End Time: </label>
                                <p class="text-dark" id="view_end_time"></p>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Proof of Attendance: </label>
                                <div id="view_proof_of_attendance">
                                    
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
</div>


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
                                placeholder="Select Date Schedule" tabindex="1" required>
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
