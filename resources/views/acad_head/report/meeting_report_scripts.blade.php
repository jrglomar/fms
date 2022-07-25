
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var MEETING_BASE_API = APP_URL + '/api/v1/meeting/'
        
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))
        // END OF GLOBAL VARIABLE

        // MEETING DATATABLES FUNCTION
        function MEETINGdataTable(){
                dataTable = $('#MEETINGdataTable').DataTable({
                "ajax": {
                    url: MEETING_BASE_API, 
                    dataSrc: ''
                },
                'dom': 'Bfrtip',
                'buttons': {
                    dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                    },
                    buttons: [{
                        extend: 'pdfHtml5',  
                        text: 'Export as PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: ':visible', // CAN USE ALSO AN ARRAY OF COLUMN LIKE [ 1, 2, 3, 4, 5, 6, 8, 9 ]
                            modifier: { order: 'current' }
                        },
                        className: 'btn-report info',
                        titleAttr: 'PDF export.',
                        extension: '.pdf',
                        // download: 'open', // FOR NOT DOWNLOADING THE FILE AND OPEN IN NEW TAB
                        title: function() {
                            var current_time = new Date(); // current time
                            var date_filter_from = $('#min-date').val();
                            var date_filter_to = $('#max-date').val();

                            if(( date_filter_from == "") && (date_filter_to == ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                        filename: function() {
                            var current_time = new Date(); // current time
                            var date_filter_from = $('#min-date').val();
                            var date_filter_to = $('#max-date').val();

                            if(( date_filter_from == "") && (date_filter_to == ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                        customize: function(doc) {
                            doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.defaultStyle.alignment = 'center';
                            doc.styles.tableHeader.alignment = 'center';
                        },
                    }, 
                    {
                        extend: 'excelHtml5',
                        className: 'btn-report info',
                        titleAttr: 'Excel export.',
                        text: 'Export as XLS',
                        extension: '.xlsx',
                        exportOptions: {
                            columns: ':visible', // CAN USE ALSO AN ARRAY OF COLUMN LIKE [ 1, 2, 3, 4, 5, 6, 8, 9 ]
                            modifier: { order: 'current' }
                        },
                        filename: function() {
                            var current_time = new Date(); // current time
                            var date_filter_from = $('#min-date').val();
                            var date_filter_to = $('#max-date').val();

                            if(( date_filter_from == "") && (date_filter_to == ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                        title: function() {
                            var current_time = new Date(); // current time
                            var date_filter_from = $('#min-date').val();
                            var date_filter_to = $('#max-date').val();

                            if(( date_filter_from == "") && (date_filter_to == ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Meeting_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                    }]
                },
                "columns": [
                    { data: "id"},
                    { data: "created_by", render: function(data, type, row){
                        return row.created_by_user.faculty.first_name + " " + row.created_by_user.faculty.last_name
                    }},
                    { data: "created_at", render: function(data, type, row){
                        return moment(row.created_at).format('LL')
                    }},
                    { data: "title"},
                    { data: "meeting_type.title"},
                    { data: "agenda"},
                    { data: "location"},
                    { data: "start_time", render: function(data, type, row){
                        return `${moment(row.date).format('LL')},${moment("2022-06-27 "+data).format('LT')} - ${moment("2022-06-27 "+row.end_time).format('LT')}`
                    }}, 
                    { data: "is_required", render: function (data, type, row) { // required
                          if(data == true)
                          {
                            return 'Yes'
                          }
                          else
                          {
                            return 'No'
                          }
                        }
                    },
                    { data: "status"},
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 8] }],
                "order": [[2, "asc"]]
                })
        }
        // END OF MEETING DATATABLE FUNCTION

        // DATE FILTERING
            // EXTEND DATATABLE SEARCH
            $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[2] || 0; // CREATED_AT IN TABLE

                if ((min == "" || max == "") || (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))) 
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });

            // REDRAW DATATABLE DATE RANGE FILTER CHANGE
            $('.date-range-filter').change(function() {
                dataTable.draw();
            });

            $('#MEETINGdataTable_filter').hide();

            // RESET BUTTON FOR THE DATATABLE DATE FILTERING
            $(document).on("click", "#reset_date_filter", function(){
                $("input[type=date]").val("");
                // REDRAW DATATABLE DATE RANGE FILTER CHANGE
                dataTable.columns().search("").draw();
            })
        // END DATE FILTERING


        // CALLING ALL DATATABLE FUNCTION
        MEETINGdataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = SRD_BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
