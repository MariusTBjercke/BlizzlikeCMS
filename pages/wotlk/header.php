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
            <div class="menu-item">
                <div class="news-icon"></div>
                <div class="plus-icon"></div>
                <span class="menu-text">News</span>
                <div class="menu-item-add"></div>
            </div>
            </a>
            <div class="menu-content-top"></div>
            <div class="menu-content-mid">
                <ul>
                    <li>Home</li>
                </ul>
            </div>
            <div class="menu-content-bot"></div>

            <a href="#">
            <div class="menu-item">
                <div class="news-icon"></div>
                <div class="plus-icon"></div>
                <span class="menu-text">Account</span>
                <div class="menu-item-add"></div>
            </div>
            </a>
            <div class="menu-content-top"></div>
            <div class="menu-content-mid">
                <ul>
                    <li>Register</li>
                    <li>Login</li>
                </ul>
            </div>
            <div class="menu-content-bot"></div>

            <a href="#">
                <div class="menu-item">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Server</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-content-top"></div>
            <div class="menu-content-mid">
                <ul>
                    <li>Online players</li>
                    <li>Status: <?php getServerStatus(); ?></li>
                    <li>Armory</li>
                    <li>How to</li>
                </ul>
            </div>
            <div class="menu-content-bot"></div>

            <a href="#">
                <div class="menu-item">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Community</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-content-top"></div>
            <div class="menu-content-mid">
                <ul>
                    <li>Forum</li>
                </ul>
            </div>
            <div class="menu-content-bot"></div>

            <a href="#">
                <div class="menu-item">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Media</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-content-top"></div>
            <div class="menu-content-mid">
                <ul>
                    <li>Gallery</li>
                </ul>
            </div>
            <div class="menu-content-bot"></div>

            <a href="#">
                <div class="menu-item">
                    <div class="news-icon"></div>
                    <div class="plus-icon"></div>
                    <span class="menu-text">Site</span>
                    <div class="menu-item-add"></div>
                </div>
            </a>
            <div class="menu-content-top"></div>
            <div class="menu-content-mid">
                <ul>
                    <li>Administration</li>
                </ul>
            </div>
            <div class="menu-content-bot"></div>
        </div>
    </div>
</div>

<!-- TODO: ADD PAGE CONTENT HERE -->
<!--<div class="midContent">-->
<!--    <div class="container">-->
<!--        --><?php
//        include 'page.php';
//        ?>
<!--    </div>-->
<!--</div>-->