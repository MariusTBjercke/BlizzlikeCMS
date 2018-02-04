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