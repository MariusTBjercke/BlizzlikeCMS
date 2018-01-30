<?php

class Account {
    public $user_id;
    public $username;
    public $email;
    public $lastLogin;
    public $last_ip;
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

    public function retrieveAccount() {
        global $mysqli_auth;
        $user_id = $this->user_id;

        $result = $mysqli_auth->query("SELECT * FROM account WHERE id='$user_id'");
        $result2 = $mysqli_auth->query("SELECT * FROM account_access WHERE id='$user_id'");
        $row = $result->fetch_assoc();
        $row2 = $result2->fetch_assoc();

        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->lastLogin = $row['last_login'];
        $this->last_ip = $row['last_ip'];
        $this->gmlevel = $row2['gmlevel'];
        $this->expansion = $row['expansion'];
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

    public function getExpansion() {
        $expansion = $this->expansion;
        return $expansion;
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

}