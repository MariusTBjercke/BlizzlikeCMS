<?php
$pagenum = 1;
if(!empty($_GET['pagenum'])) {
    $pagenum = filter_input(INPUT_GET, 'pagenum', FILTER_VALIDATE_INT);
    if(false === $pagenum) {
        $pagenum = 1;
    }
}
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
}
$_SESSION['headers'] = array(
    "<script src='node_modules/tinymce/tinymce.min.js'></script>",
    "<script>
  tinymce.init({
    selector: '.content_field',
    branding: false,
    height: 300,
    theme: 'modern',
    plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    image_advtab: true
  });
  </script>
  ",
);
?>

<h1>Edit posts</h1>

<?php

if (!empty($_GET['action'])) {
    ?>
    <button onclick="window.location='admin.php?page=edit_posts';">Go back</button>
    <?php
} else {
    ?>
    <button onclick="window.location='admin.php';">Go back</button>
    <?php
}

if ($_GET['action'] == 'edit') {
    $post = new Post($post_id);

    // Save details on submit
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $result = $post->saveDetails($title, $content);
        if ($result == true) {
            echo '<script>alert("The details have been saved.");</script>';
            echo '<script>history.back(1);</script>';
        } else {
            echo '<script>alert("Something went wrong, please try again.");</script>';
            echo '<script>history.back(1);</script>';
        }
    }

    $post->getPost();
    ?>

    <div class="edit_post">
        <form action="" method="post">
            <p><label>Title</label><br><input type="text" value="<?php echo $post->getTitle(); ?>" name="title"></p>
            <p><label>Content</label><br><textarea class="content_field" name="content"><?php echo
                    $post->getContent();
            ?></textarea></p>
            <p><input type="submit" name="submit" value="Save"></p>
        </form>
    </div>

    <?php
} else if ($_GET['action'] == 'add_post') {

    // Save details on submit
    if (isset($_POST['addPost_submit'])) {
        $admin = new Admin;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $result = $admin->addPost($title, $content);
        if ($result == true) {
            echo '<script>alert("The details have been saved.");</script>';
            echo '<script>window.location="admin.php?page=edit_posts";</script>';
        } else {
            echo '<script>alert("Something went wrong, please try again.");</script>';
            echo '<script>history.back(1);</script>';
        }
    }

    ?>

    <div class="add_post">
        <form action="" method="post">
            <p><label>Title</label><br><input type="text" name="title"></p>
            <p><label>Content</label><br><textarea class="content_field" name="content"></textarea></p>
            <p><input type="submit" name="addPost_submit" value="Save"></p>
            <?php echo $admin->getPosterId(); ?>
        </form>
    </div>

    <?php
} else if ($_GET['action'] == 'delete') {
    $del_id = $_GET['id'];
    $post = new Post($del_id);
    $result = $post->deletePost();
    if ($result == true) {
        echo '<script>alert("The post has been deleted.");</script>';
        echo '<script>history.back(1);</script>';
    } else {
        echo '<script>alert("Something went wrong, please try again.");</script>';
        echo '<script>history.back(1);</script>';
    }
} else {
    ?>
    <button onclick="window.location='admin.php?page=edit_posts&action=add_post';">Add a new post</button>

    <?php
    $admin = new Admin();
    $admin->showPosts($pagenum);
}
?>
