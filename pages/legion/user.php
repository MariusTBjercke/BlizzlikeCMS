<?php
$account = new Account($_SESSION['user_id']);
$account->retrieveAccount();
?>

<div class="user-profilepic-modal-bg">
    <div class="user-profilepic-modal">
        <h2>Change avatar</h2>
        <p>Upload a new avatar/profile picture.</p>
        <div class="avatar-upload-section">
            <form action="" enctype="multipart/form-data" method="post" id="imagick">
                <div class="fileUpload">
                    <input type="file" name="file" class="upload" id="upload" />
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

            <p>Your Avatar</p>
            <div class="user-avatar">
                <div class="user-avatar-box"></div>
                <div class="change-avatar">
                    <span><a href="#" class="user-change-avatar">Change avatar?</a></span>
                </div>
                <img src="../../img/avatars/no-avatar.png" alt="Avatar">
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