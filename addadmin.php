<?php
include_once("config.php");
session_start();

$admin_id = $_SESSION['admin_id'];

if (isset($_POST['submit'])) {
    $admin_fullname = $_POST['admin_fullname'];
    $admin_email = $_POST['admin_email'];
    $admin_phone = $_POST['admin_phone'];
    $admin_role = $_POST['admin_role'];

    $current_date = date("Y-m-d H:i:s");

    $select = mysqli_query($con, "SELECT * FROM admin_master WHERE admin_email = '$admin_email'");
    $row = mysqli_fetch_assoc($select);

    if ($row) {
        echo "<script>
                alert('This Email Id is already registered!');
                window.location.href = 'addadmin.php';
              </script>";
        exit();
    } else {
        $select = "INSERT INTO admin_master(admin_fullname, admin_email, admin_phone, admin_role, admin_datetime) VALUES  ('$admin_fullname','$admin_email','$admin_phone','$admin_role','$current_date')";

        if (mysqli_query($con, $select)) {
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
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
    <input type="text" name="admin_fullname" style="margin-right: 10px;">
    <br />
    <br />
    <label><b>Email ID:</b></label>
    <input type="text"name="admin_email">
    <br />
    <br />
    <label><b>Phone No:</b></label>
    <input type="text" name="admin_phone" style="margin-right: 10px;">
    <br />
    <br />
    <label><b>Role:</b></label>
    <select type="text" name="admin_role" style="margin-right: 73px;">
      <option value="">-select-</option>
      <option value="admin">Admin</option>
      <option value="manager">Manager</option>
      <option value="manager">Customer</option>
    </select>
    <br />
    <br />
    <input type="submit" name="submit" value="Submit">
    <a href="dashboard.php" class="btn btn-primary">Back</a>
  </div>
</form>
</body>
</html>