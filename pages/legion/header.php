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
            <div class="navbar-list">
                <div class="navbar-menuitem"><a href="index.php">Home</a></div>
                <div class="navbar-menuitem"><a href="register.php">Register</a></div>
                <div class="navbar-menuitem"><a href="onlineplayers.php">Online players</a></div>
                <div class="navbar-menuitem"><a href="howto.php">How to</a></div>
                <div class="navbar-menuitem"><a href="armory.php">Armory</a></div>
                <div class="navbar-menuitem"><a href="gallery.php">Gallery</a></div>
            </div>
        </div>
    </div>
</div>

<div class="midContent">
    <div class="container">
        <?php
        include 'page.php';
        ?>
    </div>
</div>