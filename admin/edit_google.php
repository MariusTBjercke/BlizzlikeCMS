<?php
if (isset($_POST['submit'])) {
    $analytics_id = $mysqli_cms->real_escape_string($_POST['analytics_id']);
    $google_ad_1 = $mysqli_cms->real_escape_string($_POST['google_ad_1']);
    $google_auto_ads = $mysqli_cms->real_escape_string($_POST['google_auto_ads']);

    $result = $mysqli_cms->query("UPDATE google_config SET analytics_tracking_id='$analytics_id', google_ad_1='$google_ad_1', google_auto_ads='$google_auto_ads' WHERE id='1'");
    echo '<script>alert("The details have been saved.");</script>';
    echo '<script>history.back(1);</script>';
    exit;
}

$result = $mysqli_cms->query("SELECT * FROM google_config");
$fetch = $result->fetch_assoc();
?>

<div class="edit_settings google_settings">

    <button onclick="window.location='admin.php';">Go back</button>

    <h3>Fill in the Google analytics and ad codes if you have any.<br><div class="small">Monitoring the website with Google Analytics is a really strong and important tool. Use it to monitor and see what you can do to improve the amount of visitors on the website. Google ads can help you earn in some extra money for the hosting space you are providing, and so on..</div></h3>

    <form action="" method="post">
        <ul>
            <li><p>Google Analytics Tracking ID: <a href="https://support.google.com/analytics/answer/1008080?visit_id=636788614818147357-2366831304&rd=1" title="What is this?" target="_blank"><i class="fa fa-question-circle" aria-hidden="true"></i></a><input type="text" name="analytics_id" class="form-control" value="<?= $fetch['analytics_tracking_id']; ?>"></p></li>
            <li><p>Google AD #1: <a href="#" title="Positioned right underneath the navigation bar. Include the whole Javascript code from Google Adsense - from <script> to </script>."><i class="fa fa-question-circle" aria-hidden="true"></i></a><br><textarea name="google_ad_1" class="form-control"><?= $fetch['google_ad_1']; ?></textarea></p></li>
            <li><p>Google Auto Ads: <a href="https://support.google.com/adsense/answer/7480616?hl=en" title="Read more about Auto ads. From <script> to </script>." target="_blank"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br><textarea name="google_auto_ads" class="form-control"><?= $fetch['google_auto_ads']; ?></textarea></p></li>
        </ul>

        <input type="submit" name="submit" value="Save settings" class="btn">
    </form>

</div>
