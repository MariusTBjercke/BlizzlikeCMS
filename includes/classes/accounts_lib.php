<?php

class Account {
    public $user_id;
    public $username;
    public $email;
    public $lastLogin;
    public $last_ip;
    public $avatar_id;
    public $gmlevel;
    public $expansion;

    public function __construct($user_id) {
        $this->user_id = $user_id;
    }

    public function validateUser($username, $password) {
        global $mysqli_auth;
        $query = "SELECT * FROM account WHERE username='$username' AND sha_pass_hash = SHA1(UPPER('$username:$password'))";
        $result = $mysqli_auth->query($query);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPassword($sha_pass_hash) {
        global $mysqli_auth;

    }

    public function retrieveAccount() {
        global $mysqli_auth;
        global $mysqli_cms;
        $user_id = $this->user_id;

        $result = $mysqli_auth->query("SELECT * FROM account WHERE id='$user_id'");
        $result2 = $mysqli_auth->query("SELECT * FROM account_access WHERE id='$user_id'");
        $result3 = $mysqli_cms->query("SELECT * FROM avatars WHERE user_id='$user_id'");
        $row = $result->fetch_assoc();
        $row2 = $result2->fetch_assoc();
        $row3 = $result3->fetch_assoc();

        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->lastLogin = $row['last_login'];
        $this->last_ip = $row['last_ip'];
        $this->gmlevel = $row2['gmlevel'];
        $this->expansion = $row['expansion'];
        $this->avatar_id = $row3['avatar_id'];
    }

    public function checkIfLoggedIn() {
        if (isset($_SESSION['user_logged_n'])) {
            if ($_SESSION['user_logged_n'] == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getName() {
        $username = $this->username;
        return $username;
    }

    public function getEmail() {
        $email = $this->email;
        return $email;
    }

    public function getLastLogin() {
        $lastLogin = $this->lastLogin;
        return $lastLogin;
    }

    public function getLastIP() {
        $last_ip = $this->last_ip;
        return $last_ip;
    }

    public function getGmLevel() {
        $gmlevel = $this->gmlevel;
        return $gmlevel;
    }

    public function getHighestLevel() {
        global $mysqli;

        $query = "SELECT * FROM characters WHERE account = '$this->user_id' ORDER BY level DESC LIMIT 1";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $level = $row['level'];
        if ($level > 0) {
            return $level;
        } else {
            return '0';
        }
    }

    public function getRole() {
        $gmlevel = $this->gmlevel;
        switch ($gmlevel) {
            case 0:
                return "Player";
                break;
            case 1:
                return "Gamemaster";
                break;
            case 2:
                return "Moderator";
                break;
            case 3:
                return '<span class="role-admin">Administrator</span>';
                break;
        }
    }

    public function getExpansion() {
        $expansion = $this->expansion;
        return $expansion;
    }

    public function getAvatarID() {
        $avatar_id = $this->avatar_id;
        return $avatar_id;
    }

    public function saveDetails($username, $email, $gmlevel, $expansion) {
        global $mysqli_auth;
        $user_id = $this->user_id;

        $result = $mysqli_auth->query("UPDATE account SET username='$username', email='$email', expansion='$expansion' WHERE id='$user_id'");
        $result2 = $mysqli_auth->query("INSERT INTO account_access (id, gmlevel, RealmID) VALUES ('$user_id', '$gmlevel', '1') ON DUPLICATE KEY UPDATE gmlevel='$gmlevel'");

        if ($result && $result2) {
            return true;
        } else {
            return false;
        }

    }

    public function saveAvatarID($user_id, $avatar_id) {
        global $mysqli_cms;

        $query = "INSERT INTO avatars (user_id, avatar_id) VALUES ('$user_id', '$avatar_id') ON DUPLICATE KEY UPDATE avatar_id='$avatar_id'";
        $result = $mysqli_cms->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }

    }

}