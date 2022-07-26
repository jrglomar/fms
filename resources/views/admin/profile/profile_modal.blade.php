{{-- EDIT MODAL --}}
<div id="educ_profile_editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Faculty Educational Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="educ_profile_updateForm" data-parsley-validate>
                    <div class="row">
                        <div class="form-group col-md-12" hidden>
                                <label class="required-input">ID</label>
                                <input type="text" class="form-control" id="id_edit" name="id_edit"
                                placeholder="ID" tabindex="1" required>
                            </div>
                        <div class="form-group col-md-12">
                            <label class="required-input" >Degree</label>
                            <select id="degree_edit" name="degree_edit" class="form-control select2">
                                <option disabled selected>List of degree/s</option>
                                <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                                <option value="Master’s Degree">Master’s Degree</option>
                                <option value="Post-Baccalaureate">Post-Baccalaureate</option>
                                <option value="Ph. D.">Ph. D.</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Program</label>
                            <input type="text" class="form-control" id="program_edit" name="program_edit"
                            placeholder="ex. Bachelor in Business Teacher Education" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>School</label>
                            <input type="text" class="form-control" id="school_edit" name="school_edit"
                            placeholder="ex. PUP" tabindex="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Year of Attendance</label>
                            <input type="text" class="form-control" id="year_of_attendance_edit" name="year_of_attendance_edit"
                            placeholder="ex. 2013-2017" tabindex="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="faculty_id_edit" name="faculty_id_edit"
                            placeholder="" tabindex="1" hidden>
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

