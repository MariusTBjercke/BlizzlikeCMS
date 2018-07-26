<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'post':
            include 'post.php';
            break;
    }
} else {
    include 'home.php';
}
?>
