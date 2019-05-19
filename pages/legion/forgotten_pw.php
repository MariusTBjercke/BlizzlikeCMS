<?php
if (isset($_POST['submit'])) {
    global $mysqli_auth;
    $email = addslashes(trim($_POST['email']));

    $query = "SELECT * FROM account WHERE email='$email'";
    $result = $mysqli_auth->query($query);
    $fetch = $result->fetch_assoc();
    $acc_id = $fetch['id'];
    $sha_pass_hash = $fetch['sha_pass_hash'];

    $account = new Account($acc_id);
    $account->resetPassword($sha_pass_hash);
}

?>

<div class="user_login">

    <h1>Forgotten your password?</h1>
    <h3>Please enter the e-mail address associated with your account</h3>

    <div class="card card-container">

        <form class="form-signin" name="forgottenPW" method="post" action="">
            <input type="text" id="inputEmail" class="login_box" placeholder="E-mail address" name="email" required autofocus>
            <?php

            if (isset($_GET['action'])) {
                if ($_GET['error'] == 1) {
                }
            }

            ?>
            <button class="btn btn-lg btn-primary login-btn" type="submit" name="submit"><i class="fa fa-sign-in"></i> Send me a reset link</button>
        </form>

    </div>

</div>