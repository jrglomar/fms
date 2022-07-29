<div id="observationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class Schedule Observation </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="setObservationForm" data-parsley-validate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 mb-5">
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
                            <div class="col-4 mb-5">
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
                            <div class="col-12 mb-5">
                                <div class="d-flex justify-content-between">
                                    <h5>  Faculty Details </h5>
                                </div> &nbsp;
                                <li class="media">
                                    <img id="faculty_image" alt="image" class="mr-3 rounded-circle" width="70" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png">
                                    <div class="media-body">
                                      <h6 class="font-weight-bold">Name: <span id="faculty_name_modal" class="font-weight-light">-</span></h6>
        
                                      <div class="row">
                                        {{-- <div class="col-12">
                                            <label class=" mb-3 font-weight-bold">Details: </label>
                                        </div> --}}
                                      </div>
                                      <div class="row px-4">
                                        <div class="col-6">
                                                <div class="font-weight-bold mb-2">Faculty Type: <span id="faculty_type_modal" class="font-weight-light">-</span></div>
                                                <div class="font-weight-bold mb-2">Academic Rank: <span id="faculty_academic_rank_modal" class="font-weight-light">-</span></div>
                                                <div class="font-weight-bold mb-2">Designation: <span id="faculty_designation_modal" class="font-weight-light">-</span></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="font-weight-bold mb-2">Role: <span id="faculty_role_modal" class="font-weight-light">-</span></div>
                                            <div class="font-weight-bold mb-2">Specialization: <span id="faculty_specialization_modal" class="font-weight-light">-</span></div>
                                            <div class="font-weight-bold mb-2">Program: <span id="faculty_program_modal" class="font-weight-light">-</span></div>
                                        </div>
                                      </div>
                                      
                                    </div>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="class_schedule_id" name="class_schedule_id"
                                placeholder="ID" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Date Schedule</label>
                                <input type="date" class="form-control" id="date_of_observation" name="date_of_observation"
                                placeholder="Select Date Schedule" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">Start Time</label>
                                <input type="time" class="form-control" id="start_time_input" name="start_time_input"
                                disabled tabindex="1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="required-input">End Time</label>
                                <input type="time" class="form-control" id="end_time_input" name="end_time_input"
                                disabled tabindex="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btnSubmitObservation">Set Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editRequiredFacultyModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attendance List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateRequiredFacultyForm">
                    <table class="table table-hover table-sm" id="requiredFacultyDatatableModal" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                            <th>ID</th>
                            <th>Created at</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Required</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btnUpdate">Update changes</button>
            </div>
                </form>
        </div>
    </div>
</div>

<div id="fileViewerModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div id="fileModalHeader">
                    
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="fileModalBody">

                </div>
                <input type="text" id="attendance_id" hidden>
                <div class="form-group">
                    <label class="">URL Link</label>
                    <div class="input-group col-md-12">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" id="copyURL" type="button"><i class="fas fa-copy"></i></button>
                        </div>
                        <input class="form-control" type="text" disabled id="proof_link_view">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="required-input">Status</label>
                        <select class="form-control js-example-basic-single" id="proof_status" name="proof_status">
                            <option selected disabled value="">Choose status</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                            <option value="For Revision">For Revision</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Remarks</label>
                        <textarea class="form-control" id="proof_remarks" name="proof_remarks"
                        placeholder="Remarks" tabindex="1"></textarea>
                    </div>
                    <div class="form-group col-md-12" hidden>
                        <label class="required-input">ID</label>
                        <input class="form-control" id="sr_id" name="sr_id">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btnSubmittedUpdate">Update changes</button>
            </div>
        </div>
    </div>
</div>