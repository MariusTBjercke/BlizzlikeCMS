<?php
session_start();
$page = 'register';
$title = 'Register: ';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/classes/accounts_lib.php';
include 'includes/classes/forum_lib.php';
include 'includes/classes/events_lib.php';
include 'header.php';
if (isset($_POST['submit'])) {

	$username = strtoupper(addslashes(trim($_POST['username'])));
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

    function CalculateSRP6Verifier($username, $password, $salt)
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

    // generate a random salt
    $salt = random_bytes(32);

    // calculate verifier using this salt
    $verifier = CalculateSRP6Verifier($username, $password1, $salt);

    // done - this is what you put in the account table!
    $newSalt = $salt;
    $newVerifier = $verifier;

    $result = $mysqli_auth->query("INSERT INTO account (username, email, salt, verifier) VALUES ('$username', '$email', '$newSalt', '$newVerifier')");
    echo '<script>alert("Your account has been created! You may now log in.");</script>';
    echo '<script>window.location="howto.php";</script>';
}
include 'footer.php';
?>