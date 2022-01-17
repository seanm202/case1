<?php
require_once "pdo.php";                                                                                              //Update
	session_start();
	if ( !isset($_SESSION['user_id']) ) {
	  die('Not logged in');
	}
	if(isset($_POST['save'])){
	if(isset($_POST['name']) && isset($_POST['email'])){
        $sql="UPDATE users SET name=:name,email=:email,Authority=:auth WHERE user_id=:user";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(':user'=>$_SESSION['varname'],':name'=>$_POST['name'],':email'=>$_POST['email'],':auth'=>$_POST['auth']));
		$_SESSION['success']='Record updated';
		header('Location:View.php');
	return;}
	}
	if(isset($_POST['cancel'])){
	header('Location:View.php');
	}
	?>
<!DOCTYPE html>
<html>
<head>
<title>SEAN MANJALY</title>
</head>
<body>
<h2>Edit user details</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

	<p>Name:
	<input type="text" name="name"></p>
	<p>Email:
	<input type="text" name="email" ></p>
	<p>Password:
	<input type="password" name="pass"></p>
	<p>Authority:
	<input type="text" name="auth"></p>
<p>
<input type="submit" name="save" value="Save"/></p>
<p>
<input type="submit" name="cancel" value="Cancel"></p>
<!--<p>
<input type="submit" name="view" value="View collection"/></p>-->
</form>
</body>
</html>
