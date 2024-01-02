<?php
function getloginusernamefromadminid($admin_id)
{
	global $con;
	$sql=mysqli_query($con,"SELECT * FROM admin_master WHERE admin_id = '$admin_id'");
	while($row=mysqli_fetch_array($sql))
	{
		return $row['admin_fullname'];
	}
}
function getcustomerid($customer_id)
{
	global $con;
	$admin_id = $_SESSION['admin_id'];
	$sql=mysqli_query($con,"SELECT * FROM customer_master WHERE admin_id = '$admin_id'");
	while($row=mysqli_fetch_array($sql))
	{
		return $row['customer_id'];
	}
}
?>