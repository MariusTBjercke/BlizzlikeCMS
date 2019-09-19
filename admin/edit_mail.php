<?php
global $mysqli_cms;
if (isset($_POST['save_submit'])) {
    $mailServer = addslashes(trim($_POST['mail_server']));
    $mailPort = addslashes(trim($_POST['mail_port']));
    $mailAuth = addslashes(trim($_POST['mail_authentication']));

    if ($mailAuth == 'Yes') {
        $mailAuth = '1';
    } else {
        $mailAuth = '0';
    }

    $result = $mysqli_cms->query("UPDATE config SET mail_server='$mailServer', mail_port='$mailPort', mail_authentication='$mailAuth' WHERE id='1'");
    echo '<script>window.location="admin.php?page=edit_mail&action=success";</script>';
    exit;
}

$result = $mysqli_cms->query("SELECT * FROM config");
$row = $result->fetch_assoc();

function requiresAuth($bool) {
    if ($bool == 0) {
        $result = [
            'Correct' => 'No',
            'False' => 'Yes'
        ];
        return $result;
    } else {
        return 'Yes';
    }
}
?>

<div class="edit_settings">

    <h1>Edit Mail Settings</h1>
    <button onclick="window.location='admin.php';">Go back</button>

    <p>You can leave these empty, but if you don't, the settings will be sat to the configurations here.</p>

    <ul>
        <?php
        if ($_GET['action'] == 'edit') {
            $edit_settings = true;
                ?>
                <?php
                echo '<form action="" method="post">';
                echo '<p><li><label>Server address:</label> <input type="text" name="mail_server" value="' . $row['mail_server'] . '"></li></p>';
                echo '<p><li><label>Port:</label> <input type="text" name="mail_port" value="' . $row['mail_port'] . '"></li></p>';
                echo '<p><li><label>Requires authentication?</label><br><select name="mail_authentication"><option value="' . requiresAuth($row['mail_authentication'])['Correct'] . '">' . requiresAuth($row['mail_authentication'])['Correct'] . '</option><option value="'. requiresAuth($row['mail_authentication'])['False'] .'">'. requiresAuth($row['mail_authentication'])['False'] .'</option></select></li></p>';
                echo '<p><input type="submit" name="save_submit" value="Save">';
                echo '</form>';
        } else {
                ?>
                <?php
                echo '<p><li><label>Server address:</label> ' . $row['mail_server'] . '</li></p>';
                echo '<p><li><label>Port:</label> ' . $row['mail_port'] . '</li></p>';
                echo '<p><li><label>Requires authentication?</label><br>' . requiresAuth($row['mail_authentication'])['Correct'] . '</li></p>';
        }
        ?>
    </ul>

    <?php

    if ($_GET['action'] == 'success') {
        echo '<div class="success">The details have been saved.</div>';
    }

    ?>

    <?php
    if ($_GET['action'] == 'edit') {
        ?>
        <p><button onclick="javascript:window.location='admin.php?page=edit_mail';">Cancel editing</button></p>
        <?php
    } else {
        ?>
        <p><button onclick="javascript:window.location='admin.php?page=edit_mail&action=edit';">Edit settings</button></p>
        <?php
    }
    ?>

</div>
