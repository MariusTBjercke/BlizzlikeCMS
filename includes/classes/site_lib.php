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

    public function getFirstPost() {
        global $mysqli_cms;

        $result = $mysqli_cms->query("SELECT * FROM posts ORDER BY id ASC LIMIT 1");
        $row = $result->fetch_assoc();
        echo '<h1>' . $row['title'] . '</h1>';
        echo '<p>' . $row['content'] . '</p><button onclick="scrollToBottom()">Go down</button>';
    }

    public function getGallery($pagenum) {
    	global $mysqli_cms;

		$rowResult = $mysqli_cms->query("SELECT * FROM gallery");
		$totalNum = $rowResult->num_rows;
		$result = $mysqli_cms->query("SELECT * FROM gallery ORDER BY id DESC");

		$numRows = $result->num_rows;

		if ($numRows > 0) {
            echo '<div class="slick-gal">';
            while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="gallery-img"> <?php if ($row['title']) { ?><div class="gallery-img-description"><?php echo $row['title']; ?></div><?php } ?><img src="<?php echo $row['url']; ?>" title="<?php echo $row['title']; ?>" alt="<?php echo $row['title']; ?>" data-featherlight="<?php echo $row['url']; ?>"></div>
            <?php
            }
            echo '</div>';
            echo '<div class="clearfix"></div>';
        } else {
		    echo 'The gallery is empty..<br /><br />';
        }
	}

}