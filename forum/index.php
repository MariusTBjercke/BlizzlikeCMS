<?php
if ($_SESSION['user_logged_n'] == true) {
    $page = $_GET['page'];
    switch ($page) {
        case 'edit_accounts':
            include 'edit_accounts.php';
            break;
    }
} else {
    include 'home.php';
}
?>
