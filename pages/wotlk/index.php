</div>

<div class="front-video">
    <iframe width="338" height="249" src="<?php echo $frontpage_toppage_ytlink; ?>" frameborder="0"
            allowfullscreen></iframe>
</div>

<div class="front-banner">
    <div class="bannerContent">
        <h2><?php echo $servername; ?></h2>
        <h3>WotLK</h3>
    </div>
</div>

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