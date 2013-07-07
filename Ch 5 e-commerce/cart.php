<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/4/13
 * Time: 8:08 PM
 * To change this template use File | Settings | File Templates.
 */
  require_once('config.php');
  $page_title = 'Shopping Cart';
  include_once('header.php');

  echo '<h1>View Your Shopping Cart</h1>';

  // This page will either add to or update the
  // the shopping cart, based upon the value of $_REQUEST['do'];
  if (isset($_REQUEST['do']) && ($_REQUEST['do'] == 'add')) { //Add new item
    if (isset($_GET['sw_id'])) {
      $sw_id = (int) $_GET['sw_id'];

      if ($sw_id>0){
        $q = "SELECT name, color, size FROM general_widgets LEFT JOIN specific_widgets USING (gw_id) LEFT JOIN colors USING (color_id)
        LEFT JOIN sizes USING (size_id) WHERE sw_id=$sw_id";
        $r = mysqli_query($dbc, $q);

        if (mysqli_num_rows($r) == 1) {
          // Get the information
          list ($name, $color, $size) = mysqli_fetch_array($r, MYSQLI_NUM);

          // If the cart already contains
          // One of these widgets, increment the quantity
          if (isset($_SESSION['cart'][$sw_id])) {
            $_SESSION['cart'][$sw_id]++;

            // Display a message
            echo "<p>Another copy of '$name' in color $color, size $size has been added to your shopping cart.</p>\n";
          } else { // New to cart

            // Add to the cart
            $_SESSION['cart'][$sw_id] = 1;
            echo "<p>The widget '$name' in color $color, size $size has been added to your shopping cart.</p>\n";
          }

        } // End of mysqli_num_rows() IF

      } // End of ($sw_id > 0) IF

    } // End of isset($_GET['sw_id']) IF
