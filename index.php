<?php
$page = 'home';
$title = 'Home: ';
include 'includes/config.php';

if ($installed == false) {
    echo '<script>window.location="install.php";</script>';
}

include 'includes/functions.php';
include 'includes/classes/site_lib.php';
include 'header.php';
$result = $mysqli->query("SELECT * FROM characters WHERE online='1'");
include 'footer.php';
?>