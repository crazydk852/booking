<?php
 	include_once("config.php");
    session_start();
	if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<h1><?php echo getloginusernamefromadminid($_SESSION['admin_id']) ?> Dashboard <a href="logout.php"><small>Logout</small></a></h1>
<?php if($_SESSION['admin_role'] == 'admin'){ ?>
<h2>Admin List</h2>
<a href="addadmin.php">Add New</a>
<table border="1">
  <thead>
    <tr>
      <th style="text-align:center;">No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile No</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$no="0";
	$admin_id = $_SESSION['admin_id'];
    $select = mysqli_query($con,"SELECT * FROM admin_master ORDER BY admin_id = '$admin_id' ASC");
	while($row=mysqli_fetch_array($select))
	{ ?>
    <tr>
      <td><?php echo $no=$no+1; ?></td>
      <td><?php echo $row['admin_fullname']; ?></td>
      <td><?php echo $row['admin_email']; ?></td>
      <td><?php echo $row['admin_phone']; ?></td>
      <td><?php echo $row['admin_role']; ?></td>
      <td><a href="edit-admin.php?admin_id=<?php echo $row['admin_id']; ?>">Update</a> <a href="delete-admin.php?admin_id=<?php echo $row['admin_id']; ?>">Delete</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }?>
<?php if($_SESSION['admin_role'] == 'admin' || $_SESSION['admin_role'] == 'manager'){?>
<h2>Customer List</h2>
<a href="addcustomer.php">Add New</a>
<table border="1">
  <thead>
    <tr>
      <th style="text-align:center;">No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile No</th>
      <th>Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$no="0";
	$admin_id = $_SESSION['admin_id'];
    $select = mysqli_query($con,"SELECT * FROM customer_master ORDER BY admin_id = '$admin_id' ASC");
	while($row=mysqli_fetch_array($select))
	{ ?>
    <tr>
      <td><?php echo $no=$no+1; ?></td>
      <td><?php echo $row['customer_fullname']; ?></td>
      <td><?php echo $row['customer_email']; ?></td>
      <td><?php echo $row['customer_phone']; ?></td>
      <td><?php echo $row['customer_address']; ?></td>
      <td><a href="editcustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Update</a> <a href="deletecustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Delete</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }?>
<?php if($_SESSION['admin_role'] == 'customer'){ ?>
<?php
	$customer_id = '0';
	$customer_id = getcustomerid($customer_id);
    $select=mysqli_query($con,"SELECT * FROM customer_master where customer_id = '$customer_id'");
    while($row=mysqli_fetch_array($select))
    {
    ?>
Full Name: <?php echo $row["customer_fullname"]; ?><br>
Email: <?php echo $row["customer_email"]; ?><br>
Mobile No: <?php echo $row["customer_phone"]; ?><br>
Address: <?php echo $row["customer_address"]; ?><br><br>

<a href="editcustomer.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-primary">Profile Edit</a> 
<a href="chagepassword.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-primary">Change Password</a>
<?php }?>
<?php }?>
</body>
</html>