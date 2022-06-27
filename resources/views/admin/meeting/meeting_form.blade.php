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
                        <div class="form-group col-md-12">
                            <label class="required-input">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                            placeholder="Title" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Meeting Type</label>
                            <select class="form-control js-example-basic-single" id="meeting_types_id" name="meeting_types_id">
                            </select>
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Agenda</label>
                            <input type="text" class="form-control" id="agenda" name="agenda"
                            placeholder="Agenda" tabindex="1" required>
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
                        <div class="form-group col-md-12">
                            <label class="required-input">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"
                            placeholder="Start Time" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time"
                            placeholder="End Time" tabindex="1" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Is Required</label>
                            <select class="form-control js-example-basic-single" id="is_required" name="is_required">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
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

