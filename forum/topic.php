<?php
$forum = new Forum();
if ($_GET['cat']) {
    $catID = $_GET['cat'];
}
if ($_GET['id']) {
    $topicID = $_GET['id'];
}

if (isset($_POST['reply_submit'])) {
    $title = $_POST['title'];
    $reply = $_POST['reply'];
    $replier_id = getLoggedInUserID();
    $result = $forum->saveReply($title, $reply, $replier_id, $topicID);
    if ($result) {
        echo '<script>alert("Your reply has been published.");</script>';
        echo '<script>window.location.replace("forum.php?page=topic&cat=' . $catID . '&id=' . $topicID . '");</script>';
        exit;
    } else {
        echo '<script>alert("Something went wrong, please try again.");</script>';
        echo '<script>history.back(1);</script>';
        exit;
    }
}

$_SESSION['headers'] = array(
    "<script src='includes/tinymce/tinymce.min.js'></script>",
    "<script>
  tinymce.init({
    selector: '.reply_field',
    branding: false,
    height: 300,
    theme: 'modern',
    plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    image_advtab: true
  });
  </script>
  ",
);

?>

<div class="forum-page">
    <div class="show_post">
        <?php
        $forum->displayTopic($topicID);
        ?>
    </div>

    <div class="show-replies">
        <?php
        echo $forum->displayReplies($topicID);
        ?>
    </div>
</div>
