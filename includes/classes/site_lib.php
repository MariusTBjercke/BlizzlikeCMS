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
            $account = new Account($poster_id);
            $account->retrieveAccount();
            $newTime = strtotime($row['date']);
            $outputTime = date('d.m.Y', $newTime);
            $result2 = $mysqli_auth->query("SELECT * FROM account WHERE id='$poster_id'");
            $row2 = $result2->fetch_assoc();
            echo '<h1 class="post-title">' . $row['title'] . '</h1>
<div class="row">
        <div class="col"><img src="img/thumbnails/'. $account->getAvatarID() . '.png" class="img-thumbnail front-page-thumbnail"></div>
        <div class="col-sm-3"><h2>Posted by <span class="frontPage-news-author">' . $row2['username'] . '</span><br/>' . $outputTime . '</h2></div>
        </div><div class="row">
        <p>' . $row['content'] . '</p></div>';
            echo '</div>';
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

    public function checkIf404($url) {
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        // Get the HTML or whatever is linked to the $url.
        $response = curl_exec($handle);

        // Check for 404 (file not found).
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode == 404) {
            return true;
        } else {
            return false;
        }
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
                $fullUrl = $_SERVER['SERVER_NAME'] . '/' . $row['url'];
                if (!($this->checkIf404($fullUrl))) {
                ?>
                        <div class="gallery-img"> <?php if ($row['title']) { ?><div class="gallery-img-description"><?php echo $row['title']; ?></div><?php } ?><img src="<?php echo $row['url']; ?>" title="<?php echo $row['title']; ?>" alt="<?php echo $row['title']; ?>" data-featherlight="<?php echo $row['url']; ?>"></div>
                <?php
                }
            }
            echo '</div>';
            echo '<div class="clearfix"></div>';
        } else {
		    echo 'The gallery is empty..<br /><br />';
        }
	}

	public function getCurrentURL() {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else
            $link = "http";

        $link .= "://";

        $link .= $_SERVER['HTTP_HOST'];
        $link .= $_SERVER['REQUEST_URI'];
        return $link;
    }

}