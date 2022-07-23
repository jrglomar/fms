{{-- EDIT REQUIRED FACULTY --}}
<div id="editRequiredFacultyModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Required Faculty List</h5>
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
{{-- END EDIT REQUIRED FACULTY MODAL --}}

{{-- FILE MODAL VIEWER --}}
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
                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label class="required-input">Status</label>
                        <select class="form-control js-example-basic-single" id="sr_remarks" name="sr_remarks">
                            <option selected disabled>Choose status</option>
                            <option>Approved</option>
                            <option>Declined</option>
                            <option>For Revision</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required-input">Remarks</label>
                        <textarea class="form-control" id="sr_remarks" name="sr_remarks"
                        placeholder="Remarks" tabindex="1"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update changes</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF FILE MODAL VIEWER --}}


