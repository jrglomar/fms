/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$.ajaxSetup({
    // headers: { Authorization: "Bearer " + $.cookie("token"), Accept: 'application/json' },
});

let submitButton = document.querySelector(".submit");
$(document).ajaxStart(function () {
    submitButton != undefined ? (submitButton.disabled = true) : null;
});

$(document).ajaxSend(function () {
    submitButton != undefined ? (submitButton.disabled = true) : null;
});

$(document).ajaxComplete(function (data) {
    submitButton != undefined ? (submitButton.disabled = false) : null;
});

$(document).ajaxError(function () {
    submitButton != undefined ? (submitButton.disabled = false) : null;
});

function trimInputFields() {
    var allInput = $("input:not(:file())");
    allInput.each(function () {
        $(this).val($.trim($(this).val()));
    });
}

toastr.options = {
    closeButton: true,
    newestOnTop: true,
    progressBar: true,
};

function show_card(card,form) {
    $("html, body").animate({ scrollTop: 0 });
    card.slideDown("slow");
    form.parsley().reset();
}

function hide_card(card) {
    $("html, body").animate({ scrollTop: 0 });
    card.slideUp("slow");
}

function reset_form(form) {
    form.parsley().reset();
    form[0].reset();
    form.find("select").trigger("change")
}