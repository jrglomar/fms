
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/requirement_bin/'
        var FACULTY_ID = JSON.parse(USER_DATA).faculty.id
        console.log(FACULTY_ID)
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))
        // END OF GLOBAL VARIABLE

        function updateRequirementBinStatus()
        {
            $.ajax({
                url: BASE_API+'get_required_requirement_bin/'+FACULTY_ID,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {   
                    $.each(responseData, function (i, dataOptions) 
                    {
                        var title = responseData[i].title;
                        var description = responseData[i].description
                        var status = responseData[i].status

                        var deadline = responseData[i].deadline
                        var deadline_hours = new Date(deadline).getHours();
                        var deadline_mins = new Date(deadline).getMinutes();
                        
                        if (deadline_hours < 10)
                        {
                            deadline_hours = "0"+deadline_hours
                        }
                        if (deadline_mins < 10)
                        {
                            deadline_mins = "0"+deadline_mins
                        }

                        var current_time = new Date(); // current time
                        var hours = current_time.getHours();
                        var mins = current_time.getMinutes();
                        if (hours < 10)
                        {
                            hours = "0"+hours
                        }
                        if (mins < 10)
                        {
                            mins = "0"+mins
                        }
        
                        var moment_current_date = moment(current_time).format('YYYY-MM-DD')
                        var moment_deadline = moment(deadline).format('YYYY-MM-DD');

                        var now = hours+":"+mins+":00";
                        var deadline_time = deadline_hours + ":" + deadline_mins + ":00"

                        console.log("Moment Current Date: " + moment_current_date)
                        console.log("Moment Start Date: " + moment_deadline)
                        console.log("Now: " + now)
                        console.log("Deadline in Time: " + deadline_time)

                        if(status == "On Going")
                        {
                            if(moment_current_date > moment_deadline)
                            {
                                let data_data = {
                                    "title": responseData[i].title,
                                    "description": responseData[i].description,
                                    "deadline": responseData[i].deadline,
                                    "status": "Done",
                                }
                                $.ajax({
                                    url: APP_URL+"/api/v1/requirement_bin/"+responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data_data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"      
                                    },
                                    success: function(data)
                                    {
                                        
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
                            if(moment_current_date == moment_deadline && now > deadline_time)
                            {                   
                                    
                                let data_data = {
                                    "title": responseData[i].title,
                                    "description": responseData[i].description,
                                    "deadline": responseData[i].deadline,
                                    "status": "Done",
                                }
                                $.ajax({
                                    url: APP_URL+"/api/v1/requirement_bin/"+responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data_data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
                                        
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
                        }
                    });
                }
            });
        }
        updateRequirementBinStatus()

        // DATA TABLES FUNCTION
        function dataTable(){
                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API+'get_required_requirement_bin/'+FACULTY_ID, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "title"},
                    { data: "requirement_list_type", render: function(data, type, row){
                        let requirement_list_type = ''

                        $.each(data, function(i){
                            if(i < (data.length) - 1){
                                requirement_list_type += data[i].requirement_type.title + ', '
                            }
                            else{
                                requirement_list_type += data[i].requirement_type.title
                            }
                        })

                        return requirement_list_type;
                    }},
                    { data: "status", render: function(data, type, row){
                        let status_html
                        if(data == 'Done'){
                            status_html = `<span class="badge badge-success">${data}</span>`
                        }
                        else if(data == 'Ongoing' || data == 'On Going'){
                            status_html = `<span class="badge badge-info">${data}</span>`
                        }
                        else if(data == 'Cancelled'){
                            status_html = `<span class="badge badge-danger">${data}</span>`
                        }
                        else if(data == 'Pending'){
                            status_html = `<span class="badge badge-secondary">${data}</span>`
                        }
                        else{
                            status_html = data
                        }
                        return status_html
                        // if(data == 'Approved'){
                        //     return `<span class="badge badge-success">${data}</span>`
                        // }
                        // else if(data == 'Declined'){
                        //     return `<span class="badge badge-danger">${data}</span>`
                        // }
                        // else if(data == 'For Revision'){
                        //     return `<span class="badge badge-warning">${data}</span>`
                        // }
                    }},
                    { data: "deadline", render: function(data, type, row){
                        return `<span class="badge badge-info">${moment(data).format('LLL')}</span>`
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                        console.log(row);
                                if (data == null){
                                    return `<div class="text-center dropdown">
                                                <div class="btn btn-sm btn-default" data-toggle="dropdown" role="button">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <div class="dropdown-item d-flex btnView" id="${row.requirement_bin_id}" data-value="${row.rrf_list_id}" role="button">
                                                        <div style="width: 2rem">
                                                            <i class="fas fa-eye"></i>
                                                        </div>
                                                        <div> View</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 3] }],
                "order": [[1, "desc"]]
                })
        }
        // END OF DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION


        // SUBMIT FUNCTION
        $('#createForm').on('submit', function(e){
            e.preventDefault();

            var form_url = BASE_API
            var form = $("#createForm").serializeArray();
            let data = {}

            $.each(form, function(){
                data[[this.name]] = this.value;
            })


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
                    notification('success', 'Requirement Bin')
                    $("#createForm").trigger("reset")
                    $("#create_card").collapse("hide")
                    refresh();
                },
                error: function(error){
                    console.log(error)
                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
                    console.log(`message: ${error.responseJSON.message}`)
                    console.log(`status: ${error.status}`)
                }
            // ajax closing tag
            })
        });
        // END OF SUBMIT FUNCTION

        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var requirement_bin_id = this.id;
            var rr_faculty_list_id = $(this).attr('data-value')
            console.log(requirement_bin_id)
            console.log(rr_faculty_list_id)
            // let form_url =APP_URL+'/api/v1/requirement_bin/'+requirement_bin_id

            window.location.replace(APP_URL + '/faculty/requirement_list_type/'+requirement_bin_id+'/'+rr_faculty_list_id);

            // $.ajax({
            //     url: form_url,
            //     method: "GET",
            //     headers: {
            //         "Accept": "application/json",
            //         "Authorization": API_TOKEN,
            //         "Content-Type": "application/json"
            //     },

            //     success: function(data){
            //         let created_at = moment(data.created_at).format('LLL');
            //         let status = (data.deleted_at === null) ? 'Active' : 'Inactive';

            //         $('#id_view').html(data.id);
            //         $('#title_view').html(data.title);
            //         $('#description_view').html(data.description);
            //         $('#deadline_view').html(data.deadline);
            //         $('#created_at_view').html(created_at);

            //         $('#viewModal').modal('show');
            //     }
            // // ajax closing tag
            // })
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
                    $('#description_edit').val(data.description);
                    $('#deadline_edit').val(data.deadline);

                    $('#editModal').modal('show');
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
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
                "description": $('#description_edit').val(),
                "deadline": $('#deadline_edit').val()
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
                    notification('info', 'Requirement Bin')
                    refresh()
                    $('#editModal').modal('hide');
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
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
                    $('#description_delete').html(data.description);
                    $('#deadline_delete').html(data.deadline);

                    $('#deactivateModal').modal('show');
                },
                error: function(error){
                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
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
                    notification('error', 'Requirement Bin')
                    refresh()
                    $('#deactivateModal').modal('hide');
                },
                error: function(error){
                    console.log(error)
                    $.each(error.responseJSON.errors, function(key, value){
                            swalAlert('warning', value)
                    })
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
