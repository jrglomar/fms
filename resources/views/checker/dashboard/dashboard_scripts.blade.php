
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function(){

        /// GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        // END OF GLOBAL VARIABLE

        $.ajax({
              url: APP_URL + '/api/v1/meeting',
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                data = class_schedule_response.data
                // console.log(data)
                count = data.length
                class_schedule_total = 0
                added = 0
                deactivate = 0

                for (let i=0; i< count; i++){
                    class_schedule_total += 1
                    if( data[i].status == "Added"){
                        added += 1
                    }
                    else if( data[i].status == "Deactivated"){
                      deactivate += 1
                    }
                }

                var donutChartCanvas = $('#meeting_donut').get(0).getContext('2d')
                var donutData        = {
                  labels: [
                      'Added',
                      'Deactivate',
                  ],
                  datasets: [
                    {
                      data: [added,deactivate],
                      backgroundColor : ['#00a65a', '#f56954'],
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

                $('#total_meeting').html(class_schedule_total)

              }
        })

        $.ajax({
              url: APP_URL + '/api/v1/class_attendance',
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                console.log(data)
                count = data.length
                class_attendance_total = 0
                sub = 0
                fr = 0
                dec = 0
                app = 0

                for (let i=0; i< count; i++){
                    class_attendance_total += 1

                    if( data[i].status == "Submitted"){
                        sub += 1
                    }
                    else if( data[i].status == "For Revision"){
                        fr += 1
                    }
                    else if( data[i].status == "Declined"){
                        dec += 1
                    }
                    else if( data[i].status == "Approved"){
                        app += 1
                    }
                }

                var canvas = document.getElementById("rsb_donut")
                var donutChartCanvas = $('#rsb_donut').get(0).getContext('2d')
                var donutData        = {
                  labels: [
                      'Submitted',
                      'For Revision',
                      'Declined',
                      'Approved',
                  ],
                  datasets: [
                    {
                      data: [sub,fr,dec,app],
                      backgroundColor : ['#cdd3d8', '#f39c12', '#f56954', '#00a65a',],
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

                $('#total_srb').html(class_attendance_total)

              }
        })
        



        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
