<?php
require('db.php');
include("auth.php");
$id=$_REQUEST['id'];
$query = "SELECT * from catogries where id='$id'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard2.php">Dashboard</a> 
| <a href="insertc.php">Insert New Record</a> 
| <a href="logout.php">Logout</a></p>
<h1>Update Record</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
// $id=$_REQUEST['id'];
$name =$_REQUEST['product'];
$cat =$_REQUEST['catogry'];
$id=$_REQUEST['id'];
$submittedby = $_SESSION["username"];
$update="update catogries set
category-name ='$name',category-country ='$cat'
 where id= '$id' ";



// (id``,`product`,`catogry`)values
//     ( '$id','$name','$cat')"


mysqli_query($con, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='viewp.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="text" value="<?php echo $row['id'];?>" />
<p><input type="text" name="product" placeholder="Enter Name" 
required value="<?php echo $row['category-name'];?>" /></p>
<p><input type="text" name="catogry" placeholder="Enter Age" 
required value="<?php echo $row['category-country'];?>" /></p>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>
</div>
</div>
</body>
</html>