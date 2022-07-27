
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        // var FACULTY_ID = JSON.parse(USER_DATA).faculty.id
        var SRD_BASE_API = APP_URL + '/api/v1/requirement_bin/'
        
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))
        // END OF GLOBAL VARIABLE

        // ACTIVITY DATATABLES FUNCTION
        function SRDdataTable(){
                // FOR FOOTER GENERATE OF INPUT
                $('#SRDdataTable tfoot th').each( function (i) {
                    var title = $('#SRDdataTable thead th').eq( $(this).index() ).text();
                    $(this).html( '<input size="15" class="form-control" type="text" placeholder="'+title+'" data-index="'+i+'" />');
                });

                dataTable = $('#SRDdataTable').DataTable({
                "ajax": {
                    url: SRD_BASE_API, 
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
                                return "SRD_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "SRD_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
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
                                return "SRD_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "SRD_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
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
                                return "SRD_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "SRD_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
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
                                return "SRD_Report"
                            }
                            else if((date_filter_from != null || date_filter_from != "") && (date_filter_to != null || date_filter_to != ""))
                            {
                                console.log(date_filter_from)
                                console.log(date_filter_to)
                                return "SRD_Report_from_" + moment(date_filter_from).format('YYYY_MMMM_DD') + "_to_" + moment(date_filter_to).format('YYYY_MMMM_DD')
                            }
                        },
                    }]
                },
                "columns": [
                    { data: "id"},
                    { data: "created_at", render: function(data, type, row){
                        return moment(row.created_at).format('LL')
                    }},
                    { data: "created_at", render: function(data, type, row){
                        return moment(row.created_at).format('LL')
                    }},
                    { data: "title"},
                    { data: "requirement_list_type", render: function(data, type, row){
                        console.log(data)
                        let requirement_list_type = ''
                        if (data.length == 0)
                        {
                            return "-----"
                        }
                        else
                        {
                            $.each(data, function(i){
                            if(i < (data.length) - 1){
                                requirement_list_type += data[i].requirement_type.title + ', '
                            }
                            else{
                                requirement_list_type += data[i].requirement_type.title
                            }
                        })

                        return requirement_list_type;
                        }
                        
                    }},
                    { data: "deadline", render: function(data, type, row){
                        return `<span class="badge badge-info">${moment(data).format('LLL')}</span>`
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
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0, 1] }],
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
                    var createdAt = data[1] || 0; // CREATED_AT IN TABLE

                    if ((min == "" || max == "") || (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))) 
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                });

                // $.fn.dataTable.ext.search.push(
                //     function( settings, data, dataIndex ) {
                //         var min  = $('#date_from').val();
                //         var max  = $('#date_to').val();
                //         var createdAt = data[1] // Our date column in the table
                //         console.log(data[1])
                        
                //         if  ( 
                //                 ( min == "" || max == "" )
                //                 || 
                //                 ( moment(createdAt).isSameOrAfter(moment(min).format('YYYY-MM-DD' + ' 00:00:00')) && moment(createdAt).isSameOrBefore(moment(max).format('YYYY-MM-DD' + ' 23:59:59')) ) 
                //             )
                //         {
                //             return true;
                //         }
                //         return false;
                //     }
                // );

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

        // CALLING ALL DATATABLE FUNCTION
        SRDdataTable()

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
