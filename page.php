<?php

switch($page) {
    case "home":
        include 'pages/index.php';
        break;
    case "register":
        include 'pages/register.php';
        break;
    case "howto":
        include 'pages/howto.php';
        break;
    case "onlineplayers":
        include 'pages/onlineplayers.php';
        break;
    case "videos":
        include 'pages/videos.php';
        break;
    case "gamemasters":
        include 'pages/gamemasters.php';
        break;
    case "armory":
        include 'pages/armory.php';
        break;
    case "admin":
        include 'admin/index.php';
        break;
    case "install":
        include 'pages/install.php';
        break;
    case "404":
        include 'pages/404.php';
        break;
}

?>
