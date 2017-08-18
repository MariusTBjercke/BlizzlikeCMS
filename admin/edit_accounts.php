<?php
$acc_id = $_GET['id'];
$account = new Account($acc_id);
$account->retrieveAccount();

$pagenum = 1;
if(!empty($_GET['pagenum'])) {
    $pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
    if(false === $pagenum) {
        $pagenum = 1;
    }
}

if (isset($_POST['accsave_submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gmlevel = $_POST['gmlevel'];
    $expansion = $_POST['expansion'];

    if ($account->saveDetails($username, $email, $gmlevel, $expansion) == true) {
        echo '<script>alert("The details have been saved.");</script>';
        echo '<script>history.back(1);</script>';
    } else {
        echo '<script>alert("Something went wrong, please try again.");</script>';
        echo '<script>history.back(1);</script>';
    }
}

if ($_GET['edit'] == 1) {
    $url = $_SERVER['REQUEST_URI'];
    $newString = substr($url, 0, -7);
    $getInfo = $newString;
} else {
    $getInfo = 'admin.php?' . $_SERVER["QUERY_STRING"] . '&edit=1';
}
?>

<h1>Edit accounts</h1>
<?php
if ($_GET['edit'] == 1) {
    ?>
    <button onclick="window.location='admin.php?page=edit_accounts';">Go back</button>
    <?php
} else {
    ?>
    <button onclick="window.location='admin.php';">Go back</button>
    <?php
}
?>

<?php

if ($_GET['action'] == 'edit') {
    ?>
    <div class="edit_account">
        <h2>Account details <?php if ($_GET['edit'] != 1) { ?><a href="<?php echo $getInfo; ?>">Edit</a><?php } else
            { ?><a href="<?php echo $getInfo; ?>">Cancel</a><?php } ?></h2>
        <form action="" method="post">
    <?php
    echo '<p><label>Username:</label> ' . $account->getName() . '</p>';
    if ($_GET['edit'] == 1) {
        echo '<p><input type="text" value="' . $account->getName() . '" name="username"></p>';
    }
    echo '<p><label>Email:</label> ' . $account->getEmail() . '</p>';
    if ($_GET['edit'] == 1) {
        echo '<p><input type="text" value="' . $account->getEmail() . '" name="email"></p>';
    }
    echo '<p><label>GM Level:</label> ' . $account->getGmLevel() . '</p>';
    if ($_GET['edit'] == 1) {
        echo '<p><select name="gmlevel">';
        if (empty($account->getGmLevel())) {
            echo '<option value="0">0</option>';
		} else {
			echo '<option value="' . $account->getGmLevel() . '">' . $account->getGmLevel() . '</option>';
		}
		echo '
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select></p>';
    }
    echo '<p><label>Expansion:</label> ' . $account->getExpansion() . '</p>';
    if ($_GET['edit'] == 1) {
        echo '<p><select name="expansion">
<option value="' . $account->getExpansion() . '">' . $account->getExpansion() . '</option>
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select></p>';
    }
    echo '<p><label>Last login:</label> ' . $account->getLastLogin() . '</p>';
    echo '<p><label>Last IP:</label> ' . $account->getLastIP() . '</p>';
    if ($_GET['edit'] == 1) {
        echo '<p><input type="submit" name="accsave_submit" value="Save details">';
    }
    ?>
        </form>
    </div>
    <?php
} else {
    $admin = new Admin();
    $admin->listAccounts($pagenum);
}

?>