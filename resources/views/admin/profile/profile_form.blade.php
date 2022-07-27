<style>
    /* Dashed border */
    hr.dashed {
    border-top: 3px dashed #bbb;
    }

    /* Dotted border */
    hr.dotted {
    border-top: 3px dotted #bbb;
    }

    /* Solid border */
    hr.solid {
    border-top: 3px solid #bbb;
    }

    /* Rounded border */
    hr.rounded {
    border-top: 8px solid #bbb;
    border-radius: 5px;
    }

    .btn-see-educ-bg{
        border: none;
        background-color: inherit;
        cursor: pointer;
        display: inline-block;
    }

    .btn-see-educ-bg:hover {background: #fff;}

    .success {color: green;}
    .info {color: dodgerblue;}
    .warning {color: orange;}
    .danger {color: red;}
    .default {color: black;}

    .input-group-addon{
        font-size: 16px;
    }
    .btn-group .button {
        border: 0.5px gray;
        color: white;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        cursor: pointer;
        float: left;
    }

    .btn-group .button:not(:last-child) {
        border-right: none; /* Prevent double borders */
    }

    .btn-group .button:hover {
        background-color: #3e8e41;
    }
</style>
{{-- EDUCATIONCAL PROFILE FORM --}}
<div class="row">
    <div class="col-md-12 collapse" id="create_educational_profile_card">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_educational_profile_card_title">Educational Profile</h4>
            </div>

            <form id="createForm" data-parsley-validate>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input" >Degree</label>
                            <select id="degree" name="degree" class="form-control select2">
                                <option disabled selected>List of degree/s</option>
                                <option value="Bachelor’s Degree">Bachelor’s Degree</option>
                                <option value="Master’s Degree">Master’s Degree</option>
                                <option value="Post-Baccalaureate">Post-Baccalaureate</option>
                                <option value="Ph. D.">Ph. D.</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="required-input">Program</label>
                            <input type="text" class="form-control" id="program" name="program"
                            placeholder="ex. Bachelor in Business Teacher Education" tabindex="1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>School</label> <!-- class="required-input" for asterisk icon on label -->
                            <input type="text" class="form-control" id="school" name="school"
                            placeholder="ex. PUP" tabindex="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Year of Attendance</label>
                            <input type="text" class="form-control" id="year_of_attendance" name="year_of_attendance"
                            placeholder="ex. 2013-2017" tabindex="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="faculty_id" name="faculty_id"
                            placeholder="" tabindex="1" hidden>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#create_educational_profile_card"
                        id="create_cancel_btn">Cancel <i class="fas fa-times"></i></button>
                    <button type="submit" class="btn btn-primary ml-1" id="create_btn">Create <i
                            class="fas fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- END OF EDUCATIONCAL PROFILE FORM --}}


{{-- CREATE FORM --}}
<div class="row">
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">User </span>Settings</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <button class="btn" id="btnUploadImage" data-toggle="tooltip" data-placement="bottom" title="Upload Image">
                        <img alt="faculty_image" id="faculty_image" src="https://demo.getstisla.com/assets/img/avatar/avatar-1.png" style="width:120px" class="rounded-circle profile-widget-picture">
                    </button>  
                    
                  <input hidden type="file" id="uploadImage" name="uploadImage" accept="image/*" size="20" class="form-control-file">
                
                  </div>

                <form id="updateUserForm" data-parsley-validate>
                    {{-- EMAIL --}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required-input" for="email">Email</label>
                            <input disabled type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group col-md-2"></div>
                        <div class="form-group  col-md-4">
                            <label class="required-input" for="email">Status</label><br>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status">
                                <label id="status_label" class="custom-control-label" for="status">Inactive</label>
                            </div>
                        </div>
                    </div>

                    
                    {{-- USER ROLE --}}
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label class="required-input">User Role</label>
                        </div>
                        <div class="form-group col-md-10" id="role_id">
                            
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success float-right" >Save Changes</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">Faculty </span>Details</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#create_educational_profile_card"
                    aria-expanded="false" aria-controls="create_educational_profile_card">Add Faculty Educational Profile 
                        <i class="fas fa-plus"></i>
                    </button>
                    <!-- <button type="button" id="btnAddFacultyEducationalProfile" class="btn btn-primary btn-sm">Faculty Educational Profile  -->
                        <!-- <i class="fa fa-edit" aria-hidden="true"></i> -->
                    <!-- </button> -->
                </div>
            </div>
            <div class="card-body">
                <button class="btn-see-educ-bg info" onClick="return scrollDiv()"><b>See Educational Background</b></button>
                
                <form id="updateForm" data-parsley-validate>
                    

                    {{-- DESIGNATION, ACAD RANK, FACULTY TYPES, SPECIALIZATION, PROGRAM --}}
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="required-input" >Faculty Type</label>
                            <select id="faculty_type_id" name="faculty_type_id" class="form-control">
                                <option disabled selected>List of user/s</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input">Academic Rank</label>
                            <select id="academic_rank_id" name="academic_rank_id" class="form-control">
                                <option disabled selected>List of role/s</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input">Designation</label>
                            <select id="designation_id" name="designation_id" class="form-control">
                                <option disabled selected>List of role/s</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required-input" >Specialization</label>
                            <select id="specialization_id" name="specialization_id" class="form-control">
                                <option disabled selected>List of specialization/s</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-input">Program</label>
                            <select id="program_id" name="program_id" class="form-control select2">
                                <option disabled selected>List of program/s</option>
                            </select>
                        </div>
                    </div>

                    {{-- FIRST NAME, MIDDLE NAME, LAST NAME --}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="required-input" for="first_name">First Name</label>
                            <input  type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input" for="last_name">Last Name</label>
                            <input  type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                    </div>

                    {{-- SALUTATION, GENDER, BIRTHDATE, BIRTHPLACE --}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="required-input" for="gender">Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="Female">
                                <label class="form-check-label" for="gender1">Female</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Male">
                                <label class="form-check-label" for="gender2">Male</label>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="salutation">Salutation</label>
                            <input type="text" class="form-control" id="salutation" name="salutation">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input" for="phone_number">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="required-input" for="hire_date">Hire Date</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input" for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input" for="birthplace">Birthplace</label>
                            <input  type="text" class="form-control" id="birthplace" name="birthplace" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required-input" for="province">Province</label>
                            <input  type="text" class="form-control" id="province" name="province"required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required-input" for="province">City</label>
                            <input  type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="required-input" for="barangay">Barangay</label>
                            <input  type="text" class="form-control" id="barangay" name="barangay" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input" for="street">Street</label>
                            <input  type="text" class="form-control" id="street" name="street" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required-input" for="house_number">House Number</label>
                            <input  type="text" class="form-control" id="house_number" name="house_number" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Update Details</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row" id="educ_profile">
    <div class="col-md-4">
    </div>
    <div class="col-md-8">
        <!-- EDUCATIONAL PROFILE -->
        <div class="card card-info">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">Educational </span>Profile</h4>
            </div>
            <div class="card-body" id="educational_profile_card_body">
                
            </div>
        </div>
    </div>
</div>
{{-- END OF CREATE FORM --}}

