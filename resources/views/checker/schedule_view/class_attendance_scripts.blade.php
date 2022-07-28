<script>
    $(document).ready(function(){
        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/class_attendance/'
        var SCHEDULE_ID = "{{ $schedule_id }}"
        var CLASS_SCHEDULE_ID
        var CLASS_SCHEDULE_DATA
        var NEW_USER_DATA = JSON.parse(USER_DATA)
        var USER_ID = NEW_USER_DATA.id
        var FACULTY_ID = NEW_USER_DATA.faculty.id
        // END OF GLOBAL VARIABLE

        // DATA TABLES FUNCTION
        function dataTable(){
                $('#dataTable tfoot th').each( function (i) {
                    var title = $('#dataTable thead th').eq( $(this).index() ).text();
                    $(this).html( '<input size="15" class="form-control" type="text" placeholder="'+title+'" data-index="'+i+'" />');
                });
                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API + 'show_specific_class/' + SCHEDULE_ID, 
                    dataSrc: ""
                },
                "paging": true,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "date_of_class", render: function(data, type, row){
                        return `${moment(data).format('ll')}, ${moment(data + ' ' + row.start_time).format('LT')}-${moment(data + ' ' + row.end_time).format('LT')}`
                    }},
                    { data: "proof_of_attendance_file", render:function(data, type, row){
                        return `<button class="btn btn-info btn-sm" 
                                    onclick="window.open('${APP_URL+ '/' + row.proof_of_attendance_file}')" 
                                    target="_blank">${row.proof_of_attendance_file_name}
                                </button>`
                    }},
                    { data: "checked_by", render: function(data, type,row){
                        if(data == null || data.length == 0){
                            return ''
                        }
                        else{
                            return data.first_name + ' ' + data.last_name 
                        }
                    }},
                    { data: "status", render: function(data, type, row){
                        let status_html
                        if(data == 'Approved'){
                            status_html = `<span class="badge badge-success">${data}</span>`
                        }
                        else if(data == 'For Revision'){
                            status_html = `<span class="badge badge-info">${data}</span>`
                        }
                        else if(data == 'Declined'){
                            status_html = `<span class="badge badge-danger">${data}</span>`
                        }
                        else if(data == 'Submitted'){
                            status_html = `<span class="badge badge-secondary">${data}</span>`
                        }
                        else{
                            status_html = data
                        }
                        return status_html
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `</div>
                                                <button type="button" class="btn btn-sm btn-success btnEditProofOfAttendance" id="${row.id}">
                                                <div><i class="fas fa-edit"></i> Check Attendance</div>
                                            </button>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
                "order": [[1, "desc"]]
                })

                // Filter event handler
                $(dataTable.table().container() ).on( 'keyup', 'tfoot input', function () {
                    dataTable
                        .column( $(this).data('index') )
                        .search( this.value )
                        .draw();
                });
        }
        // END OF DATATABLE FUNCTION

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API;

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        $("#btnProofOfAttendance").on('click', function(){
            $('#proofOfAttendanceModal').modal('show')
        })
            

        $(document).on("click", ".btnViewProofOfAttendance", function(){
            let id = this.id

            $.ajax({
                url: BASE_API + id,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    console.log(data)

                    $('#view_date_of_class').html(moment(data.date_of_class).format("ll"))
                    $('#view_start_time').html(moment(data.date_of_class + ' ' + data.start_time).format("LT"))
                    $('#view_end_time').html(moment(data.date_of_class + ' ' + data.end_time).format("LT"))
                    $('#view_proof_of_attendance').html(`<button class="btn btn-info" onclick="window.open('${APP_URL+ '/' + data.proof_of_attendance_file}')" target="_blank">${data.proof_of_attendance_file_name}</button>`)

                    $('#viewProofOfAttendanceModal').modal('show')
                }
            })
        });
        
        // DELETE FUNCTION
        $(document).on("click", ".btnDeactivateProofOfAttendance", function(){
            var id = this.id;
            let form_url = BASE_API + id
            console.log(id)
            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    console.log(data)
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
                                    notification('error', 'Class Attendance')
                                    refresh();
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
        // END DELETE FUNCTION
        

        $('#btnUpdateAttendanceStatus').on('click', function(e){
            e.preventDefault()

            let class_attendance_id = $('#class_attendance_id_e').val()
                var form_url = BASE_API + class_attendance_id
                let submission_data = {
                    "status": $('#status_e').val(),
                    "remarks": $('#remarks_e').val(),
                    "checked_by": FACULTY_ID
                }

                if(submission_data.status == ""){
                    swalAlert('warning', 'Status is required')
                }
                else{
                    $.ajax({
                        url: form_url,
                        method: "PUT",
                        data: JSON.stringify(submission_data),
                        dataType: "JSON",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },
                        success: function(data){
                            notification('info', 'Class Attendance')
                            $("#editProofOfAttendanceForm").trigger("reset")
                            $("#editProofOfAttendanceModal").modal("hide")
                            setInterval(() => {
                                location.reload()
                            }, 1500);
                        },
                        error: function(error){
                            $.each(error.responseJSON.errors, function(key,value) {
                                swalAlert('warning', value)
                            });
                            console.log(error)
                            console.log(`message: ${error.responseJSON.message}`)
                            console.log(`status: ${error.status}`)
                        }
                    })
                }

                console.log(submission_data)
                
        })
    })
</script>