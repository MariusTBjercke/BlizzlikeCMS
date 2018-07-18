<?php

class Admin {

    public $admin_id;

    public function __construct() {
    }

    public function validateLogin($username, $password) {
        global $mysqli_auth;

        $query = $mysqli_auth->query("SELECT * FROM account WHERE username = '$username' and sha_pass_hash = SHA1(UPPER('$username:$password'))");
        $fetch = $query->fetch_assoc();
        $acc_id = $fetch['id'];
        $this->admin_id = $acc_id;
        $query2 = $mysqli_auth->query("SELECT * FROM account_access WHERE gmlevel = 3 AND id='$acc_id'");
        $num = $query->num_rows;
        $num2 = $query2->num_rows;
        if ($num > 0 && $num2 > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPosterId() {
        return $this->admin_id;
    }

    public function listAccounts($pagenum) {
        global $mysqli_auth;

        $rowResult = $mysqli_auth->query("SELECT * FROM account");
        $totalNum = $rowResult->num_rows;
        $items_per_page = 10;
        $start = ($pagenum * $items_per_page) - $items_per_page;
        $endpage = ceil($totalNum/$items_per_page);
        $nextpage = $pagenum + 1;
        $previouspage = $pagenum - 1;

        $result = $mysqli_auth->query("SELECT * FROM account ORDER BY id DESC LIMIT " . $start . ", " .
            $items_per_page);
        $getInfo = $_SERVER["QUERY_STRING"];

        echo '<div class="playerList">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="adm-player-row"><a href="admin.php?' . $getInfo . '&action=edit&id=' . $row['id'] . '">' .
                $row['username'] . '</a></div><br />';
        }

        echo '<div class="edit_account_pagination"><ul>';

        echo 'Page ' . $pagenum . ' of  ' . $endpage . '<br/><br/>';

        if ($pagenum >= 2) {
            echo '<li class="strong"><a href="admin.php?page=edit_accounts&pagenum=' . $previouspage . '">Previous</a></li>';
        }
        if ($pagenum != $endpage) {
            echo '<li class="strong"><a href="admin.php?page=edit_accounts&pagenum=' . $nextpage . '">Next</a></li>';
        }

        echo '</ul></div></div>';
    }

    public function showPosts($pagenum) {
        global $mysqli_cms;

        $rowResult = $mysqli_cms->query("SELECT * FROM posts");
        $totalNum = $rowResult->num_rows;
        $items_per_page = 5;
        $start = ($pagenum * $items_per_page) - $items_per_page;
        $endpage = ceil($totalNum/$items_per_page);
        $nextpage = $pagenum + 1;
        $previouspage = $pagenum - 1;

        $result = $mysqli_cms->query("SELECT * FROM posts ORDER BY id DESC LIMIT " . $start . ", " . $items_per_page);
        $getInfo = $_SERVER["QUERY_STRING"];

        echo '<div class="posts_list">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="post-row"><a href="admin.php?' . $getInfo . '&action=edit&id=' . $row['id'] . '">' .
                $row['title'] . '</a> | 
<a href="#" class="delete" onclick="confirmDelete(' . $row['id'] . ')">Delete</a></div><br />';
        }

        echo '<div class="edit_posts_pagination"><ul>';
        echo 'Page ' . $pagenum . ' of ' . $endpage . '<br/><br/>';
        if ($pagenum >= 2) {
            echo '<li class="strong"><a href="admin.php?page=edit_posts&pagenum=' . $previouspage . '">Previous</a></li>';
        }
        if ($pagenum != $endpage) {
            echo '<li class="strong"><a href="admin.php?page=edit_posts&pagenum=' . $nextpage . '">Next</a></li>';
        }
        echo '</ul></div></div>';

    }

    public function getPostById($post_id) {
        global $mysqli_cms;

        $result = $mysqli_cms->query("SELECT * FROM posts WHERE id='$post_id'");
        $row = $result->fetch_assoc();
    }

    public function addPost($title, $content) {
        global $mysqli_cms;

        $today = date("d-m-Y");
        $poster_id = $_SESSION['admin_id'];
        $result = $mysqli_cms->query("INSERT INTO posts (title, content, poster_id, date) VALUES ('$title', '$content', '$poster_id', '$today')");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function sayHello() {
        return 'Hello!';
    }

}

?>