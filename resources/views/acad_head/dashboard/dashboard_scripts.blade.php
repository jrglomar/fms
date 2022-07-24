
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function(){

        /// GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        // END OF GLOBAL VARIABLE

        $.ajax({
              url: APP_URL + '/api/v1/activity',
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
              url: APP_URL + '/api/v1/meeting',
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
              url: APP_URL + '/api/v1/requirement_required_faculty_list',
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
        



        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
