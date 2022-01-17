<?php
	require_once "pdo.php";                                                      //Add
	session_start();
	if (  !isset($_SESSION['user_id']) )
	{
		die('Not logged in');
	}
	if ( isset($_POST['cancel'] ) )
	{         //Check for login or index
		header("Location: admin.php");
		return;
	}

	function test_input($data)
	{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	if(isset($_POST['add']))
	{

		if(!isset($_POST['make']))
		{
						$_SESSION['error']="All fields are required";
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
					unset($_SESSION['error']);
		}

		else if(!isset($_POST['model']))
		{
						$_SESSION['error']="All fields are required";
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
					unset($_SESSION['error']);
		}
		else if(!isset($_POST['year']))
		{
						$_SESSION['error']="All fields are required";
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
					unset($_SESSION['error']);
		}
		else if(!isset($_POST['mileage']))
		{
						$_SESSION['error']="All fields are required";
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
					unset($_SESSION['error']);
		}
		else if( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage']))
		{


				if(is_numeric($_POST['year'])!=1)
				{
						$_SESSION['error']="Year must be numeric";
						echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
				}
				else if(is_numeric($_POST['mileage'])!=1)
				{
					$_SESSION['error']="Mileage must be numeric";
					echo('<p style="color: red;">'."Invalid mileage!!!"."</p>\n");
				}
				else
				{
					echo("<p>Handling POST data...</p>\n");
					$sql = "INSERT INTO autos (Name,auto_id,model,make,year,mileage) VALUES (:name,'', :model,:make,:year,:mileage)";
					$stmt = $pdo->prepare($sql);

					$stmt->execute(array(':name' => $_POST['name'],':model' => $_POST['model'],':make' => $_POST['make'],':year' => $_POST['year'],':mileage' => $_POST['mileage']));
					echo("Record inserted");

				}
		}
	}



	/*if ( isset($_POST['delete']) )
	{
		$sql = "DELETE FROM autos WHERE auto_id = :zip";
		//echo "<pre>\n$sql\n</pre>\n";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':zip' => $_POST['auto_id']));
	}
*/
?>
<!DOCTYPE html>
<html>
<head>
<title>Sean Manjaly 25d80b45</title>
</head>
<body>
	<p>Sean Manjaly </p>
<p>Add A New Vehicle</p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p>Name:
<input type="text" name='name'></p>
<p>Make:
<input type="text" name='make'></p>
<p>Model:
<input type="text" name='model' ></p>
<p>Year:
<input type="number" name='year' ></p>
<p>Mileage:
<input type="number" name='mileage' ></p>

<p>
<input type="submit" name="Add" value="Add"></p>


<p>
<input type="submit" name="cancel" value="Cancel"></p>
<!--<p>
<input type="submit" name="view" value="View collection"/></p>-->
</form>


</body>
</html>
