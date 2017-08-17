<?php
if (isset($_POST['submit'])) {
    $username = addslashes(trim($_POST['username']));
    $password = addslashes(trim($_POST['password']));

    $admin = new Admin;
    if ($admin->validateLogin($username, $password) == true) {
        $_SESSION['admin_logged_n'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['admin_id'] = $admin->getPosterId();
        echo '<script>window.location="admin.php?action=success";</script>';
    } else {
        echo '<script>alert("Wrong username, password or access level. Please try again.");</script>';
    }
}

?>

<h1>Administrator login</h1>
<h3>In order to continue, you need to sign in with an account with administrative privileges.</h3>

<div class="card card-container">

    <div class="lock-img"></div>

    <form class="form-signin" name="admLogin" method="post" action="">
        <span id="reauth-email" class="reauth-email"></span>
        <input type="text" id="inputEmail" class="login_box" placeholder="Username" name="username" required autofocus>
        <input type="password" name="password" id="inputPassword" class="login_box" placeholder="Password" required>
        <?php

        if (isset($_GET['action'])) {
            if ($_GET['error'] == 1) {

            }
        }

        ?>
        <button class="btn btn-lg btn-primary" type="submit" name="submit">Login</button>
    </form>

</div>