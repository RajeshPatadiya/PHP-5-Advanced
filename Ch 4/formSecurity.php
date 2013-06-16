<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title>Registration Form</title>
</head>
<body>
<?php # Script 4.1 - register.php

/*	This page creates a registration form
 *	which is then validated using various functions.
 */

if (isset($_POST['submitted'])) { // Handle the form.

    // Store errors in an array:
    $errors = array();

    // Check for non-empty name
    if (!isset($_POST['name']) OR empty($_POST['name'])){
        $errors[] = 'name';
    }

    // Validate the email address using eregi():
    if (!eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$', $_POST['email'])) {
        $errors[] = 'email address';
    }

    // Validate the password using ctype_alnum():
    if (!ctype_alnum($_POST['pass'])) {
        $errors[] = 'password';
    }

    // Validate the date of birth using check_date():
    if(isset($_POST['dob']) AND (strlen($_POST['dob']) >= 8) AND (strlen($_POST['dob']) <= 10) ) {
        $dob = explode('/', $_POST['dob']);

        // Were three parts returned?
        if (count($dob) == 3){

            // Is it a valid date
            if (!checkdate((int) $dob[0], (int) $dob[1], (int)$dob[2])){
                $errors[] = 'date of birth';
            }
        } else { // Invalid format}
            $errors[] = 'date of birth';
        }

    } else { // Empty or not the right length
        $errors[] = 'date of birth';
    }
        // Validate the ICQ number using ctype_digit():
    if (!ctype_digit($_POST['icq'])){
        $errors[] = 'ICQ Number';
    }

    // Check for non-empty comments:
    if (!isset($_POST['comments']) OR empty($_POST['comments'])) {
        $errors[] = 'comments';
    }

    if (empty($errors)) { // Success!

        // Print a message and quit the script:
        echo '<p>You have successfully registered (but not really).</p></body></html>';
        exit();

    } else { // Report the errors.

        echo '<p>Problems exist with the following field(s):<ul>';

        foreach ($errors as $error) {
            echo "<li>$error</li>\n";
        }

        echo '</ul></p>';

    }

} // End of $_POST['submitted'] IF.

// Show the form.
?>

<form method="post">
    <fieldset>
        <legend>Registration Form</legend>
        <p>Name: <input type="text" name="name" /></p>
        <p>Email Address: <input type="text" name="email" /></p>
        <p>Password: <input type="password" name="pass" /> (Letters and numbers only.)</p>
        <p>Date of Birth: <input type="text" name="dob" value="MM/DD/YYYY" /></p>
        <p>ICQ Number: <input type="text" name="icq" /></p>
        <p>Comments: <textarea name="comments" rows="5" cols="40"></textarea></p>

        <input type="hidden" name="submitted" value="true" />
        <input type="submit" name="submit" value="Submit" />
    </fieldset>
</form>

</body>
</html>
