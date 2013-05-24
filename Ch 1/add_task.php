<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Add a Task</title>
</head>
<body>
<?php # Script 1.2 - add_task.php

/*	This page adds tasks to the tasks table.
 *	The page both displays and handles the form.
 */
 
 
// Connect to the database:
$dbc = @mysqli_connect ('localhost', 'root', 'yourpasswordhere', 'test2') OR die ('<p>Could not connect to the database!</p></body></html>');

//Check if the form has been submitted:
if (isset($_POST['submitted']) && !empty($_POST['task'])) {
	//Sanctify the input
	//parent_id must be an integer
	if(isset($_POST['parent_id'])){
		$parent_id = (int) $_POST['parent_id'];
	} else {
		$parent_id = 0;
	}
	
	//Escape the task
	//Assumes Magic Quotes are off
	$task = mysqli_real_escape_string($dbc, $_POST['task']);
	
	//Add the task to the database
	$q = "INSERT INTO tasks (parent_id, task) VALUES ($parent_id, '$task')";
	$r = mysqli_query($dbc, $q);
	
	//Report on the results
	if (mysqli_affected_rows($dbc) == 1){
		echo '<p>THe task has been added!</p>';
	} else {
		echo '<p>THe task could not be added!</p>';
	}
} // END of submission


//Display the form:
echo '<form action="Add_task.php" method="post">
<fieldset>
<legend>Add a Task</legend>

<p>Task: <input name="task" type="text" size="60" maxlength="100" /></p>

<p>Parent Task: <select name="parent_id"><option value="0">None</option>';

//Retrieve all uncompleted tasks:
$q = 'SELECT task_id, parent_id, task FROM tasks WHERE date_completed = "0000-00-00 00:00:00" ORDER BY date_added ASC';
$r = mysqli_query($dbc, $q);

//Also store the tasks in an array for use later:
$tasks = array();

while (list($task_id, $parent_id, $task) = mysqli_fetch_array($r, MYSQLI_NUM)) {
	// Add to the select menu:
	echo "<option value=\"$task_id\">$task</option>\n";
	
	//Add to the array
	$tasks[] = array('task_id' => $task_id, 'parent_id' => $parent_id, 'task' => $task);
}

echo '</select></p>

<input name="submitted" type="hidden" value="true"/>
<input name="submit" type="submit" value="Add This Task" />

</fieldset>
</form>
';

//Sort the task by parent_id
function parent_sort($x, $y) {
	return ($x['parent_id'] > $y['parent_id']);
}
usort($tasks, 'parent_sort');

//Display all the tasks
echo '<h3>Current To-Do List</h3><ul>';
foreach ($tasks as $task) {
	echo "<li>{$task['task']}</li>\n";
}
echo '</ul>';
?>
</body>
</html>