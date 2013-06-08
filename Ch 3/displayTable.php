<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Cities and Zip Codes</title>
	<style type="text/css" title="text/css" media="all">
h2 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; 
	font-size: 14pt;  
	color : #960;
	text-align: center;
}
td {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; 
	font-size: 10pt;  
	color : #333
}
.error {
	color: #F30;
}
</style>
</head>
<body>
<?php # Script 3.4 - display.php

/*	This page retrieves and displays all of the
 *	cities and zip codes for a particular state.
 *	The results will be shown in a table.
 */
 
// Abbreviation of state to show:
$state = 'Texas';

// Items to display per row:
$items = 5;

// Print a caption:
echo "<h2>Cities and Zip Codes found in $state</h2>\n";

// Connect to the database
$dbc = @mysqli_connect ('localhost', 'root', 'yourpasswordhere', 'zips') OR die ('<p>Could not connect to the database!</p></body></html>');

// Get the cities and zip codes, ordered by city
$q = "SELECT city, zip_code from zip_codes WHERE state='$state' ORDER BY  city";
$r = mysqli_query($dbc, $q);

// Retrieve the Results
if (mysqli_num_rows($r) > 0) {
	
	// Start a table
	echo '<table border="2" width="90%" cellspacing="3" cellpadding="3" align="center">';
	
	// Need a counter:
	$i = 0;
	
	// Retrieve each record:
	while(list($city, $zip_code) = mysqli_fetch_array($r, MYSQLI_NUM)) {
		
		// Do we need to start a new row?
		if ($i == 0) {
			echo "<tr>\n";
		}
	// Print the record:
	echo "\t<td align=\"center\">$city, $zip_code</td>\n";
	
	// Increment the counter:
	$i++;
	
		// DO we need to end the row
		if ($i == $items) {
			echo "</tr>\n";
			$i = 0; // Reset counter
		}
	
	} // ENDof ($i > 0) IF
	
	//Close the table
	echo '</table>';
} else {
	echo '<p class="error">An invalid state abbreviation was used</p>';
}
mysqli_close($dbc);
?>
</body>
</html>