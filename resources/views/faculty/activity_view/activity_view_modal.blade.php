{{-- <div id="memo_card" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Memorandum </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" id="if_memo">
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}

<div id="editRequiredFacultyModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attendance List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateRequiredFacultyForm">
                    <table class="table table-hover table-sm" id="requiredFacultyDatatableModal" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                            <th>ID</th>
                            <th>Created at</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Required</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btnUpdate">Update changes</button>
            </div>
                </form>
        </div>
    </div>
</div>

<div id="editRequiredFacultyModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Attendance List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateRequiredFacultyForm">
                    <table class="table table-hover table-sm" id="requiredFacultyDatatableModal" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-light">
                            <th>ID</th>
                            <th>Created at</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Required</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btnUpdate">Update changes</button>
            </div>
                </form>
        </div>
    </div>
</div>

{{-- UPLOAD PROOF OF ATTENDANCE / VALID REASON (FOR EXCUSE) MODAL --}}
    <!-- Modal-->
    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                    <div class="tabs active" id="tab01">
                        <h6 class="font-weight-bold">Upload File</h6>
                    </div>
                    <div class="tabs" id="tab02">
                        
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="modal-body p-0">
                    <fieldset class="show" id="tab011">
                        <div class="bg-light">
                            <h5 class="text-center mb-4 mt-0 pt-4">Upload File</h5>
                                <!-- <div class="hero text-white hero-bg-image hero-bg-parallax"
                                style="background-image: url({{ URL::to('/images/designs/meeting_card_red.png') }})">
                                    <div class="hero-inner"> -->
                                        <div class="d-flex justify-content-center">
                                            <div class="col-12">
                                                <form class="dropzone"
                                                        id="fileupload">
                                                </form>
                                            </div>
                                        </div>
                                        <div id="btnUpload" class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-success">Submit</button>
                                        </div>
                                        <div>
                                            <br>
                                        </div>
                                    <!-- </div>
                                </div> -->
                        </div>
                    </fieldset>
                    <fieldset id="tab021">
                        <div class="bg-light">
                            <h5 class="text-center mb-4 mt-0 pt-4" id="header5forTab2"></h5>
                            <form id="proofLinkForm" data-parsley-validate>
                                <div class="form-group col-md-12" id ="LinkOrReasonContent">
                                    
                                </div>
                                <div class="form-group pb-5 row justify-content-center">
                                    <button type="submit" id="proofCreateBtn" class="btn btn-success px-3"></button>
                                </div>
                            </form>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-body border-0">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <form action="">
                                    <div class=" col-md-12">
                                        <label class="required-input">Status</label>
                                        <select class="form-control js-example-basic-single" id="proof_status" name="proof_status" disabled>
                                            <option selected disabled value="">Choose status</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Declined">Declined</option>
                                            <option value="For Revision">For Revision</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-12">
                                        <label>Remarks</label>
                                        <textarea class="form-control" id="proof_remarks" name="proof_remarks"
                                        placeholder="Remarks" tabindex="1" disabled></textarea>
                                    </div>
                                    <div class=" col-md-12" hidden>
                                        <label class="required-input">ID</label>
                                        <input class="form-control" id="sr_id" name="sr_id">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- END UPLOAD PROOF OF ATTENDANCE / VALID REASON (FOR EXCUSE) MODAL --}}

<!-- <div id="timeOutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                <div class="tabs-2 active" id="tab03">
                    <h6 class="font-weight-bold">Upload File</h6>
                </div>
                <div class="tabs-2" id="tab04">
                    <h6 class="text-muted">Upload Link</h6>
                </div>
            </div>
            <div class="line"></div>
            <div class="modal-body p-0">
                <fieldset class="show" id="tab031">
                    <div class="bg-light">
                        <h5 class="text-center mb-4 mt-0 pt-4">Upload File</h5>
                        <div class="col-12">
                            <div class="hero text-white hero-bg-image hero-bg-parallax"
                            style="background-image: url({{ URL::to('/images/designs/meeting_card_red.png') }})">
                                <div class="hero-inner">
                                    <div class="d-flex justify-content-center">
                                        <div class="col-12">
                                            <form class="dropzone proof_upload">
                                            </form>
                                        </div>
                                    </div>
                                    <div id="btnUpload" class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-success btnUpload">Process Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="tab041">
                    <div class="bg-light">
                        <h5 class="text-center mb-4 mt-0 pt-4">Upload Link</h5>
                        <form id="link_form" data-parsley-validate>
                            <div class="form-group pb-2 px-3">
                                <input type="text" id= "proof_link" placeholder="Link" class="form-control" required>
                            </div>
                            
                            <div class="form-group pb-5 row justify-content-center">
                                <button type="button" id="proof_link_submit" class="btn btn-primary px-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer d-flex flex-column justify-content-center border-0">
            </div>
        </div>
    </div>
</div>

<div id="viewSubmittedFiles" class="modal fade" tabindex="-1" role="dialog">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                <div class="tabs active" id="tab01">
                    <h6 class="font-weight-bold">Upload File</h6>
                </div>
                <div class="tabs" id="tab02">
                    <h6 class="text-muted">Upload Link</h6>
                </div>
            </div>
            <div class="line"></div>
            <div class="modal-body p-0">
                <fieldset class="show" id="tab011">
                    <div class="bg-light">
                        <h5 class="text-center mb-4 mt-0 pt-4">Upload File</h5>
                        <div class="col-12">
                            <div class="hero text-white hero-bg-image hero-bg-parallax"
                            style="background-image: url({{ URL::to('/images/designs/meeting_card_red.png') }})">
                                <div class="hero-inner">
                                    <div class="d-flex justify-content-center">
                                        <div class="col-12">
                                            <form class="dropzone proof_upload">
                                            </form>
                                        </div>
                                    </div>
                                    <div id="btnUpload" class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-success btnUpload">Process Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="tab021">
                    <div class="bg-light">
                        <h5 class="text-center mb-4 mt-0 pt-4">Upload Link</h5>
                        <form id="link_form" data-parsley-validate>
                            <div class="form-group pb-2 px-3">
                                <input type="text" id= "proof_link_view" placeholder="Link" class="form-control" required>
                            </div>
                            
                            <div class="form-group pb-5 row justify-content-center">
                                <button type="button" id="proof_link_edit" class="btn btn-primary px-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer d-flex flex-column justify-content-center border-0">
                <form action="">
                    <div class="row">
                        <label>Status</label>
                        <span class="form-control" id="proof_status"></span>
                    </div>
                    <div class="row">
                            <label>Remarks</label>
                            <span class="form-control" id="proof_remarks"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->