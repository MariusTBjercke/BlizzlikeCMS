<?php

class Site
{

    public function __construct() {
    }

    public function getPosts($pagenum) {
        global $mysqli_cms;
        global $mysqli_auth;

        $rowResult = $mysqli_cms->query("SELECT * FROM posts");
        $totalNum = $rowResult->num_rows;
        $items_per_page = 5;
        $start = ($pagenum * $items_per_page) - $items_per_page;
        $endpage = ceil($totalNum/$items_per_page);
        $nextpage = $pagenum + 1;
        $previouspage = $pagenum - 1;

        $result = $mysqli_cms->query("SELECT * FROM posts ORDER BY id DESC LIMIT " . $start . ", " . $items_per_page);
        $getInfo = $_SERVER["QUERY_STRING"];

        echo '<div class="posts_list_front">';
        while ($row = $result->fetch_assoc()) {
            $poster_id = $row['poster_id'];
            $result2 = $mysqli_auth->query("SELECT * FROM account WHERE id='$poster_id'");
            $row2 = $result2->fetch_assoc();
            echo '<h1>' . $row['title'] . '</h1>
        <h2>Posted by <span class="frontPage-news-author">' . $row2['username'] . '</span></h2>
        <p>' . $row['content'] . '</p>';
        }

        echo '<ul>';
        echo 'Page ' . $pagenum . ' of ' . $endpage . '<br/><br/>';
        if ($pagenum >= 2) {
            echo '<li class="strong"><a href="index.php?pagenum=' . $previouspage . '">Previous</a></li>';
        }
        if ($pagenum != $endpage) {
            echo '<li class="strong"><a href="index.php?pagenum=' . $nextpage . '">Next</a></li>';
        }
        echo '</ul></div>';
    }

    public function getGallery($pagenum) {
    	global $mysqli_cms;

		$rowResult = $mysqli_cms->query("SELECT * FROM gallery");
		$totalNum = $rowResult->num_rows;
		$items_per_page = 8;
		$start = ($pagenum * $items_per_page) - $items_per_page;
		$endpage = ceil($totalNum/$items_per_page);
		$nextpage = $pagenum + 1;
		$previouspage = $pagenum - 1;

		$result = $mysqli_cms->query("SELECT * FROM gallery ORDER BY id DESC LIMIT " . $start . ", " . $items_per_page);

		while ($row = $result->fetch_assoc()) {
			echo '<div class="col-xs-6 col-md-3">' . $row['title'] . '
                        <a href="' . $row['url'] . '" class="thumbnail" data-featherlight="' . $row['url'] . '">
                        <img src="' . $row['url'] . '" title="' . $row['title'] . '" alt="' . $row['title'] . '"></a>
                  </div>';
		}

		echo '<ul>';
		echo 'Page ' . $pagenum . ' of ' . $endpage . '<br/><br/>';
		if ($pagenum >= 2) {
			echo '<li class="strong"><a href="gallery.php?pagenum=' . $previouspage . '">Previous</a></li>';
		}
		if ($pagenum != $endpage) {
			echo '<li class="strong"><a href="gallery.php?pagenum=' . $nextpage . '">Next</a></li>';
		}
		echo '</ul>';
	}

}