<div class="containeer">
    <div class="row">
        <div class="col-md-8">
            <div class="hero text-white hero-bg-image hero-bg-parallax"
            style="background-image: url({{ URL::to('/images/designs/req_bin_card_yellow.png') }});
            height: 450px">
                <div class="hero-inner">
                    <div class="col-12">
                            <h3 class="text-center"><span id="title"></span></h3>
                            <span class="badge badge-success">
                                <span style="font-size: 16px">Posted by </span><span style="font-size: 16px" id="created_by"></span>
                            </span>
                            <div class="text-dark float-right">
                                <span class="badge badge-warning" id="date_badge">
                                    <span style="font-size: 16px">Due</span>
                                    <span style="font-size: 16px" id="created_at"></span>
                                </span>
                            </div>
                    </div>
                    &nbsp;
                    <div class="col-12">
                        <div class="hero-inner">
                            <h5>Description:</h5>
                            <span class="" style="white-space: pre-line" style="font-size: 14px" id="description">
                        </div>

                        <div style="padding-top: 50px">
                            <ul class="list-group" id="requiredDocumentList" style="font-size: 16px;"></ul>
                        </div>
                    </div>
                </div>
                &nbsp;
                
            </div>
        </div>
        <div class="col-md-4">

            <div class="row">
                <div class="col-12">
                    <div class="hero text-white hero-bg-image hero-bg-parallax"
                    style="background-image: url({{ URL::to('/images/designs/req_bin_card_blue.png') }})">
                        <div class="hero-inner">
                            <div class="align-items-center">
                                <div class="row">
                                    <span class="text-lg" style="padding-left:10px; font-size:18pt"> Your work</span>
                                </div>
                            </div>
                        </div>
                        <div class="hero-inner">
                            <div class="d-flex justify-content-center">
                                <div class="col-12">
                                    <form class="dropzone" style="border: 2px dashed #a6c4ff"
                                            id="fileupload">
                                    </form>
                                </div>
                            </div>
                            <div id="btnUpload" class="d-flex justify-content-center">
                                <button type="button" class="btn btn-success">Process Upload</button>
                            </div>
                            &nbsp;
                            <div id="btnDone" class="d-flex justify-content-center">
                                <button id="btnMDone" type="button" class="btn btn-warning">Mark as Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        &nbsp;


            {{-- <div class="col-6">
                <div class="hero bg-info text-white">
                    <div class="hero-inner">
                        <div class="d-flex justify-content-between">
                            <h5> Required Document List</h5>
                            <div class="card-header-action">
                                <button id="createRequiredDocument" type="button" class="btn btn-warning btn-sm">Edit List <i class="fa fa-edit" aria-hidden="true"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div> --}}

            
    </div>
</div>
