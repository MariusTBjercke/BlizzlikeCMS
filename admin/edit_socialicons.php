<?php
if (isset($_POST['save_submit'])) {
    $servername = addslashes(trim($_POST['servername']));
    $serveraddress = addslashes(trim($_POST['serveraddress']));
    $worldport = addslashes(trim($_POST['worldport']));
    $contact = addslashes(trim($_POST['contact']));
    $youtube = addslashes(trim($_POST['youtube']));
    $download = addslashes(trim($_POST['download']));
    if (isset($_POST['show_post_frontpage'])) {
        $check = 1;
    } else {
        $check = 0;
    }

    $result = $mysqli_cms->query("UPDATE config SET servername='$servername', serveraddress='$serveraddress', worldport='$worldport', show_post_frontpage='$check', contact='$contact', youtube='$youtube', download='$download' WHERE id='1'");
    echo '<script>window.location="admin.php?page=edit_settings&action=success";</script>';
    exit;
}

$result = $mysqli_cms->query("SELECT * FROM config");
?>

<div class="edit_settings">

    <h1>Edit website settings</h1>
    <button onclick="window.location='admin.php';">Go back</button>

    <ul>
        <?php
        if ($_GET['action'] == 'edit') {
            $edit_settings = true;
            while ($row = $result->fetch_assoc()) {
                ?>
                <?php
                echo '<form action="" method="post">';
                ?>
                <p>Use the first post as the front page header?</p>
                <input type="checkbox" name="show_post_frontpage" <?php if (($row['show_post_frontpage']) > 0) { echo 'checked'; } ?>>
                <?php
                echo '<p><li><label>Server name:</label> <input type="text" name="servername" value="' . $row['servername'] . '"></li></p>';
                echo '<p><li><label>Server address:</label> <input type="text" name="serveraddress" value="' . $row['serveraddress'] . '"></li></p>';
                echo '<p><li><label>World port:</label> <input type="text" name="worldport" value="' . $row['worldport'] . '"></li></p>';
                echo '<p><li><label>Contact mail:</label> <input type="text" name="contact" value="' . $row['contact'] . '"></li></p>';
                echo '<p><li><label>YouTube embed URL:</label> <input type="text" name="youtube" value="' . $row['youtube'] . '"></li></p>';
                echo '<p><li><label>Client download link:</label> <input type="text" name="download" value="' . $row['download'] . '"></li></p>';
                echo '<p><input type="submit" name="save_submit" value="Save">';
                echo '</form>';
            }
        } else {
            while ($row = $result->fetch_assoc()) {
                ?>
                <p>Use the first post as the front page header?</p>
                <?php
                if (($row['show_post_frontpage']) > 0) {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
                ?>
                <?php
                echo '<p><li><label>Server name:</label> ' . $row['servername'] . '</li></p>';
                echo '<p><li><label>Server address:</label> ' . $row['serveraddress'] . '</li></p>';
                echo '<p><li><label>World port:</label> ' . $row['worldport'] . '</li></p>';
                echo '<p><li><label>Contact mail:</label> ' . $row['contact'] . '</li></p>';
                echo '<p><li><label>YouTube embed URL:</label> ' . $row['youtube'] . '</li></p>';
                echo '<p><li><label>Client download link:</label> ' . $row['download'] . '</li></p>';
            }
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
        <p><button onclick="javascript:window.location='admin.php?page=edit_settings';">Cancel editing</button></p>
        <?php
    } else {
        ?>
        <p><button onclick="javascript:window.location='admin.php?page=edit_settings&action=edit';">Edit settings</button></p>
        <?php
    }
    ?>

</div>
