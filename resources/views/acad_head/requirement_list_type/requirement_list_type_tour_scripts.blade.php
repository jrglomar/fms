
<script>
    $(document).ready(function(){

        //initialize instance
        var enjoyhint_instance = new EnjoyHint({});

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
        ];

        $('#btnTour').on('click', function(){
            enjoyhint_instance.set(enjoyhint_script_steps);
            enjoyhint_instance.run();
        })


        removeLoader()
    // END OF JQUERY FUNCTIONS
    });
</script>
