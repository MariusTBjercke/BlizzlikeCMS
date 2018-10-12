<?php
$result = $mysqli->query("SELECT * FROM characters WHERE online='1'");
$activeplayersResult = $mysqli->query("SELECT * FROM characters");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="<?= $server_description; ?>">
    <meta name="keywords" content="World of Wacraft, wow, wotlk, wrath, of, the, lich, king, wrath of the lich king,
    335a, 3.3.5a, stable, fast, private, server, blizzlike">
	<title><?php if($title) { echo $title; } echo $servername; ?></title>
    <link rel="shortcut icon" href="img/themes/<?php echo $theme_name; ?>/favicon.png">
    <link rel="stylesheet" type="text/css" href="includes/featherlight/featherlight.min.css">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="includes/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="includes/slick/slick-theme.css">
    <link href="https://fonts.googleapis.com/css?family=Zilla+Slab" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dist/main.css">
    <link rel="stylesheet" type="text/css" href="includes/font-awesome/css/font-awesome.min.css">
    <?php
    if (isset($_SESSION['headers'])) {
        $headers = $_SESSION['headers'];
        foreach ($headers as $header) {
            echo $header;
        }
    }
    ?>
</head>
<body>

<?php
include 'pages/' . $theme_name . '/header.php';
?>