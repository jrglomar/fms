
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function(){
        /// GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var FACULTY_ID = JSON.parse(USER_DATA).faculty.id
        // END OF GLOBAL VARIABLE


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
