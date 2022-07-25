<script>
    $(document).ready(function(){
    
        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/requirement_required_faculty_list/'
        let R_BIN_ID = "{{ $requirement_bin_id }}"
        // END OF GLOBAL VARIABLE

        
        function requiredFacultyDatatable(){
            requiredFacultyDatatable = $('#requiredFacultyDatatable').DataTable({
                "ajax": {
                    url: BASE_API+'search/' + R_BIN_ID,
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "faculty.user.email", render: function(data, type, row){
                        return data
                    }},
                    { data: "faculty.first_name", render: function(data, type, row){
                        let html = ''
                        html += row.faculty.first_name + ' ' + row.faculty.last_name
                        return html
                    }},
                    { data: "status", render: function(data, row){
                        if(data == "Approved"){
                            return `<span class="badge badge-success">${data}</span>`
                        }
                        else if(data == "Declined"){
                            return `<span class="badge badge-danger">${data}</span>`
                        }
                        else if(data == "For Revision"){
                            return `<span class="badge badge-warning">${data}</span>`
                        }
                        else{
                            return data;
                        }

                    }},
                    { data: "id", render: function(data, type, row){
                        return `
                                    <button type="button" class="btn btn-sm btn-success btnViewDetails" id="${row.id}">
                                        <div>Check Uploaded Files</div>
                                    </button>&nbsp;
                                    <button type="button" class="btn btn-sm btn-danger btnRemoveRequired" id="${row.id}">
                                        Unrequire
                                    </button>
                                `
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1,] }],
                "order": [[1, "desc"]]
                });
        };

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API+'search/' + R_BIN_ID;

            requiredFacultyDatatable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        // LOAD REQUIREMENT TYPES
        function loadRequirementTypes(){
            $.ajax({
                url: BASE_API+'search/' + R_BIN_ID,
                type: "GET",
                dataType: "JSON",
                success: function (data) 
                {   
                    // console.log(data)
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                },
            });
        };
        

        $('#btnEditRequiredFaculty').on('click', function(){
            let form_url = APP_URL+'/api/v1/requirement_required_faculty_list/get_unrequired_faculty/'+R_BIN_ID

            $('#requiredFacultyDatatableModal').DataTable().destroy()
            requiredFacultyDatatableModal = $('#requiredFacultyDatatableModal').DataTable({
                "ajax": {
                    url: form_url,
                    dataSrc: ''
                },
                "async": true,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "user.email", render: function(data, type, row){
                        return data
                    }},
                    { data: "first_name", render: function(data, type, row){
                        let html = ''
                        html += row.first_name + ' ' + row.last_name
                        return html
                    }},
                    { data: "user_id", render: function(data, type, row){
                        let user_role = ''
                        
                        $.each(row.user.user_role, function(i){
                            if(i < (row.user.user_role.length) - 1){
                                user_role += row.user.user_role[i].role.title + ', '
                            }
                            else{
                                user_role += row.user.user_role[i].role.title
                            }
                        })
                        return user_role
                    }},
                    { data: "id", render: function(data, type, row){
                        return `<div class="custom-control custom-switch">
                                    <input type="checkbox" name="faculty_required[]" class="custom-control-input faculty_status" id="${row.id}" value="${row.id}" checked>
                                    <label id="status_label" class="custom-control-label" for="${row.id}">Yes</label>
                                </div>`
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]],
                "bPaginate": false,
            });

            $('#editRequiredFacultyModal').modal('show');
        })


        $(document).on("click", ".btnViewDetails", function(){
            var id = this.id
            
            $.ajax({
                url: BASE_API + id,
                type: "GET",
                dataType: "JSON",
                success: function (data){   
                    console.log(data)

                    let html = `<li class="list-group-item d-flex justify-content-between" disabled="">
                                                    <span class="text-primary"><strong>Submitted File/s</strong></span>
                                                    <span class="text-primary"><strong>Date Submitted</strong></span>
                                                </li>`

                    let header = `<h5 class="text-dark">Faculty: ${data.faculty.last_name}, ${data.faculty.first_name}</h5>`

                    // IF FACULTY DOES NOT HAVE ANY SUBMITTED REQUIREMENTS YET
                    if(data.submitted_requirements.length == 0){
                        html += `&nbsp;<div class="text-center">Empty Submission
                            </div>`
                    }

                    // PASSING SUBMITTED REQUIREMENTS DATA INTO HTML VAR TO PASS IT TO DOM
                    $.each(data.submitted_requirements, function(i){
                        let file_id = data.submitted_requirements[i].id
                        let file_link_directory = APP_URL + "/" + data.submitted_requirements[i].file_link_directory
                        let file_name = data.submitted_requirements[i].file_name
                        let date_submitted = data.submitted_requirements[i].date_submitted
                        let status = data.submitted_requirements[i].status

                        if(status == 'Submitted'){
                            html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    <button class="btn btn-info" onclick="window.open('${file_link_directory}')" target="_blank">${file_name}</button>
                                    
                                    <span class="badge badge-light">${moment(date_submitted).format('lll')} - ${status}</span>
                                    
                                    </li>`
                        }
                        else{
                            html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    <button class="btn btn-info" onclick="window.open('${file_link_directory}')" target="_blank">${file_name}</button>
                                    
                                    <span class="badge badge-light">${moment(date_submitted).format('lll')} - Uploaded</span>
                                    </li>`
                        }
                    })

                    // PASSING VAR DATA TO DOM
                    $('#sr_id').val(data.id)
                    $('#sr_status').val(data.status)
                    $('#sr_remarks').html(data.remarks)
                    $('#fileModalHeader').html(header)
                    $('#fileModalBody').html(html)
                    $('#fileViewerModal').modal('show')
                },
            });
        });

        $('#updateRequiredFacultyForm').on('submit', function(e){
            e.preventDefault()
            // Swal.fire({
            //     icon: 'warning',
            //     text: 'This feature is still under development'
            // })

            let required_faculty = $("input[name='faculty_required[]']:checked")
              .map(function(){
                return {
                "requirement_bin_id": R_BIN_ID,
                "faculty_id": $(this).val()
                }
            }).get();

            let form_url = BASE_API+"multi_insert"



            //  ajax opening tag
                    $.ajax({
                            url: form_url,
                            method: "POST",
                            data: JSON.stringify(required_faculty),
                            dataType: "JSON",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },
                            success: function(data){
                                // console.log(data)
                                notification('success', 'Required Faculty')
                                $('#editRequiredFacultyModal').modal('hide');
                                refresh()
                            },
                            error: function(error){
                                $.each(error.responseJSON.errors, function(key,value) {
                                    swalAlert('warning', value)
                                });
                                console.log(error)
                                console.log(`message: ${error.responseJSON.message}`)
                                console.log(`status: ${error.status}`)
                            }
                        // ajax closing tag
                    })
        })

        
        $('#btn_select_all').on('change', function(){

            let status = $('#btn_select_all').is(":checked")

            if(status == true){
                $('#select_all_label').html('Unselect all')
                $("input[name='faculty_required[]']").prop('checked', true)
            }
            else{
                $('#select_all_label').html('Select all')
                $("input[name='faculty_required[]']").prop('checked', false)
            }
        })


        // FUNCTION FOR UPDATING SUBMITTED REQUIREMENTS
        $('.btnSubmittedUpdate').on('click', function(e){
            
            let status = $('#sr_status').val()
            let remarks = $('#sr_remarks').val()
            let id = $('#sr_id').val()

            let form_url = BASE_API + id
            let form_data = {
                "status": status,
                "remarks": remarks
            }

            $.ajax({
                    url: form_url,
                    method: "PUT",
                    data: JSON.stringify(form_data),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        console.log(data)
                        notification('info', 'Submitted Requirement/s')
                        $('#fileViewerModal').modal('hide');
                        refresh()
                    },
                    error: function(error){
                        $.each(error.responseJSON.errors, function(key,value) {
                            swalAlert('warning', value)
                        });
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }
                // ajax closing tag
            })
        })

        // DEACTIVATE FUNCTION
        $(document).on("click", ".btnRemoveRequired", function(){
            var id = this.id;
            let form_url = BASE_API + id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't able to remove this.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        confirmButtonText: "Yes, remove it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: BASE_API + 'destroy/' + data.id,
                                method: "DELETE",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data){
                                    notification('error', 'Required User')
                                    setInterval(() => {
                                        location.reload()
                                    }, 1000);
                                },
                                error: function(error){
                                    $.each(error.responseJSON.errors, function(key,value) {
                                        swalAlert('warning', value)
                                    });
                                    console.log(error)
                                    console.log(`message: ${error.responseJSON.message}`)
                                    console.log(`status: ${error.status}`)
                                }
                            // ajax closing tag
                            })
                        }
                    });
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key,value) {
                        swalAlert('warning', value)
                    });
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF DEACTIVATE FUNCTION

        loadRequirementTypes();
        requiredFacultyDatatable();
    })
</script>