<?php
if (isset($_POST['submit'])) {
    $question = addslashes(trim($_POST['question']));

    $mysqli_cms->query("INSERT INTO polls (question) VALUES ('$question')");
    echo '<script>window.location="admin.php?page=edit_polls&action=success";</script>';
    exit;
}
?>

<div class="edit_settings">

    <button onclick="window.location='admin.php';">Go back</button>

    <h3>Edit site polls<br><div class="small">Type in your question underneath and the poll will appear until the date you specify. The answers to the poll will be on the top bar of the website.</div></h3>

    <form action="" method="post">
        <ul>
            <li><p>Question: <input type="text" name="question" class="form-control"></p></li>
        </ul>

        <input type="submit" name="submit" value="Save question" class="btn register-btn">
    </form>

    <?php
    if ($_GET['action'] == 'success') {
        echo '<div class="success">The details have been saved.</div>';
    }
    ?>

</div>
