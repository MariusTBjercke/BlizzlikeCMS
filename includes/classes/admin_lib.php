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
        $query2 = $mysqli_auth->query("SELECT * FROM account_access WHERE SecurityLevel = 3 AND id='$acc_id'");
        $num = $query->num_rows;
        $num2 = $query2->num_rows;
        if ($num > 0 && $num2 > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function CalculateSRP6Verifier($username, $password, $salt)
    {
        // algorithm constants
        $g = gmp_init(7);
        $N = gmp_init('894B645E89E1535BBDAD5B8B290650530801B18EBFBF5E8FAB3C82872A3E9BB7', 16);

        // calculate first hash
        $h1 = sha1(strtoupper($username . ':' . $password), TRUE);

        // calculate second hash
        $h2 = sha1($salt.$h1, TRUE);

        // convert to integer (little-endian)
        $h2 = gmp_import($h2, 1, GMP_LSW_FIRST);

        // g^h2 mod N
        $verifier = gmp_powm($g, $h2, $N);

        // convert back to a byte array (little-endian)
        $verifier = gmp_export($verifier, 1, GMP_LSW_FIRST);

        // pad to 32 bytes, remember that zeros go on the end in little-endian!
        $verifier = str_pad($verifier, 32, chr(0), STR_PAD_RIGHT);

        // done!
        return $verifier;
    }

    public function VerifySRP6Login($username, $password, $salt, $verifier)
    {
        global $mysqli_auth;

        // re-calculate the verifier using the provided username + password and the stored salt
        $checkVerifier = $this->CalculateSRP6Verifier($username, $password, $salt);

        $query = $mysqli_auth->query("SELECT * FROM account WHERE username = '$username'");
        $fetch = $query->fetch_assoc();
        $acc_id = $fetch['id'];
        $this->admin_id = $acc_id;
        $query2 = $mysqli_auth->query("SELECT * FROM account_access WHERE SecurityLevel = 3 AND AccountID='$acc_id'");
        $num = $query->num_rows;
        $num2 = $query2->num_rows;

        // compare it against the stored verifier
        if (($verifier === $checkVerifier) && ($num2 > 0)) {
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

        // Sanitize
        $title = $mysqli_cms->real_escape_string($title);
        $content = $mysqli_cms->real_escape_string($content);

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