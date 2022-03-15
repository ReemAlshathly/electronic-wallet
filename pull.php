<?php
require('db.php');

$id=$_REQUEST['id'];
$query = "SELECT * from wallet  where userid='$id'"; 


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

<h1 style="width:50%;color:rgb(80, 70, 115);height: 10%;border:none ;margin-left:37%">Withdraw from Your Wallet </h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
// $id=$_REQUEST['id'];
$name =$_REQUEST['name'];
$cat =$_REQUEST['pouns'];
$id=$_REQUEST['id'];
$result=$row['pouns']; 
// $submittedby = $_SESSION["username"];
$update="update wallet set
pouns ='$result'-'$cat'
 where userid= '$id' ";



// (id``,`product`,`catogry`)values
//     ( '$id','$name','$cat')"

if ($result>=$cat){
 mysqli_query($con, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='viewp.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';}
else{
    $status = "you cant pull from wallet becouse your account less than . </br></br>
    <a  href='viewp.php'>back to wallet</a>";
    echo '<p style="color:rgb(152, 127, 175); margin-left: 37%;">'.$status.'</p>';  
}
}else {
?>
<div style="margin-top: 6%; margin-left: 35%;">
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" style="width=50%"/>
<input name="id" type="hidden" value="<?php echo $row['userid'];?>" />
<p><input type="hidden" name="name" placeholder="Enter Name" 
required value="<?php echo $row['userid'];?>" /></p>
<p><input type="text" name="pouns" placeholder="Enter Age" 
required value="<?php echo $row['pouns'];?>" style="width:50%"/></p>
<p><input name="submit" type="submit" value="Withdraw" style="width:50%;background:rgb(100, 87, 135);color:white;height: 10%;border:none"/></p>
</form>
<?php } ?>
</div>
</div>
</body>
</html>