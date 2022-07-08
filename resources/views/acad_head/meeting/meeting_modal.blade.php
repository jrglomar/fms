
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
                            <div class="form-group col-md-12" hidden>
                                <label><b>ID</b></label>
                                <p id="id_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Title</b></label>
                                <p id="title_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Location</b></label>
                                <p id="location_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Meeting Type</b></label>
                                <p id="meeting_types_id_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Agenda</b></label>
                                <p id="agenda_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Descrition</b></label>
                                <p id="description_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label><b>Start Time</b></label>
                                <p id="start_time_view" class="card-text"></p>
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>End Time</b></label>
                                <p id="end_time_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Required?</b></label>
                                <p id="is_required_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Status</b></label>
                                <p id="status_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label><b>Date Created</b></label>
                                <p id="created_at_view" class="card-text"></p>
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
                        <div class="row">
                            <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="id_edit" name="id_edit"
                                placeholder="ID" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Title</label>
                                <input type="text" class="form-control" id="title_edit" name="title_edit"
                                placeholder="Title" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Location</label>
                                <input type="text" class="form-control" id="location_edit" name="location_edit"
                                placeholder="Location" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Meeting Type</label>
                                <select class="form-control js-example-basic-single select2" id="meeting_types_id_edit" name="meeting_types_id_edit">
                                </select>
                            </div>   
                            <div class="form-group col-md-12">
                                <label class="required-input">Agenda</label>
                                <input type="text" class="form-control" id="agenda_edit" name="agenda_edit"
                                placeholder="Agenda" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Description</label>
                                <textarea class="form-control" rows="4" cols="50" id="description_edit" name="description_edit" form="updateForm" placeholder="Description" tabindex="1" required></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="required-input">Date</label>
                                <input type="date" class="form-control" id="date_edit" name="date_edit"
                                placeholder="date" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Start Time</label>
                                <input type="time" class="form-control" id="start_time_edit" name="start_time_edit"
                                placeholder="Start Time" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">End Time</label>
                                <input type="time" class="form-control" id="end_time_edit" name="end_time_edit"
                                placeholder="End Time" tabindex="1" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Is Required</label>
                                <select class="form-control js-example-basic-single" id="is_required_edit" name="is_required_edit">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>   
                            <div class="form-group col-md-12">
                                <label class="required-input">Status</label>
                                <select class="form-control js-example-basic-single" id="status_edit" name="status_edit">
                                    <option value="Pending">Pending</option>
                                    <option value="Done">Done</option>
                                </select>
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
                                    Are you sure you want to delete this meeting type? <span id="description_delete"></span>?
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
