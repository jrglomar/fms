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

