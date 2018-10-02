<?php
$forum = new Forum();
if ($_GET['cat']) {
    $catID = $_GET['cat'];
}
if ($_GET['id']) {
    $postID = $_GET['id'];
}
?>

<div class="forum-page">

    <div class="show_post">

        <?php
        $forum->displayTopic($threadID);
        ?>

    </div>

</div>
