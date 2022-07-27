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
        var FACULTY_ID = NEW_USER_DATA.faculty.id
        // END OF GLOBAL VARIABLE


        // DATA TABLES FUNCTION
        function dataTable(){
                $('#dataTable tfoot th').each( function (i) {
                    var title = $('#dataTable thead th').eq( $(this).index() ).text();
                    $(this).html( '<input size="15" class="form-control" type="text" placeholder="'+title+'" data-index="'+i+'" />');
                } );

                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API, 
                    dataSrc: ""
                },
                "paging": true,
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "date_of_class"},
                    { data: "class_schedule_id"},
                    { data: "faculty_id"},
                    { data: "status"},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `
                                            <button class="btn btn-info btnView" id="${row.id}"><i class="fas fa-eye"></i></button>`;
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

        // CALLING DATATABLE FUNCTION
        // dataTable()

        $("#btnProofOfAttendance").on('click', function(){
           
            $('#proofOfAttendanceModal').modal('show')
            
        })

        $('.btnSubmitProofOfAttendance').on('click', function(e){
            e.preventDefault()

            var form_url = BASE_API
            var form = $("#proofOfAttendanceForm").serializeArray();
            let data = {
                start_time: $('#start_time_input_a').val(),
                end_time: $('#end_time_input_a').val(),
                date_of_class: $('#date_of_class_a').val(),
                class_schedule_id: $('#class_schedule_id_a').val(),
                faculty_id: FACULTY_ID
            }

            // $.each(form, function(){
            //     data[[this.name]] = this.value;
            // })

            console.log(data)
            // $.ajax({
            //         url: form_url,
            //         method: "POST",
            //         data: JSON.stringify(data),
            //         dataType: "JSON",
            //         headers: {
            //             "Accept": "application/json",
            //             "Authorization": API_TOKEN,
            //             "Content-Type": "application/json"
            //         },
            //         success: function(data){
            //             notification('success', 'Observation Schedule')
            //             $("#setObservationForm").trigger("reset")
            //             $("#observationModal").modal("hide")
                        
            //             setInterval(() => {
            //                 window.location.href = APP_URL+'/acad_head/class_observation';
            //             }, 1500);
            //         },
            //         error: function(error){
            //             $.each(error.responseJSON.errors, function(key,value) {
            //                 swalAlert('warning', value)
            //             });
            //             console.log(error)
            //             console.log(`message: ${error.responseJSON.message}`)
            //             console.log(`status: ${error.status}`)
            //         }
            //     // ajax closing tag
            // })

        })
    })
</script>