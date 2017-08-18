<?php
$pagenum = 1;
if(!empty($_GET['pagenum'])) {
	$pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
	if(false === $pagenum) {
		$pagenum = 1;
	}
}
if (isset($_POST['submit'])) {
	$target_dir = "img/gallery/";
	$temp = explode(".", $_FILES["file"]["name"]);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$target_file = $target_dir . $newfilename;
	$title = $_POST['title'];
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
			sleep(3);
			echo '<script>history.back(1);</script>';
		}
	}
    // Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
		echo '<script>history.back(1);</script>';
	}
    // Check file size
	if ($_FILES["file"]["size"] > 9000000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
		echo '<script>history.back(1);</script>';
	}
    // Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
		echo '<script>history.back(1);</script>';
	}
    // Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		echo '<script>history.back(1);</script>';
    // if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			$result = $mysqli_cms->query("INSERT INTO gallery (title, url) VALUES ('$title', 'img/gallery/$newfilename')");
			echo '<script>window.location="admin.php?page=edit_gallery";</script>';
		} else {
			echo '<script>alert("Sorry, there was an error uploading your file. Do you have permission to write to the img/gallery folder?");</script>';
			echo '<script>history.back(1);</script>';
		}
	}
}

if ($_GET['action'] == 'del') {
    $imageId = $_GET['id'];
    $mysqli_cms->query("DELETE FROM gallery WHERE id='$imageId'");
    echo '<script>window.location="admin.php?page=edit_gallery";</script>';
}

$rowResult = $mysqli_cms->query("SELECT * FROM gallery");
$totalNum = $rowResult->num_rows;
$items_per_page = 6;
$start = ($pagenum * $items_per_page) - $items_per_page;
$endpage = ceil($totalNum/$items_per_page);
$nextpage = $pagenum + 1;
$previouspage = $pagenum - 1;

$result = $mysqli_cms->query("SELECT * FROM gallery ORDER BY id DESC LIMIT " . $start . ", " . $items_per_page);
?>

<h1>Edit Gallery <span>(Click the images to enlarge)</span></h1>
<button onclick="window.location='admin.php';">Go back</button>

<div class="edit_gallery">

    <div class="row">
		<?php
		while ($row = $result->fetch_assoc()) {
			echo '<div class="col-xs-6 col-md-3">' . $row['title'] . ' - <a href="#" class="delete" onclick="confirmDeleteImage(' . $row['id'] . ')">Delete</a>
                        <a href="' . $row['url'] . '" class="thumbnail" data-featherlight="' . $row['url'] . '">
                        <img src="' . $row['url'] . '" title="' . $row['title'] . '" alt="' . $row['title'] . '"></a>
                  </div>';
		}
            ?>
    </div>

    <div class="row">
    <?php

    echo '<div class="edit_gallery_pagination"><ul>';
    echo 'Page ' . $pagenum . ' of ' . $endpage . '<br/><br/>';
    if ($pagenum >= 2) {
        echo '<li class="strong"><a href="admin.php?page=edit_gallery&pagenum=' . $previouspage . '">Previous</a></li> ';
    }
    if ($pagenum != $endpage) {
        echo '<li class="strong"><a href="admin.php?page=edit_gallery&pagenum=' . $nextpage . '">Next</a></li>';
    }
    echo '</ul></div>';
        ?>
    </div>

	<form action="" method="post" enctype="multipart/form-data">
		<p><input type="file" name="file" id="file"></p>
        <p><label>Image title:</label><input type="text" name="title"></p>
		<p><input type="submit" name="submit" value="Upload image"></p>
	</form>

</div>