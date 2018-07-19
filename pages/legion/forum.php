<?php
$forum = new Forum();
?>
<div class="forum-page">

    <h2>Forum</h2>
    <p>Welcome to the forum.</p>

    <?= $forum->displayAllCategories(); ?>

</div>