<style>    
    /* body {
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #D1C4E9;
        background-repeat: no-repeat;
    } */
    
    /* .container {
        margin: 200px auto;
    } */
    
    fieldset {
        display: none;
    }
    
    fieldset.show {
        display: block;
    }
    
    select:focus, input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400;
    }
    
    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0;
    }
    
    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer;
    }
    
    .tabs:hover, .tabs.active {
        border-bottom: 1px solid #2196F3;
    }
    
    a:hover {
        text-decoration: none;
        color: #1565C0;
    }
    
    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px;
    }
    
    .modal-backdrop { 
        background-color: #64B5F6;
    }
    
    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%;
    }
    
    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px;
        }
    }
    </style>

<div class="row">
    <div class="col-8 col-sm-8 col-lg-8">
        <div class="hero bg-success text-white">
            <div class="hero-inner">
                <div class="col-12">
                        <h3 class="text-center"><span id="title"></span></h3>
                        <span class="badge badge-info">
                            <span>Posted by </span><span id="created_by"></span>
                        </span>
                        <div class="text-dark float-right">
                            <span class="badge badge-warning">
                                <span id="act_type"></span>
                                <span>•</span>
                                <span id="is_required"></span>
                            </span>
                        </div>
                </div>
            </div>
            <div class="card-body">
                <span class="" style="white-space: pre-line" id="description"></h3>
            </div>
            <div id="time_button">
                <button type="button" class="btn btn-primary"
                data-toggle="modal" data-target="#memo_card" role="button" aria-expanded="false" aria-controls="memo_card"
                >View Memo</button>
            </div>
        </div>
    </div>

    <div class="col-4 col-sm-4 col-lg-4">
        <div class="hero bg-info text-white">
            <div class="hero-inner">
                <div class="d-flex justify-content-between">
                    <h5> <i class="fa fa-info-circle"></i> Activity Details</h5>
                </div>          
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Start time:</label>
                            <p id="start_time"></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">End time:</label>
                            <p id="end_time"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Location:</label>
                            <p id="location"></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Status:</label>
                            <p id="status"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- END OF VIEW MODAL --}}