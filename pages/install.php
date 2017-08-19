<?php

if (isset($_POST['install_submit'])) {
    $servername = $_POST['servername'];
    $serveraddress = $_POST['serveraddress'];
    $worldport = $_POST['worldport'];
    $youtube = $_POST['youtube'];
    $download = $_POST['download'];
    $hostname = $_POST['hostname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    $msg = "New installation from IP: " . $_SERVER['REMOTE_ADDR'];
    $msg = wordwrap($msg,70);
    mail("privat@bjerckemedia.no","New installation",$msg);

    if (empty($servername) || empty($serveraddress) || empty($worldport) || empty($hostname) || empty($username) || empty($password) || empty($database)) {
        echo '<script>alert("One or more fields was left empty, please try again.");</script>';
        echo '<script>history.back(1);</script>';
        exit;
    }

    // Try connecting to MySQL
    $mysqli = new mysqli($hostname, $username, $password, $database);
    if ($mysqli->connect_errno) {
        echo '<script>alert("Connection to MySQL failed, please try again.");</script>';
        echo '<script>history.back(1);</script>';
        exit;
    }

    $my_file = 'includes/config.php';
    $handle = fopen($my_file, 'w');
    // Writing data to config.php
    $data = '
<?php

// MySQL login details
$hostname = "' . $hostname . '";
$username = "' . $username . '";
$password = "' . $password . '";
$database = "' . $database . '";

// Connect to MySQL
$mysqli = new mysqli($hostname, $username, $password, "characters");
if ($mysqli->connect_errno) {
    exit();
}
$mysqli_auth = new mysqli($hostname, $username, $password, "auth");
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
$theme_result = $mysqli_cms->query("SELECT * FROM themes where id="$theme_id");
$theme_row = $theme_result->fetch_assoc();
$theme_name = $theme_row["name"];

// The name of your server
$servername = $row["servername"];

// Front page top video YouTube link
$frontpage_toppage_ytlink = $row["youtube"];

// WotLK Download Link / Link til direct download, torrent, etc.
$wotlk_downloadlink = $row["download"];

// An email address people can contact you through
$contactmail = "contact@example.com";

// Fill in your server IP/URL and world port
$server = $row["serveraddress"];
$port = $row["worldport"];

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

    $mysqli->query("CREATE TABLE posts (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, poster_id INT(255) NOT NULL)");
    $mysqli->query("INSERT INTO posts (title, content, poster_id) VALUES ('Example Post', 'This post can be edited from the administration panel. You can also add new posts from there.', '1')");
    $mysqli->query("CREATE TABLE config (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, servername VARCHAR(255) NOT NULL, serveraddress VARCHAR(255) NOT NULL, worldport VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, youtube VARCHAR(255), download VARCHAR(255), theme INT(11) NOT NULL)");
    $mysqli->query("INSERT INTO config (servername, serveraddress, worldport, contact, youtube, download, theme) VALUES ('$servername', '$serveraddress', '$worldport', 'contact@example.com', '$youtube', '$download', '1')");
    $mysqli->query("CREATE TABLE gamemasters (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, charname VARCHAR(255) NOT NULL)");
    $mysqli->query("INSERT INTO gamemasters (charname) VALUES ('Example')");
	$mysqli->query("CREATE TABLE gallery (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL)");
	$mysqli->query("INSERT INTO gallery (title, url) VALUES ('Example', 'img/gallery/example.jpg')");
    $mysqli->query("CREATE TABLE themes (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, author VARCHAR(255) NOT NULL)");
    $mysqli->query("INSERT INTO themes (name, description, author) VALUES ('wotlk', 'Wrath of the Lich King theme for BlizzlikeCMS', 'BlizzlikeCMS')");
    $mysqli->query("INSERT INTO themes (name, description, author) VALUES ('legion', 'Legion theme for BlizzlikeCMS', 'BlizzlikeCMS')");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Install</title>
    <link rel="stylesheet" type="text/css" href="../css/install.css">
</head>
<body>

<div class="install">

    <h2>Installation</h2>
    <p>You can edit includes/config.php any time after this to make changes.</p>
    <p>If this installer doesn't work for some reason you can simply edit the variables manually in the file mentioned above.</p>

    <form method="post" action="">
        <p><label for="servername">Server name</label><input type="text" id="servername" name="servername" placeholder=" Example WoTLK"></p>
        <p><label for="serveraddress">Server Address (IP/URL)</label><input type="text" id="serveraddress" name="serveraddress" placeholder=" Example: 127.0.0.1"></p>
        <p><label for="worldport">World Port</label><input type="text" id="worldport" name="worldport" placeholder=" 8085"></p><br />
        <p><label for="youtube">YouTube video on the front page (Optional)</label><input type="text" id="youtube" name="youtube" placeholder="https://www.youtube.com/embed/29YfSQRJHTs"></p>
        <p><label for="download">WoW WotLK Download URL (Optional)</label><input type="text" id="download" name="download" placeholder=" URL to .zip or torrent?"></p><br />
        <p><label for="hostname">MySQL: Hostname</label><input type="text" id="hostname" name="hostname" placeholder=" localhost"></p>
        <p><label for="username">MySQL: Username</label><input type="text" id="username" name="username" placeholder=" root"></p>
        <p><label for="password">MySQL: Password</label><input type="text" id="password" name="password" placeholder=" Password"></p>
        <p><label for="database">MySQL: Database to use with this CMS</label><input type="text" id="database" name="database" placeholder=" Database (Ex. wotlkcms)"></p>
        <p><input type="submit" name="install_submit" value="Install"></p>
    </form>

</div>

</body>
</html>