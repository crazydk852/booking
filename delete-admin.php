<?php
include_once("config.php");
session_start();
	if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
	}
$admin_id = $_GET['admin_id'];
if(isset($_GET['admin_id']))
{
    $sql = "DELETE FROM admin_master WHERE admin_id=$admin_id";
    $result = $con->query($sql);
    
    header('Location: dashboard.php');
    exit();
}
?>