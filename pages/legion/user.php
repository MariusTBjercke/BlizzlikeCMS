<?php
$account = new Account($_SESSION['user_id']);
$account->retrieveAccount();
if ($account->checkIfLoggedIn() != true) {
    ?>
    <script>window.location="user_login.php";</script>
    <?php
}

// Avatar and thumbnail handler
if (isset($_FILES["file"])) {
    $tmpFile = $_FILES["file"]["tmp_name"];
    $time = time();
    // Path to avatar
    $target_file = 'img/avatars/' . $time . '.png';
    // Path to thumbnail
    $target_file_thumbnail = 'img/thumbnails/' . $time . '.png';
    move_uploaded_file($tmpFile, $target_file);

    // Resize the avatar
    $newFile = new Imagick($target_file);
    $newFile->writeImages($target_file, false);

    // Crops the avatar into a thumbnail
    $newThumb = new Imagick($target_file);
    $newThumb->clone();
    $newThumb->cropThumbnailImage('130', '130');
    $success = $newThumb->writeImages($target_file_thumbnail, false);

    if ($success) {
        $saveAcc = $account->saveAvatarID($_SESSION['user_id'], $time);
        if ($saveAcc) {
            echo '<script>window.location="user.php";</script>';
        }
    }
}

?>

<div class="user-profilepic-modal-bg">
    <div class="user-profilepic-modal">
        <h2>Change avatar</h2>
        <p>Upload a new avatar/profile picture.</p>
        <div class="avatar-upload-section">
            <form action="" enctype="multipart/form-data" method="post" id="imagick">
                <div class="fileUpload">
                    <input type="file" name="file" class="upload" id="file" />
                    <input type="submit" name="submit" id="submit" value="Upload">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="user_page">

    <div class="row">

        <div class="col-sm-6">

            <h1>Welcome, <?php echo $account->getName(); ?></h1>
            <p><a href="logout.php">Logout?</a></p>

            <p>Your Avatar</p>
            <?php
            $errors = 0;
            if (!extension_loaded('imagick')) {
                $errors = 1;
                echo '<span id="installed" style="color:#ab000e">Imagick PHP extension not installed, and the picture may not display properly.</span>';
            }
            ?>
            <div class="user-avatar">
                <div class="user-avatar-box"></div>
                <div class="change-avatar">
                    <span><a href="#" class="user-change-avatar">Change avatar?</a></span>
                </div>
                <?php
                if (empty($account->getAvatarID())) {
                    ?>
                    <img src="../../img/avatars/no-avatar.png" title="Avatar" alt="Avatar">
                    <?php
                } else {
                    echo '<img src="../../img/thumbnails/'.$account->getAvatarID().'.png" title="Avatar" alt="Avatar">';
                }
                ?>
            </div>

        </div>

        <div class="col-sm-6 text-right user-facts">
            <h1>Your facts:</h1>
            <ul>
                <li><span>Email: </span><?php echo $account->getEmail(); ?></li>
                <li><span>Last login: </span><?php echo $account->getLastLogin(); ?></li>
                <li><span>Last IP: </span><?php echo $account->getLastIP(); ?></li>
            </ul>
        </div>

    </div>

</div>