<div class="row">
    <div class="col-8 col-sm-8 col-lg-8">
        <div class="card card-primary">
            <div class="card-header">
                <div class="align-items-start">
                        <h3 class="text-primary card-title"><i class="fa fa-briefcase" aria-hidden="true"></i> <span id="title"></span></h3>
                        <span id="act_type"></span>
                        <span>•</span>
                        <span id="is_required"></span>
                </div>
            </div>
            <div class="card-body">
                <span style="color:black; white:space: pre-line" id="description"></span>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary"
                data-toggle="collapse" href="#memo_card" role="button" aria-expanded="false" aria-controls="memo_card"
                >View Memo</button>
            </div>
        </div>
    </div>
    <div class="col-4 col-sm-4 col-lg-4">
        <div class="card card-primary">
            <div class="card-header">
                <div class="align-items-start">
                    <h4 class="text-primary card-title"><i class="fa fa-info-circle"></i> Activity Details</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label for="">Start time:</label>
                            <p id="start_time"></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label for="">End time:</label>
                            <p id="end_time"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label for="">Location:</label>
                            <p id="location"></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label for="">Status:</label>
                            <p id="status"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary collapse" id="memo_card">
            <div class="card-header">
                <h4 class="text-primary">Memorandum</h4>
            </div>
            <div class="card-body" id="if_memo">
                
            </div>
        </div>
    </div>
</div>