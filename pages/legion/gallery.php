<?php
$pagenum = 1;
if(!empty($_GET['pagenum'])) {
	$pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
	if(false === $pagenum) {
		$pagenum = 1;
	}
}

$site = new Site();
?>

<div class="gallery">

    <h1>Gallery <span>(Click to enlarge)</span></h1>

	<?php
	$site->getGallery($pagenum);
	?>

</div>