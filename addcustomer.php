<?php
include_once("config.php");
session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['submit'])) {
    $customer_fullname = $_POST['customer_fullname'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];
    $customer_password = $_POST['customer_password'];
    $customer_cpassword = $_POST['customer_cpassword'];
    $admin_role = $_POST['admin_role'];

    $current_date = date("Y-m-d H:i:s");

    $select = mysqli_query($con, "SELECT * FROM customer_master WHERE customer_email = '$customer_email'");
    $row = mysqli_fetch_assoc($select);

    if ($row)
	{
        echo "<script>
                alert('This Email Id is already registered!');
                window.location.href = 'addcustomer.php';
              </script>";
        exit();
    }
	if ($customer_password != $customer_cpassword)
	{
		echo "<script> 
				alert('Please enter the same password');
				window.location.href = 'addcustomer.php';
			  </script>";
		exit();
	}
	else
	{
        $sql = "INSERT INTO admin_master(admin_fullname, admin_email, admin_phone, admin_role, admin_datetime) VALUES  ('$customer_fullname','$customer_email','$customer_phone','$admin_role','$current_date')";
       
        mysqli_query($con, $sql);
		$admin_id = mysqli_insert_id($con);

        $sql = "INSERT INTO customer_master (admin_id, customer_fullname, customer_email, customer_phone, customer_address, customer_password, customer_datetime) VALUES  ('$admin_id', '$customer_fullname', '$customer_email','$customer_phone', '$customer_address', '$customer_password', '$current_date')";

        if (mysqli_query($con, $sql)) {
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
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
<form method="post">
  <div>
    <h1>Registration Form</h1>
    <br />
    <label><b>Full Name:</b></label>
    <input type="text" name="customer_fullname">
    <br />
    <label><b>Email ID:</b></label>
    <input type="text" name="customer_email">
    <br />
    <label><b>Phone No:</b></label>
    <input type="text" name="customer_phone">
    <br />
    <label><b>Addres</b></label>
    <textarea name="customer_address"></textarea>
    <br />
    <label><b>Password</b></label>
    <input type="text" name="customer_password">
    <br />
    <label><b>Confirm Password</b></label>
    <input type="text" name="customer_cpassword">
    <input type="text" name="admin_role" value="customer" hidden>
    <br />
    <input type="submit" name="submit" value="Submit">
    <a href="dashboard.php" class="btn btn-primary">Back</a>
  </div>
</form>
</body>
</html>