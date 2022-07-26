<div class="row">
    <div class="col-12">
        <div class="float-right">
            
            <button class="btn btn-primary btnSetObservation"><i class="fas fa-eye"></i> Make Observation</button>
        </div>
    </div>
</div>
&nbsp;

<div class="row">
    <div class="col-6">
        <div class="hero bg-white text-dark">
            <div class="hero-inner">
                <div class="d-flex justify-content-between">
                    <h5> Room Details </h5>
                </div>          
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Building: <span id="room_building" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Room Number: <span id="room_number" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Floor: <span id="room_floor" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Room Type: <span id="room_type" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Status: <span id="room_status" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="hero bg-white text-dark">
            <div class="hero-inner">
                <div class="d-flex justify-content-between">
                    <h5> Subject Details </h5>
                </div>          
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Code: <span id="subject_code" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Teaching Hours: <span id="teaching_hours" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Subject Time: <span id="subject_time" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Status: <span id="subject_status" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-dark" style="margin-bottom: 0px">
                            <label class="font-weight-bold" for="">Subject Description: <span id="subject_description" class="font-weight-light">-</span></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
&nbsp;
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="hero bg-white text-dark">
            <div class="hero-inner">
                <div class="d-flex justify-content-between">
                    <h5>  Faculty </h5>
                </div> 
                <div class="card-body">
                    {{-- <span class="" style="white-space: pre-line" id="description"></h3> --}}
                        <li class="media">
                            <img id="faculty_image" alt="image" class="mr-3 rounded-circle" width="70" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png">
                            <div class="media-body">
                              <h6 class="font-weight-bold">Name: <span id="faculty_name" class="font-weight-light">-</span></h6>

                              <div class="row">
                                {{-- <div class="col-12">
                                    <label class=" mb-3 font-weight-bold">Details: </label>
                                </div> --}}
                              </div>
                              <div class="row px-4">
                                <div class="col-6">
                                        <div class="font-weight-bold mb-2">Faculty Type: <span id="faculty_type" class="font-weight-light">-</span></div>
                                        <div class="font-weight-bold mb-2">Academic Rank: <span id="faculty_academic_rank" class="font-weight-light">-</span></div>
                                        <div class="font-weight-bold mb-2">Designation: <span id="faculty_designation" class="font-weight-light">-</span></div>
                                </div>
                                <div class="col-6">
                                    <div class="font-weight-bold mb-2">Role: <span id="faculty_role" class="font-weight-light">-</span></div>
                                    <div class="font-weight-bold mb-2">Specialization: <span id="faculty_specialization" class="font-weight-light">-</span></div>
                                    <div class="font-weight-bold mb-2">Program: <span id="faculty_program" class="font-weight-light">-</span></div>
                                </div>
                              </div>
                              
                            </div>
                          </li>
                </div>
                {{-- <div>
                    <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#memo_card" role="button" aria-expanded="false" aria-controls="memo_card"
                    >View Memo</button>
                </div> --}}
            </div>
           
        </div>
    </div>
</div>



{{-- END OF VIEW MODAL --}}