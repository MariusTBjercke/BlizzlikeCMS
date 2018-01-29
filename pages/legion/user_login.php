<?php
if (isset($_POST['submit'])) {
    $username = addslashes(trim($_POST['username']));
    $password = addslashes(trim($_POST['password']));

    $user = new User;
    if ($user->validateLogin($username, $password) == true) {



        echo '<script>window.location="user.php?action=success";</script>';
    } else {
        echo '<script>alert("Wrong username, password or access level. Please try again.");</script>';
    }
}

?>

<div class="user_login">

    <h1>User login</h1>
    <h3>In order to continue, you need to sign in.</h3>

    <div class="card card-container">

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
        <a href="register.php"><button class="btn btn-lg btn-primary register-btn">Register</button></a>

    </div>

</div>