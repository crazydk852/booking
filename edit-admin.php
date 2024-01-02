<?php 
include_once("config.php"); 

$admin_id = $_GET["admin_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $admin_fullname= $_POST["admin_fullname"];
    $admin_email= $_POST["admin_email"];
	$admin_phone= $_POST["admin_phone"];
	$admin_role= $_POST["admin_role"];
	
   
   $sql = "UPDATE admin_master SET admin_fullname='$admin_fullname', admin_email='$admin_email', admin_phone='$admin_phone', admin_role='$admin_role' WHERE admin_id='$admin_id'";
	
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
    $select=mysqli_query($con,"SELECT * FROM  admin_master where admin_id='$admin_id'");
    while($row=mysqli_fetch_array($select))
    {
    ?>
<form method="post">
  <div>
    <h1>Registration Form</h1>
    <label><b>Full Name:</b></label>
    <input type="text" name="admin_fullname" value="<?php echo $row["admin_fullname"]; ?>">
    <br />
    <label><b>Email ID:</b></label>
    <input type="text"name="admin_email" value="<?php echo $row["admin_email"]; ?>">
    <br />
    <label><b>Phone No:</b></label>
    <input type="text" name="admin_phone" value="<?php echo $row["admin_phone"]; ?>">
    <br />
    <label><b>Role:</b></label>
    <select type="text" name="admin_role" style="margin-right: 73px;">
      <option value="<?php echo $row["admin_role"]; ?>"><?php echo $row["admin_role"]; ?></option>
      <option value="admin">Admin</option>
      <option value="manager">Manager</option>
      <option value="manager">Customer</option>
    </select>
    <br />
    <input type="submit" name="submit" value="Submit">
    <a href="dashboard.php" class="btn btn-primary">Back</a> </div>
</form>
<?php }?>
</body>
</html>