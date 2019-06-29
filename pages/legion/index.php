<?php
$polls = new Polls();

if (isset($_GET['submit_yes'])) {
    echo $polls->voteYes();
}
if (isset($_GET['submit_no'])) {
    $polls->voteNo();
}
if ($show_frontpage > 0) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="front-banner">
                    <?php
                    $site = new Site();
                    echo $site->getFirstPost();
                    ?>
                </div>
            </div>
            <div class="col">
                <div class="poll">
                    <?php
                    echo '<i class="fa fa-bullhorn"></i> <span>Question:</span> ' . $polls->displayActivePoll();
                    ?>
                    <div class="buttons">
                        <?php
                        $poll_id = $polls->activePollID;
                        $request = $polls->checkIfHasVoted($poll_id);
                        if ($request) {
                            echo $polls->displayAnswers();
                        } else {
                        ?>
                            <form action="" type="get">
                                <input type="submit" name="submit_yes" value="Yes">
                            </form>
                            <form action="" type="get">
                                <input type="submit" name="submit_no" value="No">
                            </form>
                        <?php
                        }
                        ?>
                    </div>
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