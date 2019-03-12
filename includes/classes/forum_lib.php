<?php

class Forum {

    public $forumActive;

    public function __construct() {
    }

    public function displayAllCategories() {
        global $mysqli_auth;
        global $mysqli_cms;

        // Categories query
        $query = "SELECT * FROM forum_categories ORDER BY id";
        $result = $mysqli_cms->query($query);
        $array = $result->fetch_all(MYSQLI_ASSOC);
        if (isAdminLoggedIn()) {
            ?>
            <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create new forum</button>
            <?php
        }
        foreach ($array as $category) {

            // Subcategories query
            $category_id = $category['id'];
            $query2 = "SELECT * FROM forum_subcategories WHERE parent_id='$category_id' ORDER BY id";
            $result2 = $mysqli_cms->query($query2);
            $array2 = $result2->fetch_all(MYSQLI_ASSOC);
            ?>
            <div class="table-wrapper">
                <div class="table-top">
                    <div class="table-title forum-category-title"><?= $category['name']; ?> <?php if (isAdminLoggedIn()) { ?><a href="#" class="editForumCategoryName"><i class="fa fa-pencil-square"></i></a> <a href="#" class="trash"><i class="fa fa-trash"></i></a> <?php } ?></div>
                </div>
                <div class="table-body">
                    <table class="table">
                        <thead>
                        <tr class="black-bar">
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                            <th scope="col">Last Topic By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($array2 as $subcategory) {
                            ?>
                            <tr>
                                <td class="text-center"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                                <td><a href="forum.php?page=post&id=<?= $subcategory['id']; ?>"><?= $subcategory['name']; ?></a></td>
                                <td></td>
                                <td><?= $this->displayLastPosterNameFromCategory($subcategory['id']); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }
    }

    public function displayLastPosterNameFromCategory($categoryID) {
        global $mysqli_auth;
        global $mysqli_cms;

        $query = "SELECT * FROM forum_posts WHERE category_id='$categoryID' ORDER BY id DESC LIMIT 1";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        $poster_id = $fetch['user_id'];
        $poster = new Account($poster_id);
        $poster->retrieveAccount();
        if (strlen($poster->getName()) > 0) {
            return $poster->getName();
        } else {
            return 'None';
        }
    }

    public function displayLastPosterFromID($postID) {
        global $mysqli_auth;
        global $mysqli_cms;

        $query = "SELECT * FROM forum_posts WHERE id='$postID'";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        $poster_id = $fetch['user_id'];
        $check_for_replies = $mysqli_cms->query("SELECT * FROM forum_post_replies WHERE topic_id='$postID' ORDER BY id DESC LIMIT 1");
        $repliesResult = $check_for_replies->fetch_assoc();
        $poster = new Account($repliesResult['user_id']);
        $poster->retrieveAccount();
        if (strlen($poster->getName()) > 0) {
            return $poster->getName();
        } else {
            $poster = new Account($poster_id);
            $poster->retrieveAccount();
            return $poster->getName();
        }
    }

    public function displayPost($postID) {
        global $mysqli_auth;
        global $mysqli_cms;

        $query = "SELECT * FROM forum_subcategories WHERE id='$postID'";
        $result = $mysqli_cms->query($query);
        $array = $result->fetch_assoc();
        ?>
        <div class="table-wrapper">
            <?php if (isUserLoggedIn()) { ?><a href="forum.php?page=create_topic&id=<?= $postID ?>"><button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Post a new topic</button></a><?php } else { echo '<p>You have to be <a href="user_login.php">signed in</a> to create a new topic.</p>'; }?>
            <div class="table-top">
                <div class="table-title"><?= $array['name']; ?></div>
            </div>
            <div class="table-body">
                <table class="table">
                    <thead>
                    <tr class="black-bar">
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col"></th>
                        <th scope="col">Last Reply By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $this->listTopics($postID); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    public function listTopics($postID) {
        global $mysqli_auth;
        global $mysqli_cms;

        $query = "SELECT * FROM forum_posts WHERE category_id='$postID' ORDER BY id DESC";
        $result = $mysqli_cms->query($query);
        $array = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($array as $item) {
            echo '<tr>
                        <td class="text-center"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                        <td><a href="forum.php?page=topic&cat=' . $postID . '&id=' . $item['id'] . '">' . $item['name'] . '</a></td>
                        <td></td>
                        <td>'.$this->displayLastPosterFromID($item['id']).'</td>
                    </tr>';
        }
    }

    public function displayTopic($topicID)
    {
        global $mysqli_auth;
        global $mysqli_cms;

        $query = "SELECT * FROM forum_posts WHERE id='$topicID'";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        $poster = new Account($fetch['user_id']);
        $poster->retrieveAccount();
        $poster_name = $poster->getName();
        ?>
        <div class="table-wrapper top-table">
            <a href="#" onclick="history.back(1);"><button class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go back</button></a>
            <div class="table-top">
                <div class="table-title"><?= $fetch['name']; ?></div>
            </div>
            <div class="table-body">
                <form action="" method="post">
                    <table class="table">
                        <thead>
                        <tr class="black-bar blck-border-right">
                            <th scope="col" class="posted-by">By <?= $poster_name; ?> - <?= $fetch['date']; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="forum-post-avatar">
                                <img src="img/avatars/<?= $poster->getAvatarID(); ?>.png" width="180">
                                <div class="role">Rank: <?= $poster->getRole(); ?></div>
                                <div class="role">Highest level: <?= $poster->getHighestLevel(); ?></div>
                            </td>
                            <td>
                                <div class="topic_content_field"><?= $fetch['content']; ?></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <?php
    }

    public function displayThumbs($topicID) {
        global $mysqli_cms;

        $query = "SELECT * FROM forum_post_thumbs WHERE post_id='$topicID'";
        $result = $mysqli_cms->query($query);
        return $result->num_rows;
    }

    public function displayReplies($topicID) {
        global $mysqli_cms;

        $query = "SELECT * FROM forum_post_replies WHERE topic_id='$topicID'";
        $result = $mysqli_cms->query($query);
        $array = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($array as $reply) {
            $poster = new Account($reply['user_id']);
            $poster->retrieveAccount();
            $poster_name = $poster->getName();
            $thumbs = $this->displayThumbs($reply['id']);
            ?>
            <div class="table-wrapper">
            <?php
            if (isUserLoggedIn()) {
            ?>
                <div class="quote-reply" id="<?= $reply['id']; ?>">
                    <button>Quote and reply</button>
                </div>
            <?php
            }
            ?>
                <div class="table-top">
                    <div class="table-title"><?= $reply['title']; ?></div>
                    <div class="thumb-wrapper"><span class="thumbs-up"><?php if (($thumbs) > 0) { ?>+<?= $thumbs; } ?></span><?php ?> <i class="fa fa-thumbs-up thumb" aria-hidden="true" id="<?= $reply['id']; ?>" title="<?= $this->displayThumbs($reply['id']) ?> Likes"></i></div>
                </div>
                <div class="table-body">
                    <form action="" method="post">
                        <table class="table">
                            <thead>
                            <tr class="black-bar blck-border-right">
                                <th scope="col" class="posted-by">By <?= $poster_name; ?> - <?= $reply['date']; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="forum-post-avatar">
                                    <img src="img/avatars/<?= $poster->getAvatarID(); ?>.png" width="180">
                                    <div class="role">Rank: <?= $poster->getRole(); ?></div>
                                    <div class="role">Highest level: <?= $poster->getHighestLevel(); ?></div>
                                </td>
                                <td>
                                    <div class="topic_content_field" content="<?= $poster_name; ?>" id="content-field-<?= $reply['id']; ?>"><?= $reply['content']; ?></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <?php
        }
        if (isUserLoggedIn()) {
            ?>
            <div class="table-wrapper">
                <div class="table-top">
                    <div class="table-title">Quick reply</div>
                </div>
                <div class="table-body">
                    <form action="" method="post">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="topic_reply_field">
                                        <p>Title:</p>
                                        <p><input type="text" name="title" id="reply-title" class="form-control"></p>
                                        <p>Reply:</p>
                                        <p><textarea name="reply" class="tinymce" id="reply-area"></textarea></p>
                                        <p><input type="submit" name="reply_submit" class="btn btn-primary"
                                                  value="Post reply"></p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <?php
        } else {
            $_SESSION['lastURL'] = $_SERVER['REQUEST_URI'];
            ?>
            <p>You have to be <a href="user_login.php">signed in</a> to reply to this topic.</p>
            <?php
        }
    }

    public function createTopic($catID) {
        global $mysqli_auth;
        global $mysqli_cms;

        $catQuery = "SElECT * FROM forum_subcategories WHERE id='$catID'";
        $catResult = $mysqli_cms->query($catQuery);
        $catFetch = $catResult->fetch_assoc();
        ?>
        <div class="table-wrapper">
            <a href="#" onclick="history.back(1);"><button class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go back</button></a>
            <div class="table-top">
                <div class="table-title">Post a new topic (<?= $catFetch['name']; ?>)</div>
            </div>
            <div class="table-body">
                <form action="" method="post">
                <table class="table">
                    <thead>
                    <tr class="black-bar">
                        <th scope="col">Title</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" name="title"></td>
                    </tr>
                    <tr class="black-bar">
                        <th scope="col">Content</th>
                    </tr>
                    <tr>
                        <td><textarea name="content" class="tinymce"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" class="btn btn-primary" value="Submit"></td>
                    </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <?php
    }

    public function saveTopic($title, $message, $posterID, $catID) {
        global $mysqli_auth;
        global $mysqli_cms;

        // Sanitize
        $title = $mysqli_cms->real_escape_string($title);
        $message = $mysqli_cms->real_escape_string($message);

        $query = "INSERT INTO forum_posts (user_id, category_id, name, content) VALUES ('$posterID', '$catID', '$title', '$message')";
        $result = $mysqli_cms->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function saveReply($title, $message, $posterID, $topicID) {
        global $mysqli_cms;

        // Sanitize
        $title = $mysqli_cms->real_escape_string($title);
        $message = $mysqli_cms->real_escape_string($message);

        $query = "INSERT INTO forum_post_replies (user_id, topic_id, title, content) VALUES ('$posterID', '$topicID', '$title', '$message')";
        $result = $mysqli_cms->query($query);
        if ($result) {
            return true;
        } else {
            return $mysqli_cms->error;
        }
    }

    public function getLastTopic($viewAsLink = false) {
        global $mysqli_auth;
        global $mysqli_cms;

        $query = "SELECT * FROM forum_posts ORDER BY id DESC LIMIT 1";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        $num = $result->num_rows;
        if ($num > 0) {
            if ($viewAsLink == false) {
                return $fetch['name'];
            } else {
                return '<a href="forum.php?page=topic&cat=' . $fetch['category_id'] . '&id=' . $fetch['id'] . '">' . $fetch['name'] . '</a>';
            }
        } else {
            return 'No topics yet.';
        }
    }

    public function getForumNotification() {
        global $mysqli_cms;

        $ip = $_SERVER['REMOTE_ADDR'];
        $query = "SELECT * FROM forum_notification WHERE ip = '$ip'";
        $result = $mysqli_cms->query($query);
        $num = $result->num_rows;
        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

}