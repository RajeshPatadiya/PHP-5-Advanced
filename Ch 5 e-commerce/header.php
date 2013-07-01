<?php # Script 5.2 - header.html

/* 
*	This page begins the HTML header for the site.
*	The header also creates the right-hand column.
*	This page calls session_start().
*/

// Need sessions!
session_start();

// Check for a $page_title value:
if (!isset($page_title)) $page_title = 'WoW::World of Widgets!'; include("config.php");
?><!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo $page_title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="all">

    <div class="box">
        <div class="menu"><a href="#">home</a><a href="#">about</a><a href="#">products</a><a href="#">contact</a></div>
        <div class="header"><img alt="" style="float:right; " src="./images/www.jpg" width="225" height="95" />
            <h1>[<span class="style1">WoW</span>] World of Widgets</h1>
            <div class="clearfix"></div>
        </div>

        <div class="newsbar">
            <h1>Browse Widget Categories</h1>
            <div class="p2"><ul>
                    <?php
                    // Get all the categories and
                    // link them to category.php.

                    // Define and execute the query:
                    $q = 'SELECT category_id, category FROM categories ORDER BY category';
                    $r = mysqli_query($dbc, $q);

                    // Fetch the results:
                    while (list($fcid, $fcat) = mysqli_fetch_array($r, MYSQLI_NUM)) {

                        // Print as a list item.
                        echo "<li><a href=\"category.php?cid=$fcid\">$fcat</a></li>\n";

                    } // End of while loop.

                    ?></ul></div>

            <h1>Cart Contents?</h1>
            <div class="p2">You could use this area to show something regarding the cart.</div>

            <h1>Specials?</h1>
            <div class="p2">
                <p>Maybe place specials or new items or related items here.</p>
            </div>

        </div>

        <div class="content">
