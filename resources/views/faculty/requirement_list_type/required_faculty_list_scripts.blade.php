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
                    { data: "deleted_at"},
                    { data: "id", render: function(data, type, row){
                        return `</div>
                                    <button type="button" class="btn btn-sm btn-success btnViewDetails" id="${row.id}">
                                    <div>Check Uploaded Files</div>
                                </button>`
                    }}
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]]
                });
        };

        // LOAD REQUIREMENT TYPES
        function loadRequirementTypes(){
            $.ajax({
                url: BASE_API+'search/' + R_BIN_ID,
                type: "GET",
                dataType: "JSON",
                success: function (data) 
                {   
                    console.log(data)
                },
                error: function ({ data }) {},
            });
        };
        

        $('#btnEditRequiredFaculty').on('click', function(){
            let form_url = APP_URL+'/api/v1/faculty/'

            $('#requiredFacultyDatatableModal').DataTable().destroy()
            requiredFacultyDatatable = $('#requiredFacultyDatatableModal').DataTable({
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
                    { data: "id", render: function(data, type, row){
                        return `<div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input faculty_status" id="${row.id}" checked>
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


        $(document).on("click", ".faculty_status", function(){
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        });

        $(document).on("click", ".btnViewDetails", function(){
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        });

        $('#updateRequiredFacultyForm').on('submit', function(e){
            e.preventDefault()
            Swal.fire({
                icon: 'warning',
                text: 'This feature is still under development'
            })
        })

        // loadRequirementTypes();
        // requiredFacultyDatatable();


    })
</script>