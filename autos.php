<?php
require_once "pdo.php";                                                        //View // Autos
session_start();
if ( !isset($_SESSION['user_id']) ) {
  die('Not logged in');
}


if (isset($_SESSION['flash'])) {
  echo('<p style="color: green;">'.$_SESSION['flash']."</p>\n");
   unset($_SESSION['flash']);
}
if (isset($_SESSION['delete'])) {
  echo('<p style="color: green;">'.$_SESSION['delete']."</p>\n");
   unset($_SESSION['delete']);
}

if ( isset($_POST['edit'] ) )
	{         //Check for login or index
		header("Location: Update.php");
		return;
	}

if ( isset($_POST['logout'] ) )
	{         //Check for login or index
		header("Location: Logout.php");
		return;
	}

	$stmt = $pdo->query("SELECT Name,auto_id,model,make,year,mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ( isset($_POST['delete']) ) {
	$_SESSION['varnam']=$_POST['autos_id'];
		header("Location: Delete.php");
		return;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
</head>
<body>
  <h2><?php
echo($_SESSION['name']);  ?></h2>
<form method="POST">
<p>
<input type="submit" name="logout" value="Logout"/></p>
</form>
<table border="1">
<tr>
  <th>Auto Id</th>
    <th>Name</th>
<th>Make</th>
  <th>Model</th>
<th>Year</th>
<th>Mileage</th>
<th>Action</th>
</tr>
<?php
foreach ( $rows as $row ) {
  echo "<tr><td>";
echo($row['auto_id']);
 echo("</td><td>");
echo($row['Name']);
 echo("</td><td>");
  echo($row['model']);
    echo("</td><td>");
  echo($row['make']);
echo("</td><td>");
  echo($row['year']);
    echo("</td><td>");
  echo($row['mileage']);
  echo("</td><td>\n");
//Modify for action
echo('<form method="POST"><input type="hidden" ');
  echo('name="auto_id" value="'.$row['auto_id'].'">'."\n");
  echo('<input type="submit" style="color: red;" name="delete" value="Del">'.'<input type="submit" style="color: green;" name="edit" value="Update">');
  echo("\n</form>\n");
  echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New Vehicle</a>
</body>
</html>
