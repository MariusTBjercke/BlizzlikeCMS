<?php
if ($_SESSION['admin_logged_n'] == true) {
    $page = $_GET['page'];
    switch ($page) {
        case 'edit_accounts':
            include 'edit_accounts.php';
            break;
        case 'edit_posts':
            include 'edit_posts.php';
            break;
		case 'edit_settings':
			include 'edit_settings.php';
			break;
		case 'edit_gallery':
			include 'edit_gallery.php';
			break;
        case 'edit_theme':
            include 'edit_theme.php';
            break;
        default:
            include 'home.php';
            break;
    }
} else {
    include 'login.php';
}
?>
