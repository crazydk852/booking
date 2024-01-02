<?php
include "config.php";
session_start();

if (isset($_POST['submit']) == 'submit')
{
	if(count($_POST)>0)
	{
		$result = mysqli_query($con,"SELECT * FROM admin_master WHERE admin_email='" . $_POST["username"] . "' and admin_phone = '". $_POST["password"]."'");
        $row  = mysqli_fetch_array($result);
		
        if(is_array($row))
		{
			$_SESSION["admin_role"] = $row['admin_role'];
			$_SESSION["admin_id"] = $row['admin_id'];
		}
		else
		{
			echo  "<script> alert('Invalid Username And Password!');
				document.location.href = 'login.php';
				</script>";
        }
    }
    if(isset($_SESSION["admin_id"]))
	{
    	header("Location:dashboard.php");																																																																																																			
    }
}?> 
<!DOCTYPE html>
<html>
<head>
<style></style>
</head>
<body style="text-align:center">
<h2>Sing Up</h2>
<form method="post">
  <div>
    <label>Username:</label>
    <input type="text" name="username" required>
    <br><br>
    <label>Password:</label>
    <input type="password" name="password" required>
    <br><br>
    <input type="submit" value="Submit" name="submit">
    </div>
</form>
</body>
</html>
