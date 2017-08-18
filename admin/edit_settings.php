<?php
if (isset($_POST['save_submit'])) {
	$servername = addslashes(trim($_POST['servername']));
	$serveraddress = addslashes(trim($_POST['serveraddress']));
	$worldport = addslashes(trim($_POST['worldport']));
	$contact = addslashes(trim($_POST['contact']));
	$youtube = addslashes(trim($_POST['youtube']));
	$download = addslashes(trim($_POST['download']));


	$result = $mysqli_cms->query("UPDATE config SET servername='$servername', serveraddress='$serveraddress', worldport='$worldport', contact='$contact', youtube='$youtube', download='$download' WHERE id='1'");
	echo '<script>window.location="admin.php?page=edit_settings&action=success";</script>';
	exit;
}

$result = $mysqli_cms->query("SELECT * FROM config");
?>

<div class="edit_settings">

	<h1>Edit website settings</h1>
	<button onclick="window.location='admin.php';">Go back</button>

	<ul>
		<?php
		if ($_GET['action'] == 'edit') {
			$edit_settings = true;
			while ($row = $result->fetch_assoc()) {
				echo '<form action="" method="post">';
				echo '<li><label>Server name:</label> <input type="text" name="servername" value="' . $row['servername'] . '"></li>';
				echo '<li><label>Server address:</label> <input type="text" name="serveraddress" value="' . $row['serveraddress'] . '"></li>';
				echo '<li><label>World port:</label> <input type="text" name="worldport" value="' . $row['worldport'] . '"></li>';
				echo '<li><label>Contact mail:</label> <input type="text" name="contact" value="' . $row['contact'] . '"></li>';
				echo '<li><label>YouTube embed URL:</label> <input type="text" name="youtube" value="' . $row['youtube'] . '"></li>';
				echo '<li><label>Client download link:</label> <input type="text" name="download" value="' . $row['download'] . '"></li>';
				echo '<input type="submit" name="save_submit" value="Save">';
				echo '</form>';
			}
		} else {
			while ($row = $result->fetch_assoc()) {
				echo '<li><label>Server name:</label> ' . $row['servername'] . '</li>';
				echo '<li><label>Server address:</label> ' . $row['serveraddress'] . '</li>';
				echo '<li><label>World port:</label> ' . $row['worldport'] . '</li>';
				echo '<li><label>Contact mail:</label> ' . $row['contact'] . '</li>';
				echo '<li><label>YouTube embed URL:</label> ' . $row['youtube'] . '</li>';
				echo '<li><label>Client download link:</label> ' . $row['download'] . '</li>';
			}
		}
		?>
	</ul>

	<?php

	if ($_GET['action'] == 'success') {
		echo '<div class="success">The details have been saved.</div>';
	}

	?>

	<?php
	if ($_GET['action'] == 'edit') {
		?>
		<p><button onclick="javascript:window.location='admin.php?page=edit_settings';">Cancel editing</button></p>
		<?php
	} else {
		?>
		<p><button onclick="javascript:window.location='admin.php?page=edit_settings&action=edit';">Edit settings</button></p>
		<?php
	}
	?>

</div>
