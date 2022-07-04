<div class="row">
    <div class="col-9 ">
        <div class="hero bg-success text-white">
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
            <div class="card-body">
                <span class="" style="white-space: pre-line" id="description">
            </div>
        </div>
    </div>


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

        <div class="col-3">
            <div class="hero bg-white text-dark">
                <div class="hero-inner">
                    <div class="align-items-center">
                        <div class="row">
                            <span class="text-lg" style="padding-left:10px; font-size:18pt"> Your work</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center" style="padding-bottom:10px;">
                        {{-- <button id="btnUpload" type="button" class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"></i> Upload</button> --}}
                        <form action="#" class="dropzone dz-clickable" id="mydropzone">
                      
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
                    </div>
                    <div id="btnDone" class="d-flex justify-content-center">
                        <button type="button" class="btn btn-warning">Mark as Done</button>
                    </div>
                </div>
            </div>
        </div>
</div>