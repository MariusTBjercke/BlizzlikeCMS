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
                        <li class="<?php if ($page == 'home') { echo 'mobilemenu-active'; } ?>"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li class="<?php if ($page == 'register') { echo 'mobilemenu-active'; } ?>"><a href="register.php"><span class="glyphicon glyphicon-pencil"></span> Register</a></li>
                        <li class="<?php if ($page == 'onlineplayers') { echo 'mobilemenu-active'; } ?>"><a href="onlineplayers.php"><span class="glyphicon glyphicon-user"></span> Who's online</a></li>
                        <li class="<?php if ($page == 'forum') { echo 'mobilemenu-active'; } ?>"><a href="forum.php"><span class="glyphicon glyphicon-user"></span> Forum</a></li>
                        <li class="<?php if ($page == 'howto') { echo 'mobilemenu-active'; } ?>"><a href="howto.php"><span class="glyphicon glyphicon-question-sign"></span> How to</a></li>
                        <li class="<?php if ($page == 'armory') { echo 'mobilemenu-active'; } ?>"><a href="armory.php"><span class="glyphicon glyphicon-user"></span> Armory</a></li>
                        <li class="<?php if ($page == 'gallery') { echo 'mobilemenu-active'; } ?>"><a href="gallery.php"><span class="glyphicon glyphicon-picture"></span> Gallery</a></li>
                        <li class="<?php if ($page == 'gamemasters') { echo 'mobilemenu-active'; } ?>"><a href="gamemasters.php"><span class="glyphicon glyphicon-exclamation-sign"></span> Staff</a></li>
                    </ul>
                </div>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-list">
                <div class="navbar-menuitem <?php if ($page == 'home') { echo 'menuitem-active'; } ?>"><a href="index.php">Home</a></div>
                <div class="navbar-menuitem <?php if ($page == 'register') { echo 'menuitem-active'; } ?>"><a href="register.php">Register</a></div>
                <div class="navbar-menuitem <?php if ($page == 'onlineplayers') { echo 'menuitem-active'; } ?>"><a href="onlineplayers.php">Online players</a></div>
                <div class="navbar-menuitem <?php if ($page == 'forum') { echo 'menuitem-active'; } ?>"><a href="forum.php">Forum</a></div>
                <div class="navbar-menuitem <?php if ($page == 'howto') { echo 'menuitem-active'; } ?>"><a href="howto.php">How to</a></div>
                <div class="navbar-menuitem <?php if ($page == 'armory') { echo 'menuitem-active'; } ?>"><a href="armory.php">Armory</a></div>
                <div class="navbar-menuitem <?php if ($page == 'gallery') { echo 'menuitem-active'; } ?>"><a href="gallery.php">Gallery</a></div>
                <div class="navbar-menuitem <?php if ($page == 'gamemasters') { echo 'menuitem-active'; } ?>"><a href="gamemasters.php">Staff</a></div>
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