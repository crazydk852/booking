<?php 
session_start();
if(isset($_SESSION['admin_role']) && !empty($_SESSION['admin_role']))
{	
	if(isset($_SESSION['category_id']) && !empty($_SESSION['category_id'])) { $category_id = $_SESSION['category_id']; }
}
else 
{
	echo "<script type='text/javascript'>";
	echo "window.location='../logout.php'";
	echo "</script>";
} 
?>
