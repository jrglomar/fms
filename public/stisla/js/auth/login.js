"use strict";
$('input[type=\'password\']').showHidePassword();
$("#login_form").parsley();
$("#login_form").on("submit", function (e) {
    e.preventDefault()
	$.cardProgress("#login_card");
    toastr.clear()

    setTimeout(() => {
        if ($("#email").val() == "admin101@gmail.com" && $("#password").val() == "password101" ) {
            $("#login_card").removeClass('card-progress')
            
            $("#login_card").find('.card-progress-dismiss').remove();
            location.href = "//dashboard.html"
        }else{
            $("#login_card").removeClass('card-progress')
            $("#login_card").find('.card-progress-dismiss').remove();
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "progressBar": true,
              }
            toastr.error("Invalid credentials.","Error!")
        }
    }, 1000);
   
});
