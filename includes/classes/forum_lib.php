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

        foreach ($array as $category) {

            // Subcategories query
            $category_id = $category['id'];
            $query2 = "SELECT * FROM forum_subcategories WHERE parent_id='$category_id' ORDER BY id";
            $result2 = $mysqli_cms->query($query2);
            $array2 = $result2->fetch_all(MYSQLI_ASSOC);

            ?>
            <div class="table-wrapper">
                <div class="table-top">
                    <div class="table-title"><?= $category['name']; ?></div>
                </div>
                <div class="table-body">
                    <table class="table">
                        <thead>
                        <tr class="black-bar">
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col"></th>
                            <th scope="col">Last Post By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($array2 as $subcategory) {
                            ?>
                            <tr>
                                <td class="text-center"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                                <td><?= $subcategory['name']; ?></td>
                                <td></td>
                                <td>@admin</td>
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

}