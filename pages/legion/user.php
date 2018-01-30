<?php
$account = new Account($_SESSION['user_id']);
$account->retrieveAccount();
?>

<div class="user_page">

    <h1>Welcome, <?php echo $account->getName(); ?></h1>
    <h3>This is your user page.</h3>

    <p>This is still a work in progress..</p>

</div>