
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
                                <label>ID</label>
                                <p id="id_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Requirement Bin</label>
                                <p id="requirement_bin_id_view" class="card-text"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Requirement Type</label>
                                <p id="requirement_type_id_view" class="card-text"></p>
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
                <form id="updateForm" class="needs-validation" novalidate="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="required-input">Requirement Bin</label>
                                <select class="form-control js-example-basic-single" id="requirement_bin_id_edit" name="requirement_bin_id_edit">
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="required-input">Requirement Type</label>
                                <select class="form-control js-example-basic-single" id="requirement_type_id_edit" name="requirement_type_id_edit">
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
                                    Are you sure you want to remove this? <span id="description_delete"></span>?
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


{{-- CREATE REQUIREMENT DOCUMENT MODAL --}}
<div id="createRequiredDocumentModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{ $page_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" class="needs-validation" novalidate="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <!-- <label class="required-input">Requirement Bin</label> -->
                                <input type="hidden" class="form-control" id="requirement_bin_id" name="requirement_bin_id"
                                tabindex="1" value="" required>
                            </div>                       
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="required-input">Document</label>
                                <select class="form-control js-example-basic-single" id="requirement_type_id" name="requirement_type_id">
                                </select>
                            </div>                       
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Required Document</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- END OF VIEW MODAL --}}



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
                    <div class="card-body">
                        <table class="table table-sm" id="requiredFacultyDatatableModal" style="width:100%">
                            <thead>
                                <tr>
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