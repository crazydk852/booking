<?php
include('config.php');
include('sismaster.php');
$action = $_REQUEST['action'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript">
function formaction(ID,ID1)
{
	window.location = "category.php?action=set&act="+ ID + "&category="+ ID1;
}
function formaction1(ID)
{
	window.location = "category.php?action=set&act="+ ID;
}
function confirmDelete()
{
    return confirm("Are you sure you want to delete this record?");
}
</script>
</head>
<body>
<?php if($action == "list" || $action == "edit" ){  ?>
<a  href="javascript:formaction1(<?php echo "1";?>)" class="btn btn-primary">Add new </a>
<?php } ?>
<?php if($action == "add") {?>
<form method="post">
  <div> <br />
    <label><b>Name</b></label>
    <input type="text" name="category_name">
    <br />
    <label><b>Price</b></label>
    <input type="text" name="category_price">
    <br />
    <label><b>Code</b></label>
    <input type="text" name="category_code">
    <br />
    <input type="submit" name="submit" value="Submit">
  </div>
</form>
<?php
if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];
    $category_price = $_POST['category_price'];
    $category_code = $_POST['category_code'];
	
    $current_date = date("Y-m-d H:i:s");

    $select = mysqli_query($con, "SELECT * FROM category_master WHERE category_name = '$category_name'");
    $row = mysqli_fetch_assoc($select);

    if ($row)
	{
        echo "<script>
                alert('This Category Name is already registered!');
                window.location.href = 'category.php';
              </script>";
        exit();
    }
	else
	{
        $sql = "INSERT INTO category_master(category_name, category_price, category_code, category_datetime) VALUES  ('$category_name','$category_price','$category_code','$current_date')";
       
        mysqli_query($con, $sql);
		$category_id = mysqli_insert_id($con);
		
		echo "<script type='text/javascript'>";
		echo "window.location='category.php?action=edit'";
		echo "</script>";

    }
}
?>
<?php }if($action == "list") {?>
<table border="1">
  <thead>
    <tr>
      <th style="text-align:center;">No</th>
      <th>Name</th>
      <th>Price</th>
      <th>Code</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$no="0";
	$category_id = $_SESSION['category_id'];
    $select = mysqli_query($con,"SELECT * FROM category_master ORDER BY category_id ASC");
	while($row=mysqli_fetch_array($select))
	{ ?>
    <tr>
      <td><?php echo $no=$no+1; ?></td>
      <td><?php echo $row['category_name']; ?></td>
      <td><?php echo $row['category_price']; ?></td>
      <td><?php echo $row['category_code']; ?></td>
      <td><a href="javascript:formaction(<?php echo "2" ?>,<?php echo $row['category_id']; ?>)">Update</a> <a href="javascript:if(confirmDelete())formaction(<?php echo "3"; ?>,<?php echo $row['category_id']; ?>)">Delete</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php }if($action == "edit") {?>
<?php 
    $select=mysqli_query($con,"SELECT * FROM category_master where category_id='$category_id'");
    while($row=mysqli_fetch_array($select))
    {
    ?>
<form method="post">
  <div>
    <h1>Registration Form</h1>
    <label><b>Name</b></label>
    <input type="text" name="category_name" value="<?php echo $row["category_name"]; ?>">
    <br />
    <label><b>Price</b></label>
    <input type="text"name="category_price" value="<?php echo $row["category_price"]; ?>">
    <br />
    <label><b>Code</b></label>
    <input type="text" name="category_code" value="<?php echo $row["category_code"]; ?>">
    <br />
    <input type="submit" name="submit" value="Submit">
    <a href="dashboard.php" class="btn btn-primary">Back</a> </div>
</form>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_name= $_POST["category_name"];
	$category_price= $_POST["category_price"];
	$category_code= $_POST["category_code"];
	
   $sql = "UPDATE category_master SET category_name='$category_name', category_price='$category_price', category_code='$category_code'  WHERE category_id='$category_id'";
	mysqli_query($con,$sql);
	
	echo "<script type='text/javascript'>";
	echo "window.location='category.php?action=list'";
	echo "</script>";
}
?>
<?php }?>
<?php } 
if($action == "delete")
{ 
	$delete = mysqli_query($con,"delete from category_master where category_id  = '$category_id'");
	
	echo "<script type='text/javascript'>";
	echo "window.location='category.php?action=list'";
	echo "</script>";
}
?>
<?php if($action != "list") {?>
<?php } 
if($action == 'set') 
{	
	$act = $_REQUEST['act'];
	$actionvalue = "";
	
	$category_id = $_REQUEST['category'];
	if($category_id != NULL){ $_SESSION['category_id'] = $category_id; }
	
	if($act == "1"){ $actionvalue = "add"; }
	if($act == "2"){ $actionvalue = "edit"; }
	if($act == "3"){ $actionvalue = "delete"; }
	if($act == "4"){ $actionvalue = "view"; }
	if($act == "5"){ $actionvalue = "list"; }
	
	if($act == "1")
	{ 
		echo "<script type='text/javascript'>";
		echo "window.location='category.php?action=add'";
		echo "</script>";
	}
	if($act == "2")
	{ 
		echo "<script type='text/javascript'>";
		echo "window.location='category.php?action=edit'";
		echo "</script>";
	}
	if($act == "3")
	{ 
		echo "<script type='text/javascript'>";
		echo "window.location='category.php?action=delete'";
		echo "</script>";
	}
	if($act == "5")
	{ 
		echo "<script type='text/javascript'>";
		echo "window.location='category.php?action=list'";
		echo "</script>";
	}
}
?>
</body>
</html>