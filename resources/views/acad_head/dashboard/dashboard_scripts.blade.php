
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
                //console.log(data)
                count = data.length
                activity_total = 0

                for (let i=0; i< count; i++){
                    activity_total += 1
                }

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

                for (let i=0; i< count; i++){
                    meeting_total += 1
                }

                $('#total_meeting').html(meeting_total)

              }
        })

        $.ajax({
              url: APP_URL + '/api/v1/submitted_requirement',
              type: "GET",
              dataType: "JSON",
    
              success: function(data){
                //console.log(data)
                count = data.length
                srb_total = 0

                for (let i=0; i< count; i++){
                    srb_total += 1
                }

                // var donutChartCanvas = $('#status_donut').get(0).getContext('2d')
                // var donutData        = {
                //   labels: [
                //       'Available',
                //       'Repair',
                //       'Broken',
                //       'Missing',
                //       'Sold',
                //       'Disposed',
                //   ],
                //   datasets: [
                //     {
                //       data: [avail,rep,brok,miss,sold,disp],
                //       backgroundColor : ['#00a65a', '#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                //     }
                //   ]
                // }
                // var donutOptions     = {
                //   maintainAspectRatio : false,
                //   responsive : true,
                // }
                // //Create pie or douhnut chart
                // // You can switch between pie and douhnut using the method below.
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
