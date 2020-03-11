<?php
$forum = new Forum();
?>

<div class="top-bg2-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm text-right servername"><a href="index.php"><?= $servername; ?></a></div>
        </div>
    </div>
</div>

<div class="page-bg-top">
    <div class="container">
        <div class="murloc_speechubble">
            <div class="speechbubble_content">
                <span>Rwlrwlrwl!</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <a href="index.php" title="<?php echo $servername; ?>"><div class="top-logo"></div></a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="left-wotlk-bg">
        <div class="ne-top"></div>
        <div class="ne-center"></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="leftMenu">
            <a href="#">
            <div class="menu-item news">
                <div class="news-icon"></div>
                <div class="plus-icon"></div>
                <span class="menu-text">News</span>
                <div class="menu-item-add"></div>
            </div>
            </a>
            <div class="menu-dropdown-news">
                <div class="menu-content-top"></div>
                <div class="menu-content-mid">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                    </ul>
                </div>
                <div class="menu-content-bot"></div>
            </div>

            <a href="#">
            <div class="menu-item account">
                <div class="news-icon"></div>
                <div class="plus-icon"></div>
                <span class="menu-text">Account</span>
                <div class="menu-item-add"></div>
            </div>
            </a>
            <div class="menu-dropdown-account">
                <div class="menu-content-top"></div>
                <div class="menu-content-mid">
                    <ul>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="user_login.php">Login</a></li>
                    </ul>
                </div>
                <div class="menu-content-bot"></div>
            </div>

            <a href="#">
                <div class="menu-item server">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Server</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-dropdown-server">
                <div class="menu-content-top"></div>
                <div class="menu-content-mid">
                    <ul>
                        <li><a href="onlineplayers.php">Online players</a></li>
                        <li><a href="#">Status:</a> <?php getServerStatus(); ?></li>
                        <li><a href="armory.php">Armory</a></li>
                        <li><a href="howto.php">How to</a></li>
                    </ul>
                </div>
                <div class="menu-content-bot"></div>
            </div>

            <a href="#">
                <div class="menu-item community">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Community</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-dropdown-community">
                <div class="menu-content-top"></div>
                <div class="menu-content-mid">
                    <ul>
                        <li><a href="/forum">Forum</a></li>
                    </ul>
                </div>
                <div class="menu-content-bot"></div>
            </div>

            <a href="#">
                <div class="menu-item media">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Media</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-dropdown-media">
                <div class="menu-content-top"></div>
                <div class="menu-content-mid">
                    <ul>
                        <li><a href="gallery.php">Gallery</a></li>
                    </ul>
                </div>
                <div class="menu-content-bot"></div>
            </div>

            <a href="#">
                <div class="menu-item site">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Site</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-dropdown-site">
                <div class="menu-content-top"></div>
                <div class="menu-content-mid">
                    <ul>
                        <li><a href="/admin">Administration</a></li>
                    </ul>
                </div>
                <div class="menu-content-bot"></div>
            </div>
            <div class="menu-bg">
                <div class="statue-left"></div>
            </div>
        </div>
    </div>

    <div class="container page-content">
        <div class="row">
            <div class="col border-left">
            </div>
            <div class="light-bg">
                <div class="parchment-right"></div>
                <div class="light-bg-content">
                        <?php
                        include 'page.php';
                        ?>
                </div>
            </div>
        </div>
    </div>

</div>