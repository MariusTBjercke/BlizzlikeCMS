<?php
$forum = new Forum();
?>
<div class="forum-page forum-home">
    <h2>Forum</h2>
    <?= $forum->displayAllCategories(); ?>
</div>