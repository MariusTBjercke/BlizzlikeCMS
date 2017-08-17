<?php

$result = $mysqli_cms->query("SELECT * FROM gamemasters");

?>
<div class="gamemasters">

    <h2>Gamemasters</h2>
    <ul>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row['charname'] . '</li>';
        }
        ?>
    </ul>

</div>