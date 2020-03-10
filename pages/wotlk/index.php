<?php
$polls = new Polls();

if (isset($_GET['submit_yes'])) {
    $polls->voteYes();
}
if (isset($_GET['submit_no'])) {
    $polls->voteNo();
}
if ($show_frontpage > 0) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="front-banner">
                    <?php
                    $site = new Site();
                    echo $site->getFirstPost();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<div class="midContent-content">
    <div class="frontPage-news">

        <?php

        $pagenum = 1;
        if(!empty($_GET['pagenum'])) {
            $pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
            if(false === $pagenum) {
                $pagenum = 1;
            }
        }

        $site = new Site();
        $site->getPosts($pagenum);

        ?>

    </div>
</div>