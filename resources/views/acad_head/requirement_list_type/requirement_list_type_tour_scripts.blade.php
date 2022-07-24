
<script>
    $(document).ready(function(){



        //simple config.
        //Only one step - highlighting(with description) "New" button
        //hide EnjoyHint after a click on the button.
        var enjoyhint_script_steps = [
            {
                'next #title': 'This is the title of the requirement bin',
            },
            {
                'next #created_by': 'It is who posted this bin',
            },
            {
                'next #created_at': 'This is the deadline of requirement bin',
            },
            {
                'click #createRequiredDocument': 'This is where you can types of required document',
            },
            {
                'next #requirement_type_id': 'Select a type of document you want to require.',
                timeout : 300
            },
            {
                'click #btnAddRequiredDocu': 'Click here to add the selected document.',
                showNext: false,
            },
            {
                'click #btnEditRequiredFaculty': 'This is where you can add required user to this bin',
                onBeforeStart:function(){
                    $('#createRequiredDocumentModal').modal('hide')
                }
            },
            {
                'next #requiredFacultyModalBody': 'This is list of users that is still not required on this bin.',
                timeout : 300,
            },
            {
                'click .btnUpdate': 'Click here to update required user lists.',
                showNext: false,
            },
            {
                'next #requiredFacultyDatatable_wrapper': 'This is the list of required user/s.',
            },
            {
                'click .btnViewDetails': 'Click here to view uploaded files of required user/s',
                showNext: false,
            },
            {
                'next #fileModalBody': 'This is the where uploaded file/s will be displayed.',
                timeout : 300
            },
            {
                'next #sr_status': 'This is where you can set status of user submitted files.',
            },
            {
                'next #sr_remarks': 'This is where you place your remarks on user submitted files.',
            },
            {
                'click .btnSubmittedUpdate': 'Click here to update changes',
            },

            
        ];

        $('#btnTour').on('click', function(){
            //initialize instance
            var enjoyhint_instance = new EnjoyHint({});
            enjoyhint_instance.set(enjoyhint_script_steps);
            enjoyhint_instance.run();
        })
    // END OF JQUERY FUNCTIONS
    });
</script>
