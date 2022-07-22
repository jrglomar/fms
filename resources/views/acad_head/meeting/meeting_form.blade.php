{{-- CREATE FORM --}}
<div class="row">
    <div class="col-md-12 collapse" id="create_card">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">Create </span>{{ $page_title }}</h4>
            </div>

            <form id="createForm" data-parsley-validate>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                            placeholder="Title" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                            placeholder="Location" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required-input">Meeting Type</label>
                            <select class="form-control js-example-basic-single select2" id="meeting_types_id" name="meeting_types_id" 
                                required
                                data-parsley-errors-container="#meeting-type-errors">
                                    <option disabled selected>List of Meeting/s</option>
                            </select>
                            <ul class="parsley-err-msg">
                                <li id="meeting-type-errors"></li>
                            </ul>
                        </div>       
                        <div class="form-group col-md-6">
                            <label class="required-input">Agenda</label>
                            <input type="text" class="form-control" id="agenda" name="agenda"
                            placeholder="Agenda" tabindex="1" required>
                        </div>                
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Description</label>
                            <textarea class="form-control summernote-simple" rows="4" cols="50" id="description" name="description" form="createForm" placeholder="Description" tabindex="1" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="required-input">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                            placeholder="date" tabindex="1" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                            placeholder="Start Time" tabindex="1" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                            placeholder="End Time" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select class="form-control js-example-basic-single" id="is_required" name="is_required" value="1"
                                hidden
                                data-parsley-errors-container="#is-required-errors">
                                    <option disabled>Choose between Yes or No</option>>
                                    <option value="0">No</option>
                                    <option value="1" selected>Yes</option>
                            </select>
                            <ul class="parsley-err-msg">
                                <li id="is-required-errors"></li>
                            </ul>
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Status</label>
                            <input type="text" class="form-control" id="status" name="status"
                            value="Pending" placeholder="Status" tabindex="1" readonly>
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


