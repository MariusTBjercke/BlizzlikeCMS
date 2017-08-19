<?php
$result = $mysqli->query("SELECT * FROM characters WHERE online='1'");
$activeplayersResult = $mysqli->query("SELECT * FROM characters");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="Fast and stable Wrath of the Lich King (3.3.5a) private server with blizzlike
    rates - go back to the good old days and enjoy the game in it's most glorious days.">
    <meta name="keywords" content="World of Wacraft, wow, wotlk, wrath, of, the, lich, king, wrath of the lich king,
    335a, 3.3.5a, stable, fast, private, server, blizzlike">
	<title><?php if($title) { echo $title; } echo $servername; ?></title>
    <link rel="shortcut icon" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="min/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="min/main.min.css">
	<link rel="stylesheet" type="text/css" href="min/<?php echo $theme_name; ?>.min.css">
    <link rel="stylesheet" type="text/css" href="includes/featherlight/featherlight.min.css">
    <link href="https://fonts.googleapis.com/css?family=Zilla+Slab" rel="stylesheet">
    <?php
    if (isset($_SESSION['headers'])) {
        $headers = $_SESSION['headers'];
        foreach ($headers as $header) {
            echo $header;
        }
    }
    ?>
</head>
<body>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-55335908-4', 'auto');
    ga('send', 'pageview');

</script>

<div class="top-bar"></div>

<div class="page-bg-top">
    <div class="container">
        <div class="murloc_speechubble">
            <div class="speechbubble_content">Rwlrwl! (Hello!)</div>
        </div>
        <a href="index.php" title="<?php echo $servername; ?>"><div class="top-logo"></div></a>
    </div>
</div>

<div class="container">

    <div id="ne-top-left"></div>
    <div id="ne-center"></div>
    <div id="bg-right"></div>
    <div class="statue-left"></div>

    <div class="left-block">
        <div class="menu-bg"></div>
    </div>

    <div class="left-sidebar">

        <div class="left-menuHeader">
            <div class="left-menuHeader-icon"></div>
            <div class="left-menuHeader-font">Navigation</div>
        </div>
        <div class="left-menuContent">
            <ul>
                <li><a href="index.php" title="Go back to the home page">Home</a></li>
                <?php if (strlen($wotlk_downloadlink) > 0) { echo '<li><a href="' . $wotlk_downloadlink . '" title="Download the WotLK 3.3.5a client">Download game</a></li>'; } else {} ?>
            </ul>
        </div>

        <div class="left-menuHeader">
            <div class="left-menuHeader-icon"></div>
            <div class="left-menuHeader-font">Account</div>
        </div>
        <div class="left-menuContent">
            <ul>
                <li><a href="register.php" title="Create a new account">Create account</a></li>
                <li class="disabled">Manage account</li>
            </ul>
        </div>

        <div class="left-menuHeader">
            <div class="left-menuHeader-icon"></div>
            <div class="left-menuHeader-font">Server</div>
        </div>
        <div class="left-menuContent">
            <ul>
                <li><a href="onlineplayers.php" title="See a list of online players">Online players</a></li>
                <li><a href="#">Server status: </a><?php getServerStatus() ?></li>
                <li><a href="gamemasters.php">Gamemasters</a></li>
                <li><a href="howto.php" title="A guide on how to connect to the server">How to connect</a></li>
                <li><a href="armory.php" title="Browse through the all characters">Armory (Beta)</a></li>
            </ul>
        </div>

        <div class="left-menuHeader">
            <div class="left-menuHeader-icon"></div>
            <div class="left-menuHeader-font">Media</div>
        </div>
        <div class="left-menuContent">
            <ul>
                <li><a href="gallery.php">Gallery</a></li>
            </ul>
        </div>

        <div class="left-menuHeader">
            <div class="left-menuHeader-icon"></div>
            <div class="left-menuHeader-font">Site</div>
        </div>
        <div class="left-menuContent">
            <ul>
                <li><a href="admin.php">Administration</a></li>
            </ul>
        </div>

    </div>

    <div class="midContent">
        <div class="midContent-left-bar"></div>
        <div class="parchment-left"></div>

        <div class="midContent-mid">
            <div class="parchment-top">
                <div class="parchment-left-top-corner"></div>
                <div class="parchment-right-top-corner"></div>
            </div>

            <div class="midContent-content">
            <?php
            include 'page.php';
            ?>
            </div>

        </div>

        <div class="parchment-right"></div>
        <div class="midContent-right-bar"></div>
        <div class="clear"></div>
    </div>

</div>