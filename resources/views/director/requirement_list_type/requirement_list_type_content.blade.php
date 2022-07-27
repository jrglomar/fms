<div class="row">
    <div class="col-8 col-sm-8 col-lg-8">
        <div class="hero hero-bg-parallax shadow-sm bg-white rounded"
        style="background-color: white">
            <div class="hero-inner">
                <div class="col-12">
                        <h3 class="text-center"><span id="title"></span></h3>
                        <span class="badge badge-info">
                            <span style="font-size: 14px">Posted by </span><span style="font-size: 14px" id="created_by"></span>
                        </span>
                        <div class="text-dark float-right" >
                            <span class="badge badge-warning">
                                <span style="font-size: 14px" >Due</span>
                                <span style="font-size: 14px" id="created_at"></span>
                            </span>
                        </div>
                </div>
            </div>
            &nbsp;
            <div class="hero-inner">
                <span class="text-black" style="white-space: pre-line; font-size: 14px" id="description"><span>
            </div>
        </div>
    </div>
    {{-- <div class="col-3 col-sm-3 col-lg-3">
        <div class="card">
            <div class="card-header">
                <div class="align-items-center">
                    <div class="row">
                        <span class="text-primary text-lg" style="padding-left:10px; font-size:18pt"> Your work</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center" style="padding-bottom:10px;">
                    <button type="button" class="btn btn-outline-info"><i class="fa fa-plus" aria-hidden="true"></i> Upload</button>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-warning">Mark as Done</button>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-4 col-sm-4 col-lg-4">
        <div class="hero hero-bg-parallax shadow-sm bg-white rounded"
        style="background-color: white">
            <div class="hero-inner">
                <div class="d-flex justify-content-between">
                    <h5> Required Document List</h5>
                    <div class="card-header-action">
                    </div>
                </div>
                
            </div>
            &nbsp;
            <div class="hero-inner">
                <ul id="requiredDocumentList" class="list-group overflow-auto">
                    <li class="list-group-item d-flex justify-content-between" disabled>
                        <span class="text-primary"><strong>Document Type</strong></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

&nbsp;