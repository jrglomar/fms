{{-- CREATE FORM --}}
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="text-dark"> <span id="create_card_title">User </span>Details</h4>
            </div>
            <div class="card-body">

                <form id="updateForm" class="needs-validation" novalidate="">
                    {{-- EMAIL --}}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input disabled type="email" class="form-control" id="email">
                        </div>
                    </div>
                    {{-- FIRST NAME, MIDDLE NAME, LAST NAME --}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="first_name">First Name</label>
                            <input required type="text" class="form-control" id="first_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">Last Name</label>
                            <input required type="text" class="form-control" id="last_name">
                        </div>
                    </div>

                    {{-- SALUTATION, GENDER, BIRTHDATE, BIRTHPLACE --}}
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
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
                            <input type="text" class="form-control" id="salutation">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="hire_date">Hire Date</label>
                            <input type="date" class="form-control" id="hire_date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="birthplace">Birthplace</label>
                            <input required type="text" class="form-control" id="birthplace">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="province">Province</label>
                            <input required type="text" class="form-control" id="province">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="province">City</label>
                            <input required type="text" class="form-control" id="province">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="barangay">Barangay</label>
                            <input required type="text" class="form-control" id="barangay">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="street">Street</label>
                            <input required type="text" class="form-control" id="street">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="house_number">House Number</label>
                            <input required type="text" class="form-control" id="house_number">
                        </div>
                    </div>
                    <div class="form-row">

                    <button type="submit" class="btn btn-primary">Update Details</button>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- END OF CREATE FORM --}}

