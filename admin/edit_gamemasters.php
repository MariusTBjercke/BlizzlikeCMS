<?php
if (isset($_POST['submit'])) {
    $charname = addslashes(trim($_POST['charname']));

    $result = $mysqli_cms->query("INSERT INTO gamemasters (charname) VALUES ('$charname')");
    echo '<script>window.location="admin.php?page=edit_gamemasters&action=addsuccess";</script>';
    exit;
}

if ($_GET['action'] == 'delete') {
    $gm_id = $_GET['id'];
    $result = $mysqli_cms->query("DELETE FROM gamemasters WHERE id='$gm_id'");
    echo '<script>window.location="admin.php?page=edit_gamemasters&action=delsuccess";</script>';
    exit;
}

$result = $mysqli_cms->query("SELECT * FROM gamemasters");
?>

<div class="edit_gamemasters">

    <h1>Edit Gamemasters</h1>
    <button onclick="window.location='admin.php';">Go back</button>

    <ul>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo '<li>' . $row['charname'] . ' <a href="admin.php?page=edit_gamemasters&action=delete&id=' . $row['id'] . '">Delete</a> </li>';
    }
    ?>
    </ul>
    <?php

    if ($_GET['action'] == 'addsuccess') {
        echo '<div class="addsuccess">Added!</div>';
    } else if ($_GET['action'] == 'delsuccess') {
        echo '<div class="delsuccess">Deleted!</div>';
    }

    ?>

    <form action="" method="post">
        <p><span>Character name</span><input type="text" name="charname"></p>
        <p><input type="submit" name="submit" value="Add to list"></p>
    </form>

</div>
