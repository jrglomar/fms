
<script>
    $(document).ready(function(){

        // GLOBAL VARIABLE
        var APP_URL = {!! json_encode(url('/')) !!}
        var API_TOKEN = localStorage.getItem("API_TOKEN")
        var USER_DATA = localStorage.getItem("USER_DATA")
        var SRD_BASE_API = APP_URL + '/api/v1/requirement_bin/'
        var MEETING_BASE_API = APP_URL + '/api/v1/meeting/'
        var ACTIVITY_BASE_API = APP_URL + '/api/v1/activity/'
        
        console.log(API_TOKEN)
        console.log(JSON.parse(USER_DATA))
        // END OF GLOBAL VARIABLE

        // SRD DATATABLES FUNCTION
        function SRDdataTable(){
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
                            columns: [ 1, 2, 3, 4, 5, 6 ],
                            modifier: { order: 'index' },
                            alignment: 'center'
                        },
                        className: 'btn-report info',
                        titleAttr: 'PDF export.',
                        extension: '.pdf',
                        title: function() {
                            var current_time = new Date(); // current time
                            return "SRD_Report" 
                            // + moment(current_time).format('YYYY_MMMM_DD')
                        },
                        filename: function() {
                            var current_time = new Date(); // current time
                            return "SRD_Report" 
                            // + moment(current_time).format('YYYY_MMMM_DD')
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
                            columns: [ 1, 2, 3, 4, 5, 6 ],
                            modifier: { order: 'index' }
                        },
                        filename: function() {
                            var current_time = new Date(); // current time
                            return "SRD_Report" 
                            // + moment(current_time).format('YYYY_MMMM_DD')
                        },
                        title: function() {
                            var current_time = new Date(); // current time
                            return "SRD_Report" 
                            // + moment(current_time).format('YYYY_MMMM_DD')
                        }
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
                    { data: "deadline", render: function(data, type, row){
                        return `${moment(data).format('LLL')}`
                    }},
                ],
                "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
                "order": [[1, "desc"]]
                })
        }
        // END OF SRD DATATABLE FUNCTION

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
