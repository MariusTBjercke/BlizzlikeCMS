<?php
session_start();
$page = 'admin';
$title = 'Admin: ';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/classes/admin_lib.php';
include 'includes/classes/accounts_lib.php';
include 'includes/classes/posts_lib.php';
include 'includes/classes/forum_lib.php';
include 'header.php';
include 'footer.php';
?>