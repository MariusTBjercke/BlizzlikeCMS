<div class="top-bar">
    <div class="container">
        <div class="row">
            <h1><a href="index.php"><?php echo $servername; ?></a></h1>
            <ul class="pull-right">
                <li><a href="#">Support</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="navbar-legion">
    <a href="index.php" title="<?php echo $servername; ?>"><div class="top-logo"></div></a>
    </div>
</div>

<div class="container">
    <div class="front-banner">
        <?php
        echo $site->getLatestPost();
        ?>
    </div>
</div>

<div class="midContent">
    <div class="container">
        <?php
        include 'page.php';
        ?>
    </div>
</div>