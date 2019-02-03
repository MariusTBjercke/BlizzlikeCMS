<?php
session_start();
$page = 'register';
$title = 'Register: ';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/classes/forum_lib.php';
include 'includes/classes/events_lib.php';
include 'header.php';
if (isset($_POST['submit'])) {

	$username = addslashes(trim($_POST['username']));
	$email = strtoupper(addslashes(trim($_POST['email'])));
	$password1 = addslashes(trim($_POST['password1']));
	$password2 = addslashes(trim($_POST['password2']));
	$recaptcha = addslashes(trim($_POST['recaptcha']));
	$recaptcha_control = addslashes(trim($_POST['recaptcha_control']));

	$username_check = $mysqli_auth->query("SELECT * from account WHERE username = '$username'");
	if (($username_check->num_rows) > 0) {
		echo '<script>alert("The username is already taken. Please try again.");</script>';
		echo '<script>history.back(1);</script>';
		exit;
	} else {}

	$email_check = $mysqli_auth->query("SELECT * from account WHERE email = '$email'");
	if (($username_check->num_rows) > 0) {
		echo '<script>alert("The email is already taken. Please try again.");</script>';
		echo '<script>history.back(1);</script>';
		exit;
	} else {}

	if ($recaptcha == $recaptcha_control) {} else {
		echo '<script>alert("You did not pass the anti-bot. Please try again.");</script>';
		echo '<script>history.back(1);</script>';
		exit;
	}

	if ($password1 == $password2) {} else {
		echo '<script>alert("The passwords did not match. Please try again.");</script>';
		echo '<script>history.back(1);</script>';
		exit;
	}

	if (strlen($password1) < 6) {
		echo '<script>alert("The password is too short. Please try again.");</script>';
		echo '<script>history.back(1);</script>';
		exit;
	}

	// Check if the auth database has a Battle.net table in it
    $tableCheck = $mysqli_auth->query("SHOW TABLES LIKE 'battlenet_accounts'");
	if ($tableCheck->num_rows == 1) {

        // Insert Battle.net info
        $bnetHash = bin2hex(strrev(hex2bin(strtoupper(hash("sha256",strtoupper(hash("sha256", strtoupper($email)).":".strtoupper($password1)))))));
        $bnetQueryResult = $mysqli_auth->query("INSERT INTO battlenet_accounts (email, sha_pass_hash) VALUES ('$email', '$bnetHash')");
        $bnetacc = $mysqli_auth->insert_id;

        $findIDQuery = "SELECT * FROM battlenet_accounts WHERE sha_pass_hash='$bnetHash'";
        $findIDResult = $mysqli_auth->query($findIDQuery);
        $username = $bnetacc."#1";

        $result = $mysqli_auth->query("INSERT INTO account (username, email, reg_mail, sha_pass_hash, battlenet_account, battlenet_index) VALUES ('$username', '$email', '$email', SHA1(UPPER('$username:$password1')), '$bnetacc', '1')");
        echo '<script>alert("Your account has been created! You may now log in.");</script>';
        echo '<script>window.location="howto.php";</script>';

	} else {

        $result = $mysqli_auth->query("INSERT INTO account (username, email, sha_pass_hash) VALUES ('$username', '$email', SHA1(UPPER('$username:$password1')))");
        echo '<script>alert("Your account has been created! You may now log in.");</script>';
        echo '<script>window.location="howto.php";</script>';

    }

}
include 'footer.php';
?>