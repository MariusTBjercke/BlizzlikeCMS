<?php
if (isset($_POST['submit'])) {
    $username = addslashes(trim($_POST['username']));
    $password = addslashes(trim($_POST['password']));

    global $mysqli_auth;
    $query = "SELECT * FROM account WHERE username='$username'";
    $result = $mysqli_auth->query($query);
    $fetch = $result->fetch_assoc();
    $acc_id = $fetch['id'];

    $account = new Account($acc_id);
    if ($account->validateUser($username, $password) == true) {
        $_SESSION['user_logged_n'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $acc_id;
        echo '<script>window.location="user.php?action=success";</script>';
    } else {
        echo '<script>alert("Wrong username or password, please try again.");</script>';
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