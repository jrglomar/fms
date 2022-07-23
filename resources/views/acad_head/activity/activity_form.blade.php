{{-- CREATE FORM --}}

<div class="row">
    <div class="col-md-12 collapse" id="create_card">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">Create </span>{{ $page_title }}</h4>
            </div>

            <form id="createForm" data-parsley-validate
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
                            <label>Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                            placeholder="Description" tabindex="1" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                            placeholder="Location" tabindex="1" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 additional-input">
                            <label class="required-input">Start time</label>
                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                            tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:00:00"); }}" data-parsley-excluded="true">
                        </div>
                        <div class="form-group col-md-6 additional-input">
                            <label class="required-input">End time</label>
                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                            tabindex="1" value="{{ date("Y-m-d 00:00:00"); }}" min="{{ date("Y-m-d 00:01:00"); }}" data-parsley-excluded="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="dropzone clsbox form-group col-md-12" id="memo_upload">
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

