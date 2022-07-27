
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var ACTIVITY_BASE_API = APP_URL + '/api/v1/activity/'
        
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))
        // END OF GLOBAL VARIABLE

        

        // ACTIVITY DATATABLES FUNCTION
        function ACTIVITYdataTable(){
                // FOR FOOTER GENERATE OF INPUT
                $('#ACTIVITYdataTable tfoot th').each( function (i) {
                    var title = $('#ACTIVITYdataTable thead th').eq( $(this).index() ).text();
                    $(this).html( '<input size="15" class="form-control" type="text" placeholder="'+title+'" data-index="'+i+'" />');
                });

                dataTable = $('#ACTIVITYdataTable').DataTable({
                "ajax": {
                    url: ACTIVITY_BASE_API, 
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
                        className: 'btn btn-primary mr-2',
                        titleAttr: 'PDF export.',
                        extension: '.pdf',
                        // download: 'open', // FOR NOT DOWNLOADING THE FILE AND OPEN IN NEW TAB
                        title: function() {
                            var current_time = new Date(); // current time
                            var date_filter_from = $('#date_from').val();
                            var date_filter_to = $('#date_to').val();

                            if(( date_filter_from == "") && (date_filter_to == ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Activity_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Activity_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                        filename: function() {
                            var current_time = new Date(); // current time
                            var date_filter_from = $('#date_from').val();
                            var date_filter_to = $('#date_to').val();

                            if(( date_filter_from == "") && (date_filter_to == ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Activity_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Activity_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
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
                        className: 'btn btn-success',
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
                                return "Activity_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Activity_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
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
                                return "Activity_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "Activity_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                    }]
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at", render: function(data, type, row){
                        return moment(row.created_at).format('LL')
                    }},
                    { data: "title"},
                    { data: "activity_type_id", render:function(data, type, row){
                        return row.activity_type.title + " (" + row.activity_type.category + ")"
                    }},
                    { data: "description"},
                    { data: "agenda", render:function(data, type, row){
                        if(data == null || data == "NA")
                        {
                            return "-----"
                        }
                        else
                        {
                            return data
                        }
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
                    }},
                    { data: "start_datetime", render: function(data, row){
                        return `${moment(data).format('LL')} - ${moment(row.end_datetime).format('LL')}` 
                    }},
                    { data: "memorandum_file_directory", render:function(data, type, row){
                        if(data == null || data == "NA")
                        {
                            return "-----"
                        }
                        else
                        {
                            return data
                        }
                    }},
                    { data: "start_datetime"},
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 9] }],
                "order": [[1, "asc"]]
                })


                // Filter event handler
                $(dataTable.table().container() ).on( 'keyup', 'tfoot input', function () {
                    console.log(this.value)
                    console.log(dataTable)
                    dataTable
                        .column( $(this).data('index') )
                        .search( this.value )
                        .draw();
                });

                // Extend dataTables search
                $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#date_from').val();
                    var max = $('#date_to').val();
                    var dateActivity = data[9]; // DATE IN TABLE

                    if ((min == "" || max == "") || (moment(dateActivity).isSameOrAfter(min) && moment(dateActivity).isSameOrBefore(max))) 
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                });

                // Re-draw the table when the a date range filter changes
                $('.date-range-filter').change( function() {
                    dataTable.draw();
                });
        }
        // END OF DATATABLE FUNCTION

        $('.btnChangeStatus').on('change', function(){
            let checked = $('input[name="status_options"]:checked').val();
            console.log(checked)
            if(checked == 'All'){
                    dataTable
                        .column(6)
                        .search("")
                        .draw();
            }
            else if(checked == 'Pending'){
                dataTable
                        .column(6)
                        .search($(this).val())
                        .draw();
            }
            else if(checked == 'On Going' || checked == 'Ongoing'){
                dataTable
                        .column(6)
                        .search($(this).val())
                        .draw();
            }
            else if(checked == 'Cancelled'){
                dataTable
                        .column(6)
                        .search($(this).val())
                        .draw();
            }
            else if(checked == 'Done'){
                dataTable
                        .column(6)
                        .search($(this).val())
                        .draw();
            }
        })

        $('#btnDateReset').on('click', function(){
            $('.date-range-filter').val("")

            dataTable.draw();
        })

        // // DATE FILTERING
            // EXTEND DATATABLE SEARCH
            // $.fn.dataTable.ext.search.push(
            // function(settings, data, dataIndex) {
            //     var min = $('#min-date').val();
            //     var max = $('#max-date').val();
            //     var createdAt = data[2] || 0; // CREATED_AT IN TABLE

            //     if ((min == "" || max == "") || (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))) 
            //     {
            //         return true;
            //     }
            //     else
            //     {
            //         return false;
            //     }
            // });

        //     // REDRAW DATATABLE DATE RANGE FILTER CHANGE
        //     $('.date-range-filter').change(function() {
        //         dataTable.draw();
        //     });

        //     $('#MEETINGdataTable_filter').hide();

        //     // RESET BUTTON FOR THE DATATABLE DATE FILTERING
        //     $(document).on("click", "#reset_date_filter", function(){
        //         $("input[type=date]").val("");
        //         // REDRAW DATATABLE DATE RANGE FILTER CHANGE
        //         dataTable.columns().search("").draw();
        //     })
        // // END DATE FILTERING

        // CALLING ALL DATATABLE FUNCTION
        ACTIVITYdataTable()

        // REFRESH DATATABLE FUNCTION
        function refresh(){
            let url = ACTIVITY_BASE_API

            dataTable.ajax.url(url).load()
        }
        // REFRESH DATATABLE FUNCTION

        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
