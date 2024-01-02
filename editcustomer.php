<?php 
include_once("config.php"); 

$customer_id = $_GET["customer_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_fullname= $_POST["customer_fullname"];
    $customer_email= $_POST["customer_email"];
	$customer_phone= $_POST["customer_phone"];
	$customer_address= $_POST["customer_address"];
	
   
   $sql = "UPDATE customer_master SET customer_fullname='$customer_fullname', customer_email='$customer_email', customer_phone='$customer_phone', customer_address='$customer_address' WHERE customer_id='$customer_id'";
	
    if ($con->query($sql) === TRUE) {
        header('Location: dashboard.php');
exit;
    } else {
        echo "Error updating record: " . $con->error;
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
<?php 
    $select=mysqli_query($con,"SELECT * FROM customer_master where customer_id='$customer_id'");
    while($row=mysqli_fetch_array($select))
    {
    ?>
<form method="post">
  <div>
    <h1>Registration Form</h1>
    <label><b>Full Name:</b></label>
    <input type="text" name="customer_fullname" value="<?php echo $row["customer_fullname"]; ?>">
    <br />
    <label><b>Email ID:</b></label>
    <input type="text"name="customer_email" value="<?php echo $row["customer_email"]; ?>">
    <br />
    <label><b>Phone No:</b></label>
    <input type="text" name="customer_phone" value="<?php echo $row["customer_phone"]; ?>">
    <br />
    <label><b>Address</b></label>
    <input type="text" name="customer_address" value="<?php echo $row["customer_address"]; ?>">
    <br />
    <input type="submit" name="submit" value="Submit">
    <a href="dashboard.php" class="btn btn-primary">Back</a> </div>
</form>
<?php }?>
</body>
</html>