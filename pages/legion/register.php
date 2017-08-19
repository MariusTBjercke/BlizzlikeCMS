<div class="register-page">

    <div class="register-content">

        <div class="register-gnome"></div>

        <h2>Create a new account</h2>
        <p>Fill out the form below in order to create a new account</p>

        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="username" placeholder="Username (No email, no spaces)"
                       name="username" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password1"
                       placeholder="Password (Minimum 6 characters)" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password2"
                       placeholder="Confirm the password" required>
            </div>
            <div class="form-group">
                <?php
                $recaptcha = rand(10000, 20000);
                echo '<div class="reCaptcha-box">' . $recaptcha . '</div>';
                ?>
                <input type="hidden" name="recaptcha_control" value="<?php echo $recaptcha ?>">
                <input type="text" class="form-control" id="recaptcha" name="recaptcha"
                       placeholder="Type in the characters above" required>
            </div>
            <input type="submit" class="btn btn-default" name="submit" value="Register account">
        </form>

    </div>

</div>