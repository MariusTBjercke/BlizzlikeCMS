<?php
$forum = new Forum();

if ($_GET['deleteSubCat'] == true) {
    $CatID = $_GET['forum-title-trash'];
    $forum->deleteCategory($CatID);
    echo '<script>window.reload();</script>';
}

if ($_GET['deletePost'] == true) {
    $postID = $_GET['forum-post-id'];
    $forum->deletePost($postID);
    echo '<script>window.reload();</script>';
}

?>

<div class="forum-page forum-home">
    <h2>Forum</h2>
    <?= $forum->displayAllCategories(); ?>
</div>