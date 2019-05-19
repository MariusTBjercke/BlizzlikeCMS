<?php

$theme = $theme_name;

switch($page) {
    case "home":
        include 'pages/' . $theme_name . '/index.php';
        break;
    case "register":
        include 'pages/' . $theme_name . '/register.php';
        break;
    case "howto":
        include 'pages/' . $theme_name . '/howto.php';
        break;
    case "onlineplayers":
        include 'pages/' . $theme_name . '/onlineplayers.php';
        break;
    case "videos":
        include 'pages/' . $theme_name . '/videos.php';
        break;
    case "gamemasters":
        include 'pages/' . $theme_name . '/gamemasters.php';
        break;
    case "armory":
        include 'pages/' . $theme_name . '/armory.php';
        break;
	case "gallery":
		include 'pages/' . $theme_name . '/gallery.php';
		break;
    case "forum":
        include 'forum/index.php';
        break;
    case "userlogin":
        include 'pages/' . $theme_name . '/user_login.php';
        break;
    case "forgottenpw":
        include 'pages/' . $theme_name . '/forgotten_pw.php';
        break;
    case "user":
        include 'pages/' . $theme_name . '/user.php';
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
