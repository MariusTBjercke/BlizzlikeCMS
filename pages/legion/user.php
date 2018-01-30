<?php
$account = new Account($_SESSION['user_id']);
$account->retrieveAccount();
?>

<div class="user_page">

    <h1>Welcome, <?php echo $account->getName(); ?></h1>

    <p>Avatar (Hover to change)</p>
    <div class="user-avatar">
        <div class="change-avatar">
            <span><a href="#">Change avatar?</a></span>
        </div>
        <img src="../../img/avatars/no-avatar.png" alt="Avatar">
    </div>

</div>