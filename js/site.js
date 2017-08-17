function confirmDelete(deleteId) {
    var conf = confirm("Are you sure you want to delete this post?");
    if (conf == true) {
        window.location="admin.php?page=edit_posts&action=delete&id=" + deleteId;
    } else {
        return false;
    }
}