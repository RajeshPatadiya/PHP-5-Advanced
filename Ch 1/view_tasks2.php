<?php # Script 2.7 - view_tasks.php
$dbc = @mysqli_connect ('localhost', 'root', 'yourpasswordhere', 'test2') OR die ('<p>Could not connect to the database!</p></body></html>');

// Get the latest dates as timestamps:
$q = 'SELECT UNIX_TIMESTAMP(MAX(date_added)), UNIX_TIMESTAMP(MAX(date_completed)) FROM tasks';
$r = mysqli_query($dbc, $q);
list($max_a, $max_c) = mysqli_fetch_array($r, MYSQLI_NUM);

// Determine the greater timestamp
$max = ($max_a > $max_c) ? $max_a : $max_c;

// Create a cache interval in seconds:
$interval = 60 * 60 * 6; //24 hours

//Send the header:
header ("Last-Modified: " . gmdate('r', $max));
header ("Expires: " . gmdate("r", ($max+$interval)));
header ("Cache-Control: max-age=$interval");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>View Tasks</title>
</head>
<body>
<h3>Current To-Do List</h3>
<?php # Script 1.5 - view_tasks2.php

/*	This page shows all existing tasks.
 *	A recursive function is used to show the 
 *	tasks as nested lists, as applicable.
 *	Tasks can now be marked as completed.
 */

// Function for displaying a list.
// Receives one argument: an array.
function make_list ($parent) {

	// Need the main $tasks array:
	global $tasks;

	// Start an ordered list:
	echo '<ol>';
	
	// Loop through each subarray:
	foreach ($parent as $task_id => $todo) {
		
		// Display the item:
		// Start with a checkbox!
		echo <<<EOT
<li><input type="checkbox" name="tasks[$task_id]" value="done" /> $todo
EOT;
			
		// Check for subtasks:
		if (isset($tasks[$task_id])) { 
			
			// Call this function:
			make_list($tasks[$task_id]);
			
		}
			
		// Complete the list item:
		echo '</li>';
	
	} // End of FOREACH loop.
	
	// Close the ordered list:
	echo '</ol>';

} // End of make_list() function.

// Check if the form has been submitted:
if (isset($_POST['submitted']) && isset($_POST['tasks']) && is_array($_POST['tasks'])) {

	// Define the query:
	$q = 'UPDATE tasks SET date_completed=NOW() WHERE task_id IN (';
	
	// Add each task ID:
	foreach ($_POST['tasks'] as $task_id => $v) {
		$q .= $task_id . ', ';
	}
	
	// Complete the query and execute:
	$q = substr($q, 0, -2) . ')';
	$r = mysqli_query($dbc, $q);

	// Report on the results:
	if (mysqli_affected_rows($dbc) == count($_POST['tasks'])) {
		echo '<p>The task(s) have been marked as completed!</p>';
	} else {
		echo '<p>Not all tasks could be marked as completed!</p>';
	}

} // End of submission IF.

// Retrieve all the uncompleted tasks:
$q = 'SELECT task_id, parent_id, task FROM tasks WHERE date_completed="0000-00-00 00:00:00" ORDER BY parent_id, date_added ASC'; 
$r = mysqli_query($dbc, $q);

// Initialize the storage array:
$tasks = array();

while (list($task_id, $parent_id, $task) = mysqli_fetch_array($r, MYSQLI_NUM)) {

	// Add to the array:
	$tasks[$parent_id][$task_id] =  $task;

}

// For debugging:
//echo '<pre>' . print_r($tasks,1) . '</pre>';

// Make a form:
echo '<p>Check the box next to a task and click "Update" to mark a task as completed (it, and any subtasks, will no longer appear in this list).</p>
<form action="view_tasks2.php" method="post">
';

// Send the first array element
// to the make_list() function:
make_list($tasks[0]);

// Complete the form:
echo '<input name="submitted" type="hidden" value="true" />
<input name="submit" type="submit" value="Update" />
</form>
';

?>
</body>
</html>
