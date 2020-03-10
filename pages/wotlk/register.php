<div class="register-page">

    <div class="register-content">

        <div class="register-dk"></div>

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
                <input type="password" class="form-control" id="password1" name="password1"
                       placeholder="Password (Minimum 6 characters)" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password2" name="password2"
                       placeholder="Confirm the password" required>
            </div>
            <div class="form-group">
                <?php
                $recaptcha = rand(10000, 20000);
                $rotate1 = substr($recaptcha, 0, 1);
                $rotate2 = substr($recaptcha, 1, 1);
                $rotate3 = substr($recaptcha, 2, 1);
                $rotate4 = substr($recaptcha, 3, 1);
                $rotate5 = substr($recaptcha, 4, 1);
                echo '<span class="reCaptcha-box"><span class="rotateNumber1">' . $rotate1 . '</span><span class="rotateNumber2">' . $rotate2 . '</span><span class=" rotateNumber3">' . $rotate3 . '</span><span class="rotateNumber4">' . $rotate4 . '</span><span class="rotateNumber5">' . $rotate5 . '</span></div>';
                ?>
                <input type="hidden" name="recaptcha_control" value="<?php echo $recaptcha ?>">
                <input type="text" class="form-control" id="recaptcha" name="recaptcha"
                       placeholder="Type in the characters above" required>
            </div>
            <input type="submit" class="btn btn-default register-submit" name="submit" value="Register account">
        </form>

    </div>

</div>