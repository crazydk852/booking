<?php 
include_once("config.php");
session_start();

$customer_id = '0';
$customer_id = getcustomerid($customer_id);
$admin_id = $_SESSION['admin_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_password = $_POST['customer_password'];
	$customer_npassword = $_POST['customer_npassword'];
	$customer_cnpassword = $_POST['customer_cnpassword'];
	
	$change = 0;	
   
   	$select=mysqli_query($con,"SELECT * FROM admin_master WHERE admin_id = '$admin_id'");
	while($row=mysqli_fetch_array($select))
	{
		if($row['admin_phone'] == $customer_password)
		{
			$change = 1;
		}
		if($change == 1)
		{
			if ($customer_npassword != $customer_cnpassword)
			{
			echo "<script> 
					alert('Please enter the same password');
					window.location.href = 'chagepassword.php';
				  </script>";
			exit();
			} 
			else
			{
				$sql="UPDATE admin_master SET admin_phone='$customer_npassword' where admin_id='$admin_id'";
				if ($con->query($sql) === TRUE)
				{
					echo "<script> 
					alert('Your Password is successfully changed');
					window.location.href = 'dashboard.php';
					</script>";
					exit();
				}
			}
			
		}
		else
		{
			echo "<script> 
			alert('Your Old Password is wrong!');
			window.location.href = 'chagepassword.php';
			</script>";
			exit();
		}
		
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form  method="post">
  <div>
    <h1>Change Password</h1>
    <br />
    <label><b>Old Password:</b></label>
    <input type="text" name="customer_password" >
    <br />
    <br />
    <label><b>New Password:</b></label>
    <input type="text" name="customer_npassword" style="margin-right: 5px;">
    <br />
    <br />
    <label><b>Confirm New Password:</b></label>
    <input type="text" name="customer_cnpassword" style="margin-right: 60px;">
    <br />
    <br />
    <input type="submit" name="submit" value="Submit">
    <a href="dashboard.php" class="btn btn-primary">Back</a> </div>
  </div>
</form>
</body>
</html>