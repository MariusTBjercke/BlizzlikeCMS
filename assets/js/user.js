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