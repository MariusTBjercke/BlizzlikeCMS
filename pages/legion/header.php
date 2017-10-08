<div class="top-bar">
    <div class="container">
        <div class="row">
            <h1><a href="index.php"><?php echo $servername; ?></a></h1>
            <ul class="pull-right">
                <li>Server status: <?php getServerStatus(); ?></li>
                <li><a href="admin.php">Administration</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="navbar-legion">
        <a href="index.php" title="<?php echo $servername; ?>"><div class="top-logo"></div></a>
        <div class="navbar-nav">

            <button type="button" title="Open menu" id="toggleNavigation" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <div class="toggledMenu">
                    <ul id="toggledMenuUl">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="onlineplayers.php">Who's online</a></li>
                        <li><a href="howto.php">How to</a></li>
                        <li><a href="armory.php">Armory</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="gamemasters.php">Staff</a></li>
                    </ul>
                </div>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-list">
                <div class="navbar-menuitem"><a href="index.php">Home</a></div>
                <div class="navbar-menuitem"><a href="register.php">Register</a></div>
                <div class="navbar-menuitem"><a href="onlineplayers.php">Online players</a></div>
                <div class="navbar-menuitem"><a href="howto.php">How to</a></div>
                <div class="navbar-menuitem"><a href="armory.php">Armory</a></div>
                <div class="navbar-menuitem"><a href="gallery.php">Gallery</a></div>
                <div class="navbar-menuitem"><a href="gamemasters.php">Staff</a></div>
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