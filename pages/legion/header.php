<div class="top-bar">
    <div class="container">
        <div class="row">
            <h1><a href="index.php"><?php echo $servername; ?></a></h1>
            <ul class="pull-right">
                <li><a href="#">Support</a></li>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Administration</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="navbar-legion">
        <a href="index.php" title="<?php echo $servername; ?>"><div class="top-logo"></div></a>
        <div class="navbar-nav">
            <div class="navbar-menuitem">Home</div>
            <div class="navbar-menuitem">Register</div>
            <div class="navbar-menuitem">Online players</div>
            <div class="navbar-menuitem">How to</div>
            <div class="navbar-menuitem">Armory</div>
            <div class="navbar-menuitem">Gallery</div>
        </div>
    </div>
</div>

<div class="container">
    <div class="front-banner">
        <?php
        $site = new Site();
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