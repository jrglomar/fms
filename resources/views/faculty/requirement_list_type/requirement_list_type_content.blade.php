<div class="row">
    <div class="col-12">
        <div class="hero text-white hero-bg-image hero-bg-parallax"
        style="background-image: url({{ URL::to('/images/designs/req_bin_card_yellow.png') }})">
            <div class="hero-inner">
                <div class="col-12">
                        <h3 class="text-center"><span id="title"></span></h3>
                        <span class="badge">
                            <span>Posted by </span><span id="created_by"></span>
                        </span>
                        <div class="text-dark float-right">
                            <span class="badge badge-warning">
                                <span>Due</span>
                                <span id="created_at"></span>
                            </span>
                        </div>
                </div>
                &nbsp;
                <div class="col-12">
                    <div class="float-left">
                        <span class="badge badge-info" id="requiredDocumentList"></span>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="hero-inner text-center">
                <span class="" style="white-space: pre-line" id="description">
            </div>
        </div>
    </div>&nbsp;


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
