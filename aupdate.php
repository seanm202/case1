<?php
require_once "pdo.php";                                                                                              //Update
	session_start();
	if ( !isset($_SESSION['user_id']) ) {
	  die('Not logged in');
	}


if(isset($_POST['save']))
{
	if(!isset($_POST['name']))
	{
		echo("Name is missing!!!");

	}
	if(!isset($_POST['make']))
	{
		echo("Make is missing!!!");

	}

	else if(!isset($_POST['model']))
	{
		echo("Model is missing!!!");

	}
		else if(!isset($_POST['year']))
		{
			echo("Year is missing!!!");

		}
			else if(!isset($_POST['mileage']))
			{
				echo("Mileage is missing!!!");

			}
	else if( isset($_POST['name']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['model']) && isset($_POST['mileage']))
	{

			if (is_numeric($_POST['year'])!=1)
			{
				$_SESSION['error'] = "Year is invalid!";
				if ( isset($_SESSION['error']) )
				{
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
					unset($_SESSION['error']);
				}
			}
			else if (is_numeric($_POST['mileage'])!=1)
				{
					$_SESSION['error'] = "Mileage is invalid!";
					if ( isset($_SESSION['error']) )
					{
						echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
						unset($_SESSION['error']);
					}
				}
				//header("Location: login.php");
				return;
			}
			// return;

			else
			{
				//$_POST['user_id']=$_SESSION['user_id'];
				echo('<p style="color: blue;">'."Handling POST data..."."</p>\n");
				$sql = "INSERT INTO autos (Name,auto_id,make,year,mileage) VALUES (:name,'',:make,:year,:mileage)";
				$stmt = $pdo->prepare($sql);

				$stmt->execute(array(':name' => $_POST['name'],':make' => $_POST['make'],':year' => $_POST['year']':mileage' => $_POST['mileage']));
				echo('<p style="color: green;">'."Record inserted"."</p>\n");
			}

}



	if(isset($_POST['cancel'])){
	header('Location:autos.php');
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
<p>Make:
<input type="text" name="make" ></p>
<p>Year:
<input type="text" name="year" ></p>
<p>Mileage:
<input type="text" name="mileage" ></p>
<p>
<input type="submit" name="save" value="Save"/></p>
<p>
<input type="submit" name="cancel" value="Cancel"></p>
<!--<p>
<input type="submit" name="view" value="View collection"/></p>-->
</form>
</body>
</html>
