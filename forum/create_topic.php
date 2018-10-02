<?php
$forum = new Forum();
if ($_POST['submit']) {
    $title = $_POST['title'];
    $message = $_POST['title'];
    $posterID = $_SESSION['user_id'];
    $forum->saveTopic($title, $message, $posterID);
}
if ($_GET['id']) {
    $catID = $_GET['id'];
}
$_SESSION['headers'] = array(
    "<script src='includes/tinymce/tinymce.min.js'></script>",
    "<script>
  tinymce.init({
    selector: '.message_field',
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
    <?php $forum->createTopic($catID); ?>
</div>