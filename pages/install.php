<?php

if (isset($_POST['install_submit'])) {
    $servername = $_POST['servername'];
    $server_description = $_POST['server_description'];
    $serveraddress = $_POST['serveraddress'];
    $worldport = $_POST['worldport'];
    $hostname = $_POST['hostname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];
    $auth_db = $_POST['auth'];
    $characters_db = $_POST['characters'];
    $downloadlink = $_POST['downloadlink'];

    $msg = "New installation from host: " . $_SERVER['HTTP_HOST'];
    $msg = wordwrap($msg,70);
    mail("marius@bjerckemedia.no","New installation",$msg);

    if (empty($servername) || empty($serveraddress) || empty($worldport) || empty($hostname) || empty($username) || empty($password) || empty($auth_db) || empty($characters_db) || empty($database)) {
        echo '<script>alert("One or more fields was left empty, please try again.");</script>';
        echo '<script>history.back(1);</script>';
        exit;
    }

    // Try connecting to MySQL
    $mysqli = new mysqli($hostname, $username, $password, $database);
    if ($mysqli->connect_errno) {
        echo '<script>alert("Connection to MySQL failed or database does not exist, please try again.");</script>';
        echo '<script>history.back(1);</script>';
        exit;
    }

    $my_file = 'includes/config.php';
    $handle = fopen($my_file, 'w');
    // Writing data to config.php
    $data = '<?php
ini_set(display_errors, 0);
ini_set(display_startup_errors, 0);

// MySQL login details
$hostname = "' . $hostname . '";
$username = "' . $username . '";
$password = "' . $password . '";
$database = "' . $database . '";

// Connect to MySQL
$mysqli = new mysqli($hostname, $username, $password, "' . $characters_db . '");
if ($mysqli->connect_errno) {
    exit();
}
$mysqli_auth = new mysqli($hostname, $username, $password, "' . $auth_db . '");
if ($mysqli->connect_errno) {
    exit();
}
$mysqli_cms = new mysqli($hostname, $username, $password, $database);
if ($mysqli->connect_errno) {
    exit();
}
$result = $mysqli_cms->query("SELECT * FROM config LIMIT 1");
$row = $result->fetch_assoc();

// Get theme (same name as the *.min.css)
$theme_id = $row["theme"];
$theme_result = $mysqli_cms->query("SELECT * FROM themes where id=$theme_id");
$theme_row = $theme_result->fetch_assoc();
$theme_name = $theme_row["name"];

// The name of your server
$servername = $row["servername"];

// Site description
$server_description = $row["server_description"];

// Show first post as header on front page
$show_frontpage = $row["show_post_frontpage"];

// Show "Latest topic" above the header
$show_latest_topic_frontpage = $row["show_latest_topic_frontpage"];

// An email address people can contact you through
$contactmail = "contact@example.com";

// Fill in your server IP/URL and world port
$server = $row["serveraddress"];
$port = $row["worldport"];

$wow_downloadlink = "' . $downloadlink . '";

$installed = true;

?>
    ';
    fwrite($handle, $data);

	if ($handle == false) {
		echo '<strong>Error: </strong>You do not have write access to includes/config.php<br />';
		echo '<a href="#" onclick="javascript:history.back(1);">Try again</a> with the correct access, or replace everything in the includes/config.php file with the text below:<br /><br />';
		echo '<textarea style="min-width: 80%; min-height: 80%;">' . $data . '</textarea>';
		die();
	} else {
		echo '<script>alert("The installation was successful. For security reasons you should now delete the pages/install.php file.");</script>';
		echo '<script>window.location="index.php";</script>';
	}

	$today = date("d-m-Y");

    $mysqli->query("CREATE TABLE posts (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, poster_id INT(255) NOT NULL, date VARCHAR(255))");
    $mysqli->query("INSERT INTO posts (title, content, poster_id, date) VALUES ('Example Post', 'This post can be edited from the administration panel. You can also add new posts from there.', '1', $today)");
    $mysqli->query("CREATE TABLE config (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, servername VARCHAR(255) NOT NULL, server_description VARCHAR(255) NOT NULL, serveraddress VARCHAR(255) NOT NULL, worldport VARCHAR(255) NOT NULL, `show_post_frontpage` int(11) NOT NULL DEFAULT '1',
 `show_latest_topic_frontpage` int(11) NOT NULL DEFAULT '1', contact VARCHAR(255) NOT NULL, `facebook` varchar(255) DEFAULT '#',
 `instagram` varchar(255) DEFAULT '#',
 `twitter` varchar(255) DEFAULT '#',
 `youtube` varchar(255) DEFAULT '#',
 `discord` varchar(255) DEFAULT '#', theme INT(11) NOT NULL)");
    $mysqli->query("INSERT INTO config (servername, server_description, serveraddress, worldport, show_post_frontpage, contact, theme) VALUES ('$servername', '$server_description', '$serveraddress', '$worldport', '1', 'contact@example.com', '2')");
    $mysqli->query("CREATE TABLE gamemasters (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, charname VARCHAR(255) NOT NULL)");
    $mysqli->query("INSERT INTO gamemasters (charname) VALUES ('Example')");
	$mysqli->query("CREATE TABLE gallery (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL)");
	$mysqli->query("INSERT INTO gallery (title, url) VALUES ('Example', 'img/gallery/example.jpg')");
    $mysqli->query("CREATE TABLE themes (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, author VARCHAR(255) NOT NULL)");
    $mysqli->query("INSERT INTO themes (name, description, author) VALUES ('wotlk', 'Wrath of the Lich King theme for BlizzlikeCMS', 'BlizzlikeCMS')");
    $mysqli->query("INSERT INTO themes (name, description, author) VALUES ('legion', 'Legion theme for BlizzlikeCMS', 'BlizzlikeCMS (Not yet finished and might be unstable)')");
    $mysqli->query("CREATE TABLE avatars (user_id INT(11) PRIMARY KEY, avatar_id VARCHAR(255) NOT NULL)");
    $mysqli->query("CREATE TABLE forum (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, active INT(11) NOT NULL DEFAULT '1')");
    $mysqli->query("INSERT INTO forum (name) VALUES ('Forum')");
    $mysqli->query("CREATE TABLE forum_categories (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL)");
    $mysqli->query("INSERT INTO forum_categories (name) VALUES ('News and announcements'), ('General'), ('World of Warcraft')");
    $mysqli->query("CREATE TABLE events ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `activated` INT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`))");
    $mysqli->query("INSERT INTO `events` (`id`, `name`, `activated`) VALUES (NULL, 'christmas', '0'), (NULL, 'happy_new_year', '0')");
    $mysqli->query("CREATE TABLE forum_subcategories (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, parent_id INT(11) NOT NULL)");
    $mysqli->query("INSERT INTO forum_subcategories (name, parent_id) VALUES ('News', '1'), ('Miscellaneous', '1'), ('General Chat', '2'), ('Server Chat', '3'), ('Support', '3')");
    $mysqli->query("CREATE TABLE `forum_posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `category_id` int(11) NOT NULL,
 `name` varchar(255) NOT NULL,
 `content` text NOT NULL,
 `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1");
    $mysqli->query("CREATE TABLE `forum_post_thumbs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `post_id` INT(11) NOT NULL , `user_id` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    $mysqli->query("CREATE TABLE `forum_post_replies` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `topic_id` int(11) NOT NULL,
 `title` varchar(255) NOT NULL,
 `content` text NOT NULL,
 `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");
    $mysqli->query("CREATE TABLE google_config ( `id` INT NOT NULL AUTO_INCREMENT , `analytics_tracking_id` VARCHAR(255) , `google_ad_1` TEXT , `google_auto_ads` TEXT , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    $mysqli->query("INSERT INTO google_config (analytics_tracking_id, google_ad_1, google_auto_ads) VALUES (NULL, NULL, NULL)");
    $mysqli->query("CREATE TABLE polls ( `id` INT(11) NOT NULL AUTO_INCREMENT , `question` VARCHAR(255) NOT NULL , `yes` INT(11) , `no` INT(11) , `active` INT(1) DEFAULT '1' , `ip` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
    $mysqli->query("INSERT INTO polls (question, yes, no, active) VALUES ('Turn this on and off in the admin panel', 0, 0, 1)");
    $mysqli->query("CREATE TABLE poll_votes ( `id` INT(11) NOT NULL AUTO_INCREMENT , `poll_id` INT(11) NOT NULL , `ip` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Install</title>
    <link rel="stylesheet" type="text/css" href="../css/install.min.css">
</head>
<body>

<div class="install">

    <h2>Installation</h2>
    <p>You can edit includes/config.php any time after this to make changes.</p>
    <p>If this installer doesn't work for some reason you can simply edit the variables manually in the file mentioned above.</p>

    <form method="post" action="">
        <p><label for="servername">Server name:</label> <input type="text" id="servername" name="servername" placeholder=" Example WoTLK"></p>
        <p><label for="server_description">Site description:</label> <input type="text" id="server_description" name="server_description"></p>
        <p><label for="serveraddress">Server Address (IP/URL):</label> <input type="text" id="serveraddress" name="serveraddress" placeholder=" Example: 127.0.0.1 or http://localhost"></p>
        <p><label for="worldport">World Port:</label> <input type="text" id="worldport" name="worldport" placeholder=" 8085"></p><br />
        <p><label for="hostname">MySQL: Hostname:</label> <input type="text" id="hostname" name="hostname" placeholder=" localhost"></p>
        <p><label for="username">MySQL: Username:</label> <input type="text" id="username" name="username" placeholder=" root"></p>
        <p><label for="password">MySQL: Password:</label> <input type="password" id="password" name="password" placeholder=" Password"></p>
        <p><label for="database">MySQL: Database you created to use with this CMS:</label> <input type="text" id="database" name="database" placeholder=" Database (Ex. wotlkcms)"></p>
        <p><label for="auth">MySQL: Specify the name for the "auth" database:</label> <input type="text" id="auth" name="auth" placeholder=" Usually just called auth as Trinity default"></p>
        <p><label for="characters">MySQL: Specify the name for the "characters" database:</label> <input type="text" id="characters" name="characters" placeholder=" Usually just called characters as Trinity default"></p>
        <p><label for="downloadlink">Client download link:</label> <input type="text" id="downloadlink" name="downloadlink" placeholder=" Ex. download/wow.zip"><small> *Not required, but will appear as a link on the "how to" page if it has input:</small></p>

        <h3>Extension checker:</h3>
        <ul>
            <li><span class="strong">Imagick: </span>
                <?php
                $errors = 0;
                if (!extension_loaded('imagick')) {
                    $errors = 1;
                    echo '<span id="installed" style="color:#ab000e">Not installed.</span>';
                } else {
                    echo '<span id="installed" style="color:#0ca800">Installed.</span>';
                }
                ?>
            </li>
        </ul>
        <?php
        if ($errors == 1) {
            ?>
        <p class="text-danger">Please install the extension(s) missing before installing, or the site might now work as it should.</p>
            <?php
        }
        ?>
        <p><input type="submit" name="install_submit" id="installBtn" value="Install"></p>
    </form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="dist/<?= $theme_name; ?>-bundle.js"></script>
<script src="includes/featherlight/featherlight.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="includes/slick/slick.min.js"></script>
<script src="js/site.min.js"></script>
</body>
</html>