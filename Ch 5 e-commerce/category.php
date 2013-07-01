<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 6/30/13
 * Time: 7:55 PM
 * To change this template use File | Settings | File Templates.
 */


require_once('config.php');
$category = NULL;
if(isset($_GET['cid'])) {
    $cid = (int) $_GET['cid'];
    // An invalid value of $cid gets switched to 0

    if($cid > 0){
        // Get the info
        $q = "SELECT category, description FROM categories WHERE category_id=$cid";
        $r = mysqli_query($dbc, $q);

        // Fetch the info
        if(mysqli_num_rows($r) == 1){
            list($category, $description) = mysqli_fetch_array($r, MYSQLI_NUM);
        }


    }
}

// Use the category as the page title:
if ($category) {
    $page_title = $category;
}

// Include the header file:
include_once ('./includes/header.html');

if ($category) { // Show the products.

    echo "<h1>$category</h1>\n";

    // Print the category description, if it's not empty.
    if (!empty($description)) {
        echo "<p>$description</p>\n";
    }

    // Get the widgets in this category:
    $q = "SELECT gw_id, name, default_price, description FROM general_widgets WHERE category_id=$cid";
    $r = mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) > 1) {

        // Print each:
        while (list($gw_id, $wname, $wprice, $wdescription) = mysqli_fetch_array($r, MYSQLI_NUM)) {

            // Link to the product.php page:
            echo "<h2><a href=\"product.php?gw_id=$gw_id\">$wname</a></h2><p>$wdescription<br />\$$wprice</p>\n";

        } // End of while loop.

    } else { // No widgets here!
        echo '<p class="error">There are no widgets in this category.</p>';
    }

} else { // Invalid $_GET['cid']!
    echo '<p class="error">This page has been accessed in error.</p>';
}

// Include the footer file to complete the template:
include_once ('./includes/footer.html');

