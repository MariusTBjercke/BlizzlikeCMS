<?php
$forum = new Forum();
if ($_GET['id']) {
    $postID = $_GET['id'];
}
?>

<div class="forum-page">

    <div class="show_post">

        <?php
        $forum->displayPost($postID);
        ?>

    </div>

</div>
