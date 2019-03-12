<?php
$result = $mysqli->query("SELECT * FROM characters WHERE online='1'");
$activeplayersResult = $mysqli->query("SELECT * FROM characters");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="<?= $server_description; ?>">
    <meta name="keywords" content="WoW Like Home, World of Warcraft, WoWLikeHome, WoW, Best Private Server, Best Server, Best Blizzlike Server, Best WoW Server, WOTLK server, 3.3.5a, Server, Private Server, Wintergrasp, Retail, The Wrath of the Lich King, Pathfinding, LoS, Best Scripts, WOTLK, Quality Private Server, Professional, Naxxramas, Naxx, Nax, Obsidian Sanctum, OS, EOT, Malygos, Eye of Eternity, Ulduar, Icecrown Citadel, ICC, ToC, Trial of the Crusade, full, full scripted, best scripted, Wintergrasp, blizzlike, blizlike">
	<title><?php if($title) { echo $title; } echo $servername; ?></title>
    <link rel="shortcut icon" href="img/themes/<?php echo $theme_name; ?>/favicon.png">
    <link rel="stylesheet" type="text/css" href="includes/featherlight/featherlight.min.css">
    <link rel="stylesheet" type="text/css" href="dist/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="includes/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="includes/slick/slick-theme.css">
    <link href="https://fonts.googleapis.com/css?family=Zilla+Slab" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dist/<?= $theme_name; ?>.css">
    <link rel="stylesheet" type="text/css" href="includes/font-awesome/css/font-awesome.min.css">
    <script src='includes/tinymce/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '.tinymce',
            branding: false,
            height: 300,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true
        });
    </script>
    <?php
    $google_query = "SELECT * FROM google_config WHERE id='1'";
    $google_result = $mysqli_cms->query($google_query);
    $google_fetch = $google_result->fetch_assoc();
    if (strlen($google_fetch['google_auto_ads']) > 0) {
        echo $google_fetch['google_auto_ads'];
    }
    if (strlen($google_fetch['analytics_tracking_id']) > 0) {
        ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $google_fetch['analytics_tracking_id']; ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', '<?= $google_fetch['analytics_tracking_id']; ?>');
        </script>
        <?php
    }
    ?>
</head>
<body>
<?php
include 'pages/' . $theme_name . '/header.php';
?>