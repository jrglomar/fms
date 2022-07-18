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
            </div>
            <div class="card-body">

                <form id="updateForm" data-parsley-validate>
                    

                    {{-- DESIGNATION, ACAD RANK, FACULTY TYPES --}}
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
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="hire_date">Hire Date</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="birthplace">Birthplace</label>
                            <input  type="text" class="form-control" id="birthplace" name="birthplace">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="province">Province</label>
                            <input  type="text" class="form-control" id="province" name="province">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="province">City</label>
                            <input  type="text" class="form-control" id="city" name="city">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="barangay">Barangay</label>
                            <input  type="text" class="form-control" id="barangay" name="barangay">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="street">Street</label>
                            <input  type="text" class="form-control" id="street" name="street">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="house_number">House Number</label>
                            <input  type="text" class="form-control" id="house_number" name="house_number">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Update Details</button>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- END OF CREATE FORM --}}

