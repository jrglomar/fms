
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/meeting/'
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))

        var USERDATA = JSON.parse(USER_DATA)
        var FACULTY_ID = USERDATA.faculty.id

        console.log(FACULTY_ID)
        // END OF GLOBAL VARIABLE

        // DATA TABLES FUNCTION
        function dataTable(){
            dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API+"get_specific_meeting_of_faculty/"+FACULTY_ID, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "title"},
                    { data: "meeting_type.title"},
                    { data: "agenda"},
                    { data: "location"},
                    { data: "start_time", render: function(data, type, row){
                        console.log("0000-00-00 "+data)
                        console.log(row.date)
                        return `<span class="badge badge-info">${moment(row.date).format('LL')}, 
                            ${moment("2022-06-27 "+data).format('LT')} - ${moment("2022-06-27 "+row.end_time).format('LT')
                            }</span>`
                    }}, // merge date (to be add), start_time, end_time
                    { data: "is_required", render: function (data, type, row) { // required
                        console.log(data)
                        if(data == true)
                        {
                            return `<p>Yes</p>`
                        }
                        else
                        {
                            return `<p>No</p>`
                        }
                        }
                    },
                    { data: "status"},
                    { data: "deleted_at", render: function(data, type, row){  
                        console.log(row);
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item d-flex btnView" id="${row.id}" data-value="${row.f_id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                        <div>View</div></div>`
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                    "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 3, 4, 5, 7, 8] }],
                "order": [[1, "desc"]]
                })
        }
        // END OF DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API;

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        // LOAD MEETING TYPES
        function loadMeetingTypes(){
            $.ajax({
                url: APP_URL+'/api/v1/meeting_type/',
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    $.each(responseData, function (i, dataOptions) 
                    {
                        var options = "";

                        options =
                            "<option value='" +
                            dataOptions.id +
                            "'>" +
                            dataOptions.title +
                            "</option>";

                        $("#meeting_types_id").append(options);
                        $("#meeting_types_id_edit").append(options);
                    });
                    
                },
                error: function ({ responseJSON }) {},
            });
        };

        loadMeetingTypes();
        // END LOAD MEETING TYPES

        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var form_url = BASE_API;
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })
            console.log(JSON.stringify(data))

            var startTime = $('#start_time').val();
            var endTime = $('#end_time').val();

            console.log(startTime);
            console.log(endTime);

            if(endTime < startTime)
            {
                alert("The meeting End Time is Less than to your Start Time. Please pick time properly")
            }
            else
            {
                // ajax opening tag
                $.ajax({
                    url: form_url,
                    method: "POST",
                    data: JSON.stringify(data),
                    dataType: "JSON",
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        "Content-Type": "application/json"
                    },
                    success: function(data){
                        console.log(data)
                        $("#createForm").trigger("reset")
                        $("#create_card").collapse("hide")
                        refresh();
                    },
                    error: function(error){
                        console.log(error)
                        console.log(`message: ${error.responseJSON.message}`)
                        console.log(`status: ${error.status}`)
                    }
                // ajax closing tag
                })
            }
        });
        // END OF SUBMIT FUNCTION

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var meeting_id = this.id;
            var marf_list_id = $(this).attr('data-value')
            console.log(marf_list_id)
            console.log(meeting_id)
            window.location.replace(APP_URL + '/faculty/meeting/'+meeting_id);
        });
        // END OF VIEW FUNCTION

        // EDIT FUNCTION
        $(document).on("click", ".btnEdit", function(){
            var id = this.id;
            let form_url = BASE_API+id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data){
                    $('#id_edit').val(data.id);
                    $('#title_edit').val(data.title);
                    $('#meeting_types_id_edit').val(data.meeting_types_id);
                    $('#agenda_edit').val(data.agenda);
                    $('#location_edit').val(data.location);
                    $('#description_edit').val(data.description);
                    $('#date_edit').val(data.date);
                    $('#start_time_edit').val(data.start_time);
                    $('#end_time_edit').val(data.end_time);
                    $('#is_required_edit').val(data.is_required);
                    $('#status_edit').val(data.status);
                    $('#editModal').modal('show');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF EDIT FUNCTION

        // UPDATE FUNCTION
        $('#updateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_edit').val();
            var form_url = BASE_API+id

            let data = {
                "title": $('#title_edit').val(),
                "meeting_types_id": $('#meeting_types_id_edit').val(),
                "description": $('#description_edit').val(),
                "agenda": $('#agenda_edit').val(),
                "location": $('#location_edit').val(),
                "date": $('#date_edit').val(),
                "start_time": $('#start_time_edit').val(),
                "end_time": $('#end_time_edit').val(),
                "is_required": $('#is_required_edit').val(),
                "status": $('#status_edit').val(),
            }

            $.ajax({
                url: form_url,
                method: "PUT",
                data: JSON.stringify(data),
                dataType: "JSON",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    refresh()
                    $('#editModal').modal('hide');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })


        });
        // END OF UPDATE FUNCTION

        // DEACTIVATE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
            var id = this.id;
            let form_url = BASE_API+id

            $.ajax({
                url: form_url,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    $('#id_delete').val(data.id);
                    $('#title_delete').html(data.title);
                    $('#meeting_type_delete').html(data.meeting_types_id);
                    $('#agenda_delete').html(data.agenda);
                    $('#location_delete').html(data.location);
                    $('#description_delete').html(data.description);
                    $('#date_delete').html(data.date);
                    $('#start_time_delete').html(data.start_time);
                    $('#end_time_delete').html(data.end_time);
                    $('#is_required_delete').html(data.is_required);
                    $('#status_delete').html(data.status);

                    $('#deactivateModal').modal('show');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF DEACTIVATE FUNCTION

        // DEACTIVATE SUBMIT FUNCTION
        $('#deactivateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_delete').val();
            var form_url = BASE_API+'destroy/'+id

            $.ajax({
                url: form_url,
                method: "DELETE",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },

                success: function(data){
                    refresh()
                    $('#deactivateModal').modal('hide');
                },
                error: function(error){
                    console.log(error)
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF DEACTIVATE SUBMIT FUNCTION

        // ACTIVATE FUNCTION
        $(document).on("click", ".btnActivate", function(){
            var id = this.id;
            console.log(id)
        });
        // END OF ACTIVATE FUNCTION

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
