<div class="row">
    <div class="col-8 col-sm-8 col-lg-8">
        <div class="card card-info">
            <div class="card-header">
                <div class="col-12">
                        <h3 class="text-primary card-title"><i class="fa fa-folder-open" aria-hidden="true"></i> <span id="title"></span></h3>
                        <span id="created_by"></span>
                        <div class="text-dark float-right">
                            <span>Due</span>
                            <span id="created_at"></span>
                        </div>
                </div>
            </div>
            <div class="card-body">
                <span class="text-dark" style="white-space: pre-line" id="description"></h3>
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
        <div class="card card-success">
            <div class="card-header">
                <h4 class="text-dark"> Required Document List</h4>
                <div class="card-header-action">
                    <button id="createRequiredDocument" type="button" class="btn btn-info btn-sm">Edit Required List <i class="fa fa-edit" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="card-body">
                <ul id="requiredDocumentList" class="list-group overflow-auto">
                    <li class="list-group-item d-flex justify-content-between" disabled>
                        <span class="text-primary"><strong>Document Type</strong></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>