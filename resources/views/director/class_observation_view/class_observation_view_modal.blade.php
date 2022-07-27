<div id="updateStatusModal" class="modal fade" tabindex="-1" role="dialog">
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
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="class_schedule_id" name="class_schedule_id"
                                placeholder="ID" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Status</label>
                                <select class="form-control js-example-basic-single" id="obs_status" name="obs_status">
                                    <option selected disabled value="">Choose status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Done">Done</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Remarks</label>
                                <textarea class="form-control" id="obs_remarks" name="obs_remarks"
                                placeholder="Remarks" tabindex="1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btnUpdateObservationStatus">Update Status</button>
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