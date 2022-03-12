<?php
require('db.php');
// include("auth.php");
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
     $id = $_REQUEST['id'];
    $name =$_REQUEST['name'];
    $cat = $_REQUEST['cato'];
    $submittedby = $_SESSION["username"];
    $ins_query="insert into product
    (`id`,`product`,`catogry`)values
    ( '$id','$name','$cat')";
    mysqli_query($con,$ins_query)
    or die(mysql_error());
    $status = "New Record Inserted Successfully.
    </br></br><a href='viewp.php'>View Inserted Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard1.php">Dashboard</a> 
| <a href="viewp.php">View Records</a> 
| <a href="logout.php">Logout</a></p>
<div>
<h1>Insert New Record</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<p><input type="text" name="id" placeholder="id" required /></p>
<p><input type="text" name="name" placeholder=" Name" required /></p>
<p><input type="text" name="cato" placeholder="catogry" required /></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>