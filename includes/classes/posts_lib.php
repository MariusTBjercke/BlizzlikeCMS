<?php

class Post {
    public $post_id;
    public $title;
    public $content;
    public $poster_id;
    public $author;

    public function __construct($post_id) {
        $this->post_id = $post_id;
    }

    public function getPost() {
        global $mysqli_cms;
        $post_id = $this->post_id;

        $result = $mysqli_cms->query("SELECT * FROM posts WHERE id='$post_id'");
        $row = $result->fetch_assoc();

        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->poster_id = $row['poster_id'];
    }

    public function getTitle() {
        $title = $this->title;
        return $title;
    }

    public function getContent() {
        $content = $this->content;
        return $content;
    }

    public function getAuthor() {
        global $mysqli_auth;
        $poster_id = $this->poster_id;

        $result = $mysqli_auth->query("SELECT * FROM account WHERE id='$poster_id'");
        $row = $result->fetch_assoc();

        $this->author = $row['username'];
        return $this->author;
    }

    public function saveDetails($title, $content) {
        global $mysqli_cms;
        $post_id = $this->post_id;

        $result = $mysqli_cms->query("UPDATE posts SET title='$title', content='$content' WHERE id='$post_id'");

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost() {
        global $mysqli_cms;
        $post_id = $this->post_id;

        $result = $mysqli_cms->query("DELETE FROM posts WHERE id='$post_id'");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}