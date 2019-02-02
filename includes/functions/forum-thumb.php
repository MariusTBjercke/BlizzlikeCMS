<?php
session_start();
include '../config.php';
include '../functions.php';

global $mysqli_cms;

$userID = getLoggedInUserID();
$postID = $_GET['post_id'];

$checkQuery = "SELECT * FROM forum_post_thumbs WHERE post_id='$postID' AND user_id='$userID'";
$checkResult = $mysqli_cms->query($checkQuery);
$checkNum = $checkResult->num_rows;

$query = "INSERT INTO forum_post_thumbs (post_id, user_id) VALUES ('$postID', '$userID')";

if ($checkNum == 0) {
    $result = $mysqli_cms->query($query);
}

if ($result) {
    echo 'true';
} else {
    echo 'false';
}

?>