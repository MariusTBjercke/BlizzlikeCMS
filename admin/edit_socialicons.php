<?php
if (isset($_POST['submit'])) {
    $facebook = addslashes(trim($_POST['facebook']));
    $instagram = addslashes(trim($_POST['instagram']));
    $twitter = addslashes(trim($_POST['twitter']));
    $youtube = addslashes(trim($_POST['youtube']));

    $result = $mysqli_cms->query("UPDATE config SET facebook='$facebook', instagram='$instagram', twitter='$twitter', youtube='$youtube' WHERE id='1'");
    echo '<script>window.location="admin.php?page=edit_socialicons&action=success";</script>';
    exit;
}

$result = $mysqli_cms->query("SELECT * FROM config");
$fetch = $result->fetch_assoc();
?>

<div class="edit_settings">

    <button onclick="window.location='admin.php';">Go back</button>

    <h3>Fill in URLs here<br><div class="small">If you want to hide an icon, example Facebook - simply remove all text inside the Facebook input field.</div></h3>

    <form action="" method="post">
    <ul>
        <li><p>Facebook: <input type="text" name="facebook" class="form-control" value="<?= $fetch['facebook']; ?>"></p></li>
        <li><p>Instagram: <input type="text" name="instagram" class="form-control" value="<?= $fetch['instagram']; ?>"></p></li>
        <li><p>Twitter: <input type="text" name="twitter" class="form-control" value="<?= $fetch['twitter']; ?>"></p></li>
        <li><p>YouTube: <input type="text" name="youtube" class="form-control" value="<?= $fetch['youtube']; ?>"></p></li>
    </ul>

    <input type="submit" name="submit" value="Edit settings" class="btn">
    </form>

    <?php
    if ($_GET['action'] == 'success') {
        echo '<div class="success">The details have been saved.</div>';
    }
    ?>

</div>
