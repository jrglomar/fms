
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
                            <div class="form-group col-md-6 additional-input">
                                <label class="required-input">Start time</label>
                                <input type="datetime-local" class="form-control" id="start_datetime_edit" name="start_datetime"
                                tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:00:00"); }}" data-parsley-excluded="true">
                            </div>
                            <div class="form-group col-md-6 additional-input">
                                <label class="required-input">End time</label>
                                <input type="datetime-local" class="form-control" id="end_datetime_edit" name="end_datetime"
                                tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:01:00"); }}" data-parsley-excluded="true">
                            </div>
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
