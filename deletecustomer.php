<?php
include_once("config.php");
session_start();
	if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
	}
$customer_id = $_GET['customer_id'];
if(isset($_GET['customer_id']))
{
    $sql = "DELETE FROM customer_master WHERE customer_id=$customer_id";
    $result = $con->query($sql);
    
    header('Location: dashboard.php');
    exit();
}
?>