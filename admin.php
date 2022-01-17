<?php
require_once "pdo.php";                                                        //View
session_start();
if ( !isset($_SESSION['user_id']) ) {
  die('Not logged in');
}
//Check for login or index
else if ( isset($_SESSION['Authority'] )!='Admin' )
{
die("You are not allowed access to this section.");
}
//////////////////////Delete

if ( isset($_POST['delete']) ) {
	$_SESSION['varname']=$_POST['user_id'];
		header("Location: Delete.php");
		return;
}
//////////////////////////////////////////

//////////////////////////Edit
if ( isset($_POST['edit'] ) )
	{         //Check for login or index
    $_SESSION['varname']=$_POST['user_id'];
		header("Location: Update.php");
		return;
	}
  ///////////////////////////////////////

///////////////////////////////////////////PHP for changes

$stmt = $pdo->query("SELECT user_id,name,email,Authority FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

///////////////////////////////////////////
?>
<html>
<head>
<title>Admin Panel</title>
</head>
<body>
	<form method="POST">
	<p>
<input type="submit" name="logout" value="Logout"/></p>
</form>
<table border="1">
<tr>
    <th>User Id</th>
	<th>Name</th>
    <th>Email</th>
      <th>Authority</th>
        <th>Action</th>
  </tr>
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
echo($row['user_id']);
   echo("</td><td>");
    echo($row['name']);
	    echo("</td><td>");
    echo($row['email']);
	    echo("</td><td>");
    echo($row['Authority']);
    echo("</td><td>\n");
	echo('<form method="POST"><input type="hidden" ');
    echo('name="user_id" value="'.$row['user_id'].'">'."\n");
    echo('<input type="submit" style="color: red;" name="delete" value="Del">'.'<input type="submit" style="color: green;" name="edit" value="Update">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
</table>
<a href="useradd.php">Add New User</a>

</html>
