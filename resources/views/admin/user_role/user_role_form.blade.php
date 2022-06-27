{{-- CREATE FORM --}}
<div class="row">
    <div class="col-md-12 collapse" id="create_card">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">Create </span>{{ $page_title }}</h4>
            </div>

            <form id="createForm" class="needs-validation" novalidate="">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required-input">User</label>
                            <select id="user_id" name="user_id" class="form-control select2">
                                <option disabled selected>List of user/s</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-input">Role</label>
                            <select id="role_id" name="role_id" class="form-control select2">
                                <option disabled selected>List of role/s</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#create_card"
                        id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                    <button type="submit" class="btn btn-primary ml-1" id="create_btn">Submit <i
                            class="fas fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- END OF CREATE FORM --}}

