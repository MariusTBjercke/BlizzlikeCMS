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