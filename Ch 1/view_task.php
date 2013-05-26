<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>View Tasks</title>
</head>
<body>
<h3>Current To-Do List</h3>
<?php # Script 1.3 - view_tasks.php

/*	This page shows all existing tasks.
 *	A recursive function is used to show the 
 *	tasks as nested lists, as applicable.
 */

// Function for displaying a list.
// Receives one argument: an array.
function make_list($parent){
	
	// Need the main $tasks array
	global $tasks;
	
	// Start an ordered list:
	echo '<ol>';
	
	// Loop through each subarray:
	foreach ($parent as $task_id => $todo){
		echo '
		
		<li><input type="checkbox" name="tasks[$task_id]" value="done" />' . "$todo";		
		
		// Check for subtasks
		if (isset($tasks[$task_id])){
			make_list($tasks[$task_id]);
		}
	} // END of foreach loop
	
	// Close the ordered list
	echo '</ol>';
	
} // END of make_list() function


$dbc = @mysqli_connect ('localhost', 'root', 'yourpasswordhere', 'test2') OR die ('<p>Could not connect to the database!</p></body></html>');

if (isset($_POST['submitted']) && isset($_POST['tasks']) && is_array($_POST['tasks'])){
	$q = 'UPDATE tasks SET date_completed=NOW() WHERE task_id IN (';
	
	// Add each task ID:
	foreach ($_POST['tasks'] as $task_id => $v) {
		$q .= $task_id . ', ';
	}
	
	// Complete the query and execute:
	$q = substr($q, 0, -2) . ')';
	$r = mysqli_query($dbc, $q);
	
	if (mysqli_affected_rows($dbc) == count($_POST['tasks'])){
		echo '<p>The task(s) have been marked as completed!</p>';
	} else {
		echo '<p>Not all tasks could be marked as completed!</p>';
	}
	
}



// Retrieve all the uncompleted tasks
$q = 'SELECT task_id, parent_id, task FROM tasks WHERE date_completed="0000-00-00 00:00:00" ORDER BY parent_id, date_added ASC'; 
$r = mysqli_query($dbc, $q);

// Initialize the storage array
$tasks = array();

while (list($task_id, $parent_id, $task) = mysqli_fetch_array($r, MYSQLI_NUM)) {

	// Add to the array:
	$tasks[$parent_id][$task_id] =  $task;

}

// For debugging:
//echo '<pre>' . print_r($tasks,1) . '</pre>';
echo '<p>Check the next box to mark task as completed</p>
<form action="view_task.php" method="post">
';
// Send the first array element
// to the make_list() function:
make_list($tasks[0]);

// Complete the form
echo '<input name="submitted" type="hidden" value="true" />
<input name="submit" type="submit" value="Update" />
</form>
';
printf('b: %b', 80);
?>
</body>
Love everything
</html>
 