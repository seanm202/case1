<?php
require_once "pdo.php";                                                        //View
session_start();
if ( !isset($_SESSION['user_id']) ) {
  die('Not logged in');
}

if (isset($_SESSION['flash'])) {
  echo('<p style="color: green;">'.$_SESSION['flash']."</p>\n");
   unset($_SESSION['flash']);
}

if ( isset($_POST['View'] ) || isset($_POST['Uup'] ) )
	{         //Check for login or index
    if ( isset($_SESSION['Authority'] )=='Admin' )
    	  {
		        header("Location: admin.php");
		        return;
        }
    else {
       echo("You are not allowed access to this section.");
    }
  }


  if ( isset($_POST['Vehicle'] ) )
  	{         //Check for login or index
  		header("Location: autos.php");
  		return;
  	}


if ( isset($_POST['logout'] ) )
	{         //Check for login or index
		header("Location: Logout.php");
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
  <input type="submit" name="Vehicle" value="View Vehicle Database"/>
</p>
  <p>
  <input type="submit" name="View" value="View User Database"/>
</p>
  <p>
  <input type="submit" name="Uup" value="Update User database/Add users"/>
</p>
<input type="submit" name="logout" value="Logout"/></p>
</form>
</body>
</html>
