<?php

$result = $mysqli_cms->query("SELECT * FROM themes");

?>

<div class="edit_theme">

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
