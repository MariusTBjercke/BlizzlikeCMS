$(document).ready(function() {
    $(".user-avatar").on("mouseover", function(){
        $(".change-avatar").css('display', 'block');
    });
    $(".user-avatar").on("mouseleave", function(){
        $(".change-avatar").css('display', 'none');
    });
    $(".change-avatar").on("mouseover", function(){
        $(".change-avatar").css('display', 'block');
    });
});

var modalBg = $('.user-profilepic-modal-bg');

$(document).ready(function() {
    $('.user-change-avatar').click(function() {
        modalBg.toggle();
    });
});

$(document).on('keyup',function(evt) {
    if (evt.keyCode === 27) {
        modalBg.toggle();
    }
});


// Avatar upload
$('#upload').on('change', function () { //trigger when a file is uploaded
    if ($('#filetype').val() == '') //If target type is not selected
    {
        var control = $("#upload");
        control.replaceWith(control = control.clone(true)); //Clone & Reset the input File type
        setTimeout(function () {
            runThis()
        }, 1000); //Trigger the select box for user to select target type
    }
    else {
        $('#imagick').submit(); //If target type is selected simply submit the form
    }
});