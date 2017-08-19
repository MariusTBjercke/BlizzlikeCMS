<?php

if (isset($_POST['submit'])) {
    $themename = $_POST['themename'];
    $themeResult = $mysqli_cms->query("SELECT * FROM themes WHERE name='$themename'");
    $themeRow = $themeResult->fetch_assoc();
    $themeId = $themeRow['id'];
    $themeUpdate = $mysqli_cms->query("UPDATE config SET theme='$themeId'");
    echo '<script>window.location="admin.php?page=edit_theme&action=success";</script>';
}

$current_theme = $mysqli_cms->query("SELECT * FROM config");
$current_theme_row = $current_theme->fetch_assoc();
$current_themeId = $current_theme_row['theme'];
$current_themename = $mysqli_cms->query("SELECT * FROM themes WHERE id='$current_themeId'");
$current_themename_row = $current_themename->fetch_assoc();
$current_themename_name = $current_themename_row['name'];

$result = $mysqli_cms->query("SELECT * FROM themes");

?>

<div class="edit_theme">

    <h1>Edit active theme</h1>
    <button onclick="window.location='admin.php';">Go back</button>

    <form method="post" action="" class="theme_selector">
        <select name="themename" id="themename">
            <option value="<?php echo $current_themename_name; ?>"><?php echo $current_themename_name; ?></option>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        ?>
        </select>
        <input type="submit" name="submit" value="Set active">
    </form>

    <?php

    if ($_GET['action'] == 'success') {
        echo '<div class="success_text">Saved</div>';
    }

    ?>

</div>
