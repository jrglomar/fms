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
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

{{-- END UPLOAD PROOF OF ATTENDANCE / VALID REASON (FOR EXCUSE) MODAL --}}