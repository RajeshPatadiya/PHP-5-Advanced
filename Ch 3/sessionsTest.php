<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 6/1/13
 * Time: 10:05 AM
 * To change this template use File | Settings | File Templates.
 */

// Include the sessions file:
// The file already starts the session.
require_once('sessions1.php');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title>DB Session Test</title>
</head>
<body>
<?php

// Store some dummy data in the session,
// if no data is present.
if (empty($_SESSION)) {

    $_SESSION['blah'] = 'umlaut';
    $_SESSION['this'] = 3615684.45;
    $_SESSION['that'] = 'blue';

    // Print a message indicating what's going on:
    echo '<p>Session data stored.</p>';

} else { // Print the already-stored data.
    echo '<p>Session Data Exists:<pre>' . print_r($_SESSION, 1) . '</pre></p>';
}

// Log the user out, if applicable:
if (isset($_GET['logout'])) {

    session_destroy();
    echo '<p>Session destroyed.</p>';

} else { // Print the "Log Out" link:
    echo '<a href="sessionsTest.php?logout=true">Log Out</a>';
}

// Print out the session data:
echo '<p>Session Data:<pre>' . print_r($_SESSION, 1) . '</pre></p>';

?>
</body>
</html>
<?php session_write_close(); ?>
