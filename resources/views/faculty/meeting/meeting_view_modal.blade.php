{{-- UPLOAD PROOF OF ATTENDANCE MODAL --}}
    <!-- Modal-->
    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
                                                <form class="dropzone"
                                                        id="fileupload">
                                                </form>
                                            </div>
                                        </div>
                                        <div id="btnUpload" class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-success">Process Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="tab021">
                        <div class="bg-light">
                            <h5 class="text-center mb-4 mt-0 pt-4">Upload Link</h5>
                            <form>
                                <div class="form-group pb-2 px-3">
                                    <input type="text" placeholder="Link" class="form-control">
                                </div>
                                
                                <div class="form-group pb-5 row justify-content-center">
                                    <button type="button" id="createBtn" class="btn btn-primary px-3">Submit</button>
                                </div>
                            </form>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer d-flex flex-column justify-content-center border-0">
                    <!-- <p class="text-muted">Can't find what you're looking for?</p>
                    <button type="button" class="btn btn-primary">Contact Support Team</button> -->
                </div>
            </div>
        </div>
    </div>

{{-- END UPLOAD PROOF OF ATTENDANCE MODAL --}}