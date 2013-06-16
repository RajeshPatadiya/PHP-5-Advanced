<?php 

require('Benchmark/Timer.php');
$timer = new Benchmark_Timer();
$timer->start();
$conn = new mysqli('localhost', 'phpsolstest', 'yourpasswordhere', 'phpsols');
$sql = 'SELECT * FROM blog ORDER BY created DESC';
$result = $conn->query($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<style>
td {padding-left: 20px; padding-right:20px; border:1px solid black;}
</style>
<meta charset="utf-8">
<title>Manage Blog Entries</title>
<link href="../styles/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Manage Blog Entries</h1>
<p><a href="insert.php">Insert new entry</a></p>
<table>
  <tr>
    <th scope="col">Created</th>
    <th scope="col">Title</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <?php while($row = $result->fetch_assoc()) {?>
  <tr>
    <td><?php echo $row['created']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><a href="update.php?article_id=<?php echo $row['article_id']; ?>">EDIT</a></td>
    <td><a href="delete.php?article_id=<?php echo $row['article_id']; ?>">DELETE</a></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
<?php

$timer->stop();
$timer->display();
?>