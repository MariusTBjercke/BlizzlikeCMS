<?php

class User
{

    public function __construct() {
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

}