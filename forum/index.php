<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'post':
            include 'post.php';
            break;
        case 'topic':
            include 'topic.php';
            break;
        case 'create_topic':
            include 'create_topic.php';
            break;
    }
} else {
    include 'home.php';
}
?>
