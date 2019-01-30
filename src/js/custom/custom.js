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

// Forum quote reply button
$(".quote-reply").click(function() {
    var number = $(this).attr('id');
    var holder = $("#content-field-" + number);
    var author = holder.attr('content');
    var content = "By: " + author + '<br />' + holder.text();
    tinyMCE.activeEditor.setContent(content);
});