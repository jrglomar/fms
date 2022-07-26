<div class="row">
    <div class="col-8 col-sm-8 col-lg-8">
        <div class="hero text-white hero-bg-image hero-bg-parallax"
        style="background-image: url({{ URL::to('/images/designs/green_activity.png') }})">
            <div class="hero-inner" id="hero_header">
            </div>
            <br>
            <div class="hero-inner" id="hero_body">
            </div>
        </div>
    </div>

    <div class="col-4 col-sm-4 col-lg-4">
        <div class="hero text-white hero-bg-image hero-bg-parallax"
        style="background-image: url({{ URL::to('/images/designs/green_activity.png') }})">
            <div class="hero-inner">
                <div class="row"> 
                    <div class="d-flex justify-content-between col-md-9">
                        <h5> <i class="fa fa-info-circle"></i> Activity Details</h5>
                    </div>   
                </div>      
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-warning" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Start time:</label>
                            <p id="start_time" class="text-white"></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-warning" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">End time:</label>
                            <p id="end_time" class="text-white"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-warning" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Location:</label>
                            <p id="location" class="text-white"></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-warning" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Status:</label>
                            <p id="status" class="text-white"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- END OF VIEW MODAL --}}