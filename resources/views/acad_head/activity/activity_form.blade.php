{{-- CREATE FORM --}}

<div class="row">
    <div class="col-md-12 collapse" id="create_card">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">Create </span>{{ $page_title }}</h4>
            </div>

            <form id="createForm" class="needs-validation" novalidate=""
            enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required-input">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                            placeholder="Title" tabindex="1" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-input">Activity Type</label>
                            <select class="form-control select2" id="activity_type_id"
                                name="activity_type_id" required
                                data-parsley-errors-container="#activity-type-errors">
                            </select>
                            <ul class="parsley-err-msg">
                                <li id="activity-type-errors"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                            placeholder="Description" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required-input">Status</label>
                            <select class="form-control select2" id="status"
                                name="status" required
                                data-parsley-errors-container="#activity-type-errors">
                                <option selected="selected" value="" disabled>-- Select Status --</option>
                                <option value="Pending">Pending</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Ended">Ended</option>
                            </select>
                            <ul class="parsley-err-msg">
                                <li id="activity-type-errors"></li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-input">Required to attend</label>
                            <select class="form-control select2" id="is_required"
                                name="is_required" required
                                data-parsley-errors-container="#activity-type-errors">
                                <option value="1">Yes</option>
                                <option selected="selected" value="0">No</option>
                            </select>
                            <ul class="parsley-err-msg">
                                <li id="activity-type-errors"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row additional-form">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Memorandum</label>
                            <input type="file" class="form-control" id="memorandum_file_directory" name="memorandum_file_directory"
                            tabindex="1" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#create_card"
                        id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                    <button type="submit" class="btn btn-primary ml-1" id="create_btn">Create <i
                            class="fas fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- END OF CREATE FORM --}}

