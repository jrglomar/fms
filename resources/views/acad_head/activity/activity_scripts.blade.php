
<script>
    $(document).ready(function(){
        // Initialize the Summernote WYSIWYG TEXT AREA
        document.getElementById("agenda_div").hidden = true
        $('#agenda').summernote({
            placeholder: 'Agenda...',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ]
        });
        // Initialize the Summernote WYSIWYG TEXT AREA
        $('#description').summernote({
            placeholder: 'Description...',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ]
        });
        // Initialize the Summernote WYSIWYG TEXT AREA
        $('#description_edit').summernote({
            placeholder: 'Description...',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ]
        });
        // Initialize the Summernote WYSIWYG TEXT AREA
        $('#agenda_edit').summernote({
            placeholder: 'Agenda...',
            tabsize: 2,
            height: 100,
            toolbar: [
                // [groupName, [list of button]]
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ]
        });
        // END Initialize the Summernote WYSIWYG TEXT AREA

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var BASE_API = APP_URL + '/api/v1/activity/'
        // END OF GLOBAL VARIABLE

        // FUNCTION TO UPDATE MEETING STATUS UPON VIEWING
        function updateActivityStatus()
        {
            $.ajax({
                url: BASE_API,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {  
                    $.each(responseData, function (i, dataOptions) 
                    {
                        var status = responseData[i].status

                        var start_date_hours = new Date(responseData[i].start_datetime).getHours();
                        var start_date_mins = new Date(responseData[i].start_datetime).getMinutes();
                        if (start_date_hours < 10)
                        {
                            start_date_hours = "0"+start_date_hours
                        }
                        if (start_date_mins < 10)
                        {
                            start_date_mins = "0"+start_date_mins
                        }

                        var end_date_hours = new Date(responseData[i].end_datetime).getHours();
                        var end_date_mins = new Date(responseData[i].end_datetime).getMinutes();
                        if (end_date_hours < 10)
                        {
                            end_date_hours = "0"+end_date_hours
                        }
                        if (end_date_mins < 10)
                        {
                            end_date_mins = "0"+end_date_mins
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
            
                        var moment_current_date = moment(current_time).format('L')
                        var moment_start_date = moment(responseData[i].start_datetime).format('L');
                        var moment_end_date = moment(responseData[i].end_datetime).format('L');


                        var now = hours+":"+mins+":00";
                        var start_time = start_date_hours + ":" + start_date_mins + ":00"
                        var end_time = end_date_hours + ":" + end_date_mins + ":00"

                        if(status == "Pending")
                        {
                            if((moment_current_date >= moment_start_date && moment_current_date <= moment_end_date)) 
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "On Going",
                                    
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else if(moment_current_date > moment_end_date)
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "Done",
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else if(moment_current_date < moment_start_date)
                            {
                                refresh()
                            }
                            else if((moment_current_date == moment_end_date) && (now > end_time))
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "Done",
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else if(moment_current_date == moment_start_date && now < start_time && now < end_time)
                            {
                                refresh()
                            }
                        }
                        else if(status == "On Going")
                        {                
                            if(moment_current_date > moment_end_date)
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "Done",
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else if(moment_current_date == moment_end_date && now > end_time)
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "Done",
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else if(moment_current_date < moment_start_date && moment_current_date < moment_end_date)
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "Pending",
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else if(moment_current_date == moment_start_date && now < start_time)
                            {
                                let data = {
                                    "title": responseData[i].title,
                                    "activity_type_id": responseData[i].activity_type_id,
                                    "description": responseData[i].description,
                                    "agenda": responseData[i].agenda,
                                    "location": responseData[i].location,
                                    "start_datetime": responseData[i].start_datetime,
                                    "end_datetime": responseData[i].end_datetime,
                                    "is_required": responseData[i].is_required,
                                    "memorandum_file_directory": responseData[i].memorandum_file_directory,
                                    "status": "Pending",
                                }
                                $.ajax({
                                    url: BASE_API + responseData[i].id,
                                    method: "PUT",
                                    data: JSON.stringify(data),
                                    dataType: "JSON",
                                    headers: {
                                        "Accept": "application/json",
                                        "Authorization": API_TOKEN,
                                        "Content-Type": "application/json"
                                    },
                                    success: function(data)
                                    {
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
                            }
                            else
                            {
                                refresh()
                            }
                        }
                    });
                },
            });
        }
        updateActivityStatus()

        // DATA TABLES FUNCTION
        function dataTable(){
                date = moment(new Date()).format() 
                console.log(date)

                dataTable = $('#dataTable').DataTable({
                "ajax": {
                    url: BASE_API, 
                    dataSrc: ''
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at"},
                    { data: "title"},
                    { data: "activity_type.title"},
                    { data: "description"},
                    { data: "status"},
                    { data: "start_datetime", render: function(data, type, row){
                        return `<span class="badge badge-info">${moment(data).format('LLL')} - ${moment(row.end_datetime).format('LLL')}</span>` 
                    }},
                    { data: "deleted_at", render: function(data, type, row){
                                if (data == null){
                                    return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                                        <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                                        <div>View</div></div>
                                        <div class="dropdown-item d-flex btnEdit" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-edit"></i></div>
                                            <div>Edit</div></div>
                                            <div class="dropdown-divider"</div></div>
                                            <div class="dropdown-item d-flex btnDeactivate" id="${row.id}" role="button">
                                            <div style="width: 2rem"><i class="fas fa-trash-alt"></i></div>
                                            <div style="color: red">Delete</div></div></div></div>`;
                                }
                                else{
                                    return '<button class="btn btn-danger btn-sm">Activate</button>';
                                }
                            }
                        }
                    ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 4] }],
                "order": [[1, "desc"]]
                })
        }
        // END OF DATATABLE FUNCTION

        // CALLING DATATABLE FUNCTION
        dataTable()

        // ACTIVITY TYPE FUNCTION
        function activity_type(){

            activity_type_url = APP_URL+'/api/v1/activity_type/'
    
            $.ajax({
            url: activity_type_url,
            type: "GET",
            dataType: "JSON",

            success: function(data){

                var html = ""

                for(var i=0; i < data.length; i++){
                html += `<option value="${data[i].id}">${data[i].title}</option>`
                }
                
                $('#activity_type_id').append(html);
                $('#activity_type_id_edit').append(html);
                //$('#busTypeEdit').html(html);

            }
            })
        }
        // END OF ACTIVITY TYPE FUNCTION

        // CALLING ACTIVITY TYPE FUNCTION
        activity_type()
        
        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION


        $("#memo_upload").dropzone({ 
            url: BASE_API +'upload',
            acceptedFiles: 'image/*, .pdf',
            maxFiles: 1,
            addRemoveLinks: true,
            autoProcessQueue: false,
            // renameFile: function (file) {
            //     let file_name = file.name.substr(0, file.name.lastIndexOf('.')) || file.name;
            //     file_name = file_name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');

            //     ext = file.name.substring(file.name.lastIndexOf('.') + 1).toLowerCase();

            //     return file_name + '_' + FACULTY_LAST_NAME + '_' + new Date().getTime() + '.' + ext;
            // },
            init: function () {

                var myDropzone = this;

                // Update selector to match your button

                $('#createForm').on('submit', function(e){

                    e.preventDefault()

                   // myDropzone.processQueue();

                    if (myDropzone.getQueuedFiles().length === 0){

                    form_url_no_memo = BASE_API

                    let data_form = {
                        "title": $('#title').val(),
                        "description": $('#description').val(),
                        "agenda": $('#agenda').val(),
                        "location": $('#location').val(),
                        "start_datetime": $('#start_datetime').val(),
                        "end_datetime": $('#end_datetime').val(),
                        "activity_type_id": $('#activity_type_id').val(),
                        "status": "Pending",
                        "is_required": 1,
                        "memorandum_file_directory": "NA"
                    }

                    console.log(data_form)
                    
                        if($('#start_datetime').val() > "{{ date('Y-m-d 00:00:00'); }}" && $('#end_datetime').val() > "{{ date('Y-m-d 00:01:00'); }}" &&
                        $('#start_datetime').val() < $('#end_datetime').val()){
                            //ajax opening tag
                            $.ajax({
                                url: form_url_no_memo,
                                method: "POST",
                                data: JSON.stringify(data_form),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data){
                                    updateActivityStatus();
                                    $("#createForm").trigger("reset")
                                    $("#create_card").collapse("hide")
                                    $('#agenda').summernote('reset');
                                    $('#description').summernote('reset');
                                    $('#activity_type_id').val('').trigger("change")
                                    Dropzone.forElement('#memo_upload').removeAllFiles(true)
                                    notification("success", "Activity")

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
                            //ajax closing tag
                            })
                        }
                        else{
                            swalAlert('warning', 'Invalid datetime')
                        }
                    }
                    else{
                        //console.log(myDropzone)
                        myDropzone.processQueue();
                    }
                })
                
            },

            success: function(response, data){
            
                //console.log(data)
                form_url = BASE_API

                var form = $("#createForm").serializeArray();
                let formdata = {}

                formdata['memorandum_file_directory'] = data.path
                formdata['is_required'] = 1
                formdata['status'] = "Pending"

                $.each(form, function(){
                    formdata[[this.name]] = this.value;
                })

                console.log(formdata)

                if($('#start_datetime').val() > "{{ date('Y-m-d 00:00:00'); }}" && $('#end_datetime').val() > "{{ date('Y-m-d 00:01:00'); }}" ){
                    //ajax opening tag
                    $.ajax({
                        url: form_url,
                        method: "POST",
                        data: JSON.stringify(formdata),
                        dataType: "JSON",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },
                        success: function(data){
                            console.log(data)
                            updateActivityStatus();
                            $("#createForm").trigger("reset")
                            $("#create_card").collapse("hide")
                            $('#agenda').summernote('reset');
                            $('#description').summernote('reset');
                            $('#activity_type_id').val('').trigger("change")
                            Dropzone.forElement('#memo_upload').removeAllFiles(true)
                            refresh();

                            notification("success", "Activity")
                        },
                        error: function(error){
                            $.each(error.responseJSON.errors, function(key,value) {
                                swalAlert('warning', value)
                            });
                            console.log(error)
                            console.log(`message: ${error.responseJSON.message}`)
                            console.log(`status: ${error.status}`)
                        }
                    //ajax closing tag
                    })
                }
                else{
                    swalAlert('warning', 'Invalid datetime')
                }

            },
        });


        // VIEW FUNCTION
        $(document).on("click", ".btnView", function(){
            var activity_id = this.id;

            // FUNCTION TO UPDATE MEETING STATUS UPON VIEWING
            $.ajax({
                url: BASE_API + activity_id,
                type: "GET",
                dataType: "JSON",
                success: function (responseData) 
                {  
                    var status = responseData.status

                    var start_date_hours = new Date(responseData.start_datetime).getHours();
                    var start_date_mins = new Date(responseData.start_datetime).getMinutes();
                    if (start_date_hours < 10)
                    {
                        start_date_hours = "0"+start_date_hours
                    }
                    if (start_date_mins < 10)
                    {
                        start_date_mins = "0"+start_date_mins
                    }

                    var end_date_hours = new Date(responseData.end_datetime).getHours();
                    var end_date_mins = new Date(responseData.end_datetime).getMinutes();
                    if (end_date_hours < 10)
                    {
                        end_date_hours = "0"+end_date_hours
                    }
                    if (end_date_mins < 10)
                    {
                        end_date_mins = "0"+end_date_mins
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
      
                    var moment_current_date = moment(current_time).format('L')
                    var moment_start_date = moment(responseData.start_datetime).format('L');
                    var moment_end_date = moment(responseData.end_datetime).format('L');


                    var now = hours+":"+mins+":00";
                    var start_time = start_date_hours + ":" + start_date_mins + ":00"
                    var end_time = end_date_hours + ":" + end_date_mins + ":00"

                    console.log("Moment Current Date: " + moment_current_date)
                    console.log("Moment Start Date: " + moment_start_date)
                    console.log("Moment End Date: " + moment_end_date)
                    console.log("Now: " + now)
                    console.log("Start Time: " + start_time)
                    console.log("End Time: " + end_time)

                    if(status == "Pending")
                    {
                        if((moment_current_date >= moment_start_date && moment_current_date <= moment_end_date)) 
                        {
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "On Going",
                                
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
                                method: "PUT",
                                data: JSON.stringify(data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data)
                                {
                                    setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
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
                        else if(moment_current_date > moment_end_date)
                        {
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
                                method: "PUT",
                                data: JSON.stringify(data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data)
                                {
                                    setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
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
                        else if(moment_current_date < moment_start_date)
                        {
                            setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
                        }
                        else if((moment_current_date == moment_end_date) && (now > end_time))
                        {
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
                                method: "PUT",
                                data: JSON.stringify(data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data)
                                {
                                    setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
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
                        else if(moment_current_date == moment_start_date && now < start_time && now < end_time)
                        {
                            setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
                        }
                    }
                    else if(status == "On Going")
                    {                
                        if(moment_current_date > moment_end_date)
                        {
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
                                method: "PUT",
                                data: JSON.stringify(data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data)
                                {
                                    setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
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
                        else if(moment_current_date == moment_end_date && now > end_time)
                        {
                            let data = {
                                "title": responseData.title,
                                "activity_type_id": responseData.activity_type_id,
                                "description": responseData.description,
                                "agenda": responseData.agenda,
                                "location": responseData.location,
                                "start_datetime": responseData.start_datetime,
                                "end_datetime": responseData.end_datetime,
                                "is_required": responseData.is_required,
                                "memorandum_file_directory": responseData.memorandum_file_directory,
                                "status": "Done",
                            }
                            $.ajax({
                                url: BASE_API + activity_id,
                                method: "PUT",
                                data: JSON.stringify(data),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },
                                success: function(data)
                                {
                                    setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
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
                        else
                        {
                            setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
                        }
                    }
                    else if(status == "Done" || status == "done")
                    {    
                        $.ajax({
                            url: APP_URL + "/api/v1/activity_attendance/faculty_list_time_out_null/" + activity_id,
                            type: "GET",
                            dataType: "JSON",
                            success: function (responseData) 
                            {  
                                if (responseData.length != 0)
                                {
                                    $.each(responseData, function (i, dataOptions) 
                                    {
                                        var time_in = responseData[i].time_in
                                        var time_out = responseData[i].time_out
                                        var attendance_status = responseData[i].attendance_status
                                        var remarks = responseData[i].remarks
                                        var status = responseData[i].status
                                        var proof_of_attendance_file_link = responseData[i].proof_of_attendance_file_link
                                        var faculty_id = responseData[i].faculty_id
                                        var activity_id = responseData[i].activity_id
                                        var id = responseData[i].id

                                        $.ajax(
                                        {
                                            url: APP_URL + '/api/v1/activity_attendance/' + id,
                                            type: "PUT",
                                            data: JSON.stringify(
                                            {		
                                                "time_in": time_in,
                                                "time_out": time_out,
                                                "attendance_status": "Absent",
                                                "remarks": remarks,
                                                "status": status,
                                                "proof_of_attendance_file_link": proof_of_attendance_file_link,
                                                "faculty_id": faculty_id,
                                                "activity_id": activity_id,
                                            }),
                                            dataType: "JSON",
                                            contentType: 'application/json',
                                            processData: false,
                                            cache: false,
                                            success: function (responseJSON) 
                                            {     
                                                setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)                     
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
                                    });
                                }
                                else
                                {
                                    setInterval(window.location.replace(APP_URL+"/acad_head/activity/"+activity_id), 1500)
                                }
                            }
                        });
                    }
                },
            // window.location.replace(APP_URL+"/acad_head/activity/"+id);
            });
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
                    console.log(data)
                    if (data.activity_type.category == "Meeting")
                    {
                        console.log("This is Meeting")
                        document.getElementById("agenda_edit_div").hidden = false;     // Show

                    }    
                    else if (data.activity_type.category == "Activity")
                    {
                        console.log("This is Activity")
                        document.getElementById("agenda_edit_div").hidden = true;   // Hide
                    } 

                    var memo_html = "";

                    if(data.memorandum_file_directory == null || data.memorandum_file_directory == "NA")
                    {
                        memo_html = `<input type="file" accept=".jpg, .png, .jpeg, .pdf" class="form-control" id="memorandum_file_directory_edit" name="memorandum_file_directory_edit"
                                tabindex="1">`;
                    }
                    else
                    {
                        let memorandum_file_directory = APP_URL + "/" + data.memorandum_file_directory

                        memo_html +=    `<button type="button" class="btn btn-info"  
                                        onclick="window.open('${memorandum_file_directory}')" target="_blank">Check Memo</button> 
                                        &nbsp;<a href="javascript:removeMemo()" id="${data.id}">Remove Memo</a>
                                        <br><br><label> Update Memo / Upload New Memo: </label>
                                        <input type="file" accept=".jpg, .png, .jpeg, .pdf" class="form-control" id="memorandum_file_directory_edit" name="memorandum_file_directory_edit"
                                        tabindex="1">`;
                    }

                    $('#memo_edit_modal').html(memo_html);
                    
                    $('#id_edit').val(data.id);
                    $('#title_edit').val(data.title);
                    $('#description_edit').summernote('code', data.description)
                    $('#agenda_edit').summernote('code', data.agenda)
                    // $('#description_edit').val(data.description);
                    // $('#agenda_edit').val(data.agenda);
                    $('#activity_type_id_edit').val(data.activity_type.id);
                    $('#location_edit').val(data.location);
                    $('#start_datetime_edit').val(data.start_datetime);
                    $('#end_datetime_edit').val(data.end_datetime);
                    $('#memorandum_path').val(data.memorandum_file_directory);
                    //console.log(data.is_required)

                    $('#editModal').modal('show');
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
        // END OF EDIT FUNCTION

        // UPDATE FUNCTION
        $('#updateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_edit').val();
            var form_url = BASE_API+id

            var memo_path = $('#memorandum_path').val()

            var new_memo_path = ""

            if($('#memorandum_file_directory_edit')[0].files[0] == null){
                new_memo_path = $('#memorandum_path').val()

                var id = $('#id_edit').val();

                var form_url = BASE_API+id

                let data_form = {
                    "title": $('#title_edit').val(),
                    "description": $('#description_edit').val(),
                    "agenda": $('#agenda_edit').val(),
                    "location": $('#location_edit').val(),
                    "activity_type_id": $('#activity_type_id_edit').val(),
                    "start_datetime": $('#start_datetime_edit').val(),
                    "end_datetime": $('#end_datetime_edit').val(),
                    "status": "Pending",
                    "is_required": 1,
                    "memorandum_file_directory": new_memo_path
                }

                console.log(data_form)

                if($('#start_datetime_edit').val() > "{{ date('Y-m-d 00:00:00'); }}" && $('#end_datetime_edit').val() > "{{ date('Y-m-d 00:00:01'); }}" &&
                        $('#start_datetime_edit').val() < $('#end_datetime_edit').val()){
                    $.ajax({
                        url: form_url,
                        method: "PUT",
                        data: JSON.stringify(data_form),
                        dataType: "JSON",
                        headers: {
                            "Accept": "application/json",
                            "Authorization": API_TOKEN,
                            "Content-Type": "application/json"
                        },

                        success: function(data){
                            refresh()
                            $('#editModal').modal('hide');
                            notification("info", "Activity")    
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
                else{
                    swalAlert('warning', 'Invalid datetime')
                }
                
            }
            else{

                let form_url =BASE_API+'replace'

                var fd = new FormData();
                var files = $('#memorandum_file_directory_edit')[0].files[0]

                fd.append('file', files)
                fd.append('old_file', memo_path)

                $.ajax({
                    url: form_url,
                    method: "POST",
                    data: fd,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    headers: {
                        "Accept": "application/json",
                        "Authorization": API_TOKEN,
                        
                    },
                    success: function(data){
                        //console.log(data)
                        new_memo_path = data.path
                        console.log(new_memo_path)

                        var id = $('#id_edit').val();

                        var form_url = BASE_API+id

                        let data_form = {
                            "title": $('#title_edit').val(),
                            "description": $('#description_edit').val(),
                            "location": $('#location_edit').val(),
                            "activity_type_id": $('#activity_type_id_edit').val(),
                            "start_datetime": $('#start_datetime_edit').val(),
                            "end_datetime": $('#end_datetime_edit').val(),
                            "status": "Pending",
                            "is_required": 1,
                            "memorandum_file_directory": new_memo_path
                        }
                        
                        console.log(data_form)

                        $.ajax({
                            url: form_url,
                            method: "PUT",
                            data: JSON.stringify(data_form),
                            dataType: "JSON",
                            headers: {
                                "Accept": "application/json",
                                "Authorization": API_TOKEN,
                                "Content-Type": "application/json"
                            },

                            success: function(data){
                                refresh()
                                $('#editModal').modal('hide');

                                notification("info", "Activity")
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
                })
            }
        });
        // END OF UPDATE FUNCTION

        // FUNCTION TO REMOVE MEMO ON EDIT MODAL
        removeMemo = () =>
        {
            var id = $('#id_edit').val();
            let form_url = APP_URL + '/api/v1/activity/'  + id
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
                    Swal.fire(
                    {
                        title: "Are you sure you?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#34c38f",
                        cancelButtonColor: "#f46a6a",
                        confirmButtonText: "Yes!",
                    })
                    .then(function (t) 
                    {
                        // if user clickes yes.
                        if (t.value) 
                        {
                            let data_form = {
                                "title": data.title,
                                "description": data.description,
                                "agenda": data.agenda,
                                "location": data.location,
                                "activity_type_id": data.activity_type_id,
                                "start_datetime": data.start_datetime,
                                "end_datetime": data.end_datetime,
                                "status": data.status,
                                "is_required": data.is_required,
                                "memorandum_file_directory": null
                            }
                            $.ajax({
                                url: form_url,
                                method: "PUT",
                                data: JSON.stringify(data_form),
                                dataType: "JSON",
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": API_TOKEN,
                                    "Content-Type": "application/json"
                                },

                                success: function(data){
                                    $('#editModal').modal('hide');
                                    notification("info", "Activity")
                                    refresh()
                                    location.reload()
                                    
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
                        else{
                            swalAlert('warning', 'Invalid datetime')
                        }
                    })
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
        // END FUNCTION TO REMOVE MEMO ON EDIT MODAL

        // FOR ACTIVITY TYPE CREATE FORM DROPDOWN ON CHANGE
        $(document).on("change", "#activity_type_id", function()
        {
            var activity_type_id = $("#activity_type_id").val()

            console.log(activity_type_id)
            $.ajax({
                url: APP_URL + '/api/v1/activity_type/' + activity_type_id,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data)
                {
                    console.log(data.category)
                    if (data.category == "Meeting")
                    {
                        console.log("This is Meeting")
                        document.getElementById("agenda_div").hidden = false;     // Show

                    }    
                    else if (data.category == "Activity")
                    {
                        console.log("This is Activity")
                        document.getElementById("agenda_div").hidden = true;   // Hide
                    } 
                }
            });
        });
        // END FOR ACTIVITY TYPE CREATE FORM DROPDOWN ON CHANGE

        // FOR ACTIVITY TYPE EDIT FORM DROPDOWN ON CHANGE
        $(document).on("change", "#activity_type_id_edit", function()
        {
            var activity_type_id = $("#activity_type_id_edit").val()

            console.log(activity_type_id)
            $.ajax({
                url: APP_URL + '/api/v1/activity_type/' + activity_type_id,
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "Authorization": API_TOKEN,
                    "Content-Type": "application/json"
                },
                success: function(data)
                {
                    console.log(data.category)
                    if (data.category == "Meeting")
                    {
                        console.log("This is Meeting")
                        document.getElementById("agenda_edit_div").hidden = false; 

                    }    
                    else if (data.category == "Activity")
                    {
                        console.log("This is Activity")
                        document.getElementById("agenda_edit_div").hidden = true;   // Hide
                    } 
                }
            });
        });
        // END FOR ACTIVITY TYPE EDIT FORM DROPDOWN ON CHANGE

        // DELETE FUNCTION
        $(document).on("click", ".btnDeactivate", function(){
            var id = this.id;
            let form_url = APP_URL + '/api/v1/activity/'  + id
            console.log(form_url)
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
                                    notification('error', 'Activity')
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

        // DEACTIVATE SUBMIT FUNCTION
        $('#deactivateForm').on('submit', function(e){
            e.preventDefault()
            var id = $('#id_delete').val();
            var form_url = APP_URL+'/api/v1/activity/destroy/'+id

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

                    notification("error", "Activity")
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
