
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function(){
        /// GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var FACULTY_ID = JSON.parse(USER_DATA).faculty.id
        // END OF GLOBAL VARIABLE
      // FUNCTION TO UPDATE MEETING STATUS UPON VIEWING
      
      function updateActivityStatus()
        {
            $.ajax({
                url: APP_URL + '/api/v1/activity/',
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
                                    url: APP_URL + '/api/v1/activity/' + responseData[i].id,
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
                                    url: APP_URL + '/api/v1/activity/' + responseData[i].id,
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
                                    url: APP_URL + '/api/v1/activity/' + responseData[i].id,
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
                                    url: APP_URL + '/api/v1/activity/' + responseData[i].id,
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
                                    url: APP_URL + '/api/v1/activity/' + responseData[i].id,
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


      // 1st and 2nd ROW - CARDS and CHARTS(DONUT)
        $.ajax({
              url: APP_URL + '/api/v1/activity_attendance/get_all_activities_of_specific_categoryANDfaculty/' + FACULTY_ID + '/' + 'Activity',
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                console.log(data)
                count = data.length
                activity_total = 0
                pend = 0
                ongoing = 0
                ended = 0

                date = moment(new Date()).format() 

                for (let i=0; i< count; i++){
                    activity_total += 1

                    if( moment(data[i].start_datetime).format() < date && moment(data[i].end_datetime).format() > date){
                        ongoing += 1
                    }
                    else if(date > moment(data[i].end_datetime).format()){
                        ended += 1
                    }
                    else{
                        pend += 1
                    }
                }

                var donutChartCanvas = $('#activity_donut').get(0).getContext('2d')
                var donutData        = {
                  labels: [
                      'Ongoing',
                      'Ended',
                      'Pending',
                  ],
                  datasets: [
                    {
                      data: [ongoing,ended,pend],
                      backgroundColor : ['#00a65a', '#f56954', '#f39c12'],
                    }
                  ]
                }
                var donutOptions     = {
                  maintainAspectRatio : false,
                  responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                  type: 'doughnut',
                  data: donutData,
                  options: donutOptions
                })

                $('#total_activity').html(activity_total)

              }
        })

        $.ajax({
              url: APP_URL + '/api/v1/activity_attendance/get_all_activities_of_specific_categoryANDfaculty/' + FACULTY_ID + '/' + 'Meeting',
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                //console.log(data)
                count = data.length
                meeting_total = 0
                ongoing = 0
                pending = 0
                done = 0

                for (let i=0; i< count; i++){
                    meeting_total += 1
                    if( data[i].status == "On Going"){
                        ongoing += 1
                    }
                    else if( data[i].status == "Pending"){
                        pending += 1
                    }
                    else if( data[i].status == "Done"){
                        done += 1
                    }
                }

                var donutChartCanvas = $('#meeting_donut').get(0).getContext('2d')
                var donutData        = {
                  labels: [
                      'Ongoing',
                      'Pending',
                      'Done',
                  ],
                  datasets: [
                    {
                      data: [ongoing,pending,done],
                      backgroundColor : ['#00a65a', '#f56954', '#f39c12'],
                    }
                  ]
                }
                var donutOptions     = {
                  maintainAspectRatio : false,
                  responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                  type: 'doughnut',
                  data: donutData,
                  options: donutOptions
                })

                $('#total_meeting').html(meeting_total)

              }
        })

        $.ajax({
              url: APP_URL + '/api/v1/requirement_bin/get_required_requirement_bin/'+FACULTY_ID,
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                console.log(data)
                count = data.length
                srb_total = 0
                app = 0
                dec = 0
                rev = 0

                for (let i=0; i< count; i++){
                    srb_total += 1

                    if( data[i].status == "Approved"){
                        app += 1
                    }
                    else if( data[i].status == "Declined"){
                        dec += 1
                    }
                    else if( data[i].status == "Revision"){
                        rev += 1
                    }
                }

                var canvas = document.getElementById("rsb_donut")
                var donutChartCanvas = $('#rsb_donut').get(0).getContext('2d')
                var donutData        = {
                  labels: [
                      'Approved',
                      'Decline',
                      'For Revision',
                  ],
                  datasets: [
                    {
                      data: [app,dec,rev],
                      backgroundColor : ['#00a65a', '#f56954', '#f39c12'],
                    }
                  ]
                }
                var donutOptions     = {
                  maintainAspectRatio : false,
                  responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                  type: 'doughnut',
                  data: donutData,
                  options: donutOptions
                })

                $('#total_srb').html(srb_total)

              }
        })
      // END 1st and 2nd ROW - CARDS and CHARTS(DONUT)

      // LIST OF ON GOING ACTIVITY TABLE
        // DATA TABLES FUNCTION
        function onGoing_ActivitydataTable(){
          date = moment(new Date).format()
          dataTable = $('#onGoingActivityDataTable').DataTable({
          "ajax": {
              url: APP_URL + '/api/v1/activity_attendance/get_all_activities_of_specific_categoryANDfaculty/' + FACULTY_ID + '/' + 'Activity', 
              dataSrc: ''
          },
          "columns": [
              { data: "id"},
              { data: "created_at"},
              { data: "title"},
              { data: "title"},
              { data: "description"},
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
                    }},
              { data: "start_datetime", render: function(data, type, row){
                  return `<span class="badge badge-info">${moment(data).format('LLL')} - ${moment(row.end_datetime).format('LLL')}</span>` 
              }},
              { data: "deleted_at", render: function(data, type, row){
                          if (data == null){
                              return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                              <div class="dropdown-menu dropdown-menu-right">
                              <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                              <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                              <div>View</div></div>`;
                          }
                          else{
                              return '<button class="btn btn-danger btn-sm">Activate</button>';
                          }
                      }
                  }
              ],
          "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 4, 6] }],
          "order": [[1, "desc"]]
          })

          dataTable.column(5).search("On Going").draw();
        }
        // END OF DATATABLE FUNCTION
        onGoing_ActivitydataTable()
      // END LIST OF ON GOING ACTIVITY TABLE

      // LIST OF ON GOING MEETING TABLE
        // DATA TABLES FUNCTION
        function onGoing_MeetingdataTable(){
          date = moment(new Date).format()
          dataTable = $('#onGoingMeetingDataTable').DataTable({
          "ajax": {
              url: APP_URL + '/api/v1/activity_attendance/get_all_activities_of_specific_categoryANDfaculty/' + FACULTY_ID + '/' + 'Meeting', 
              dataSrc: ''
          },
          "columns": [
              { data: "id"},
              { data: "created_at"},
              { data: "title"},
              { data: "title"},
              { data: "description"},
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
                    }},
              { data: "start_datetime", render: function(data, type, row){
                  return `<span class="badge badge-info">${moment(data).format('LLL')} - ${moment(row.end_datetime).format('LLL')}</span>` 
              }},
              { data: "deleted_at", render: function(data, type, row){
                          if (data == null){
                              return `<div class="text-center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button"><i class="fas fa-ellipsis-v"></i></div>
                              <div class="dropdown-menu dropdown-menu-right">
                              <div class="dropdown-item d-flex btnView" id="${row.id}" role="button">
                              <div style="width: 2rem"><i class="fas fa-eye"></i></div>
                              <div>View</div></div>`;
                          }
                          else{
                              return '<button class="btn btn-danger btn-sm">Activate</button>';
                          }
                      }
                  }
              ],
          "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1, 4, 6] }],
          "order": [[1, "desc"]]
          })

          dataTable.column(5).search("On Going").draw();
        }
        // END OF DATATABLE FUNCTION
        onGoing_MeetingdataTable()
      // END LIST OF ON GOING MEETING TABLE


      removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
