// Custom file
$(".editForumCategoryName").click(function() {
    var htmlString = $(".forum-category-title").text();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
    $(".forum-category-title").html('<input type="text" value="' + htmlString + '">');
});

// Nav toggle broken link fix for bootstrap
$("#toggledMenuUl li").click(function() {
    var linkName = $(this).attr("id");
    var linkNameWithExt = linkName + '.php';
    window.location.href = linkNameWithExt;
});

var extInstalled = document.getElementById("installed");
if (extInstalled === 'Not installed.') {
    $("#installBtn").prop('disabled', true);
}