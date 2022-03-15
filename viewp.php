<?php
session_start();
require('db.php');
 include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form" style=";
   
    margin-left: 10%;"">
<p><a href="index.php">Home</a> 
|  
| <a href="logout.php">Logout</a></p>
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<?php
$user=$_SESSION['username'];
$count=1;
$sel_query="Select pouns,userid from wallet,users where wallet.userid=users.id  ;";
$result = mysqli_query($con,$sel_query);?>
<h2 style="margin-left: 30%;">Welcom <?php echo $user ?> to your wallet </h2>

<table width="90px" border="1" style="border-collapse:separate;margin-left: 10%;font-size: 25px; align-content: center;justify-content: center;" class="tbl-cart">
<thead>
<tr style="background:rgb(152, 127, 175);color:white;height: 10%;" > 
<th><strong>S.No</strong></th>
<th><strong>Name</strong></th>
<th><strong>Balance</strong></th>
<th><strong>Depost</strong></th>
<th><strong>Withdraw</strong></th>
</tr>
</thead>
<tbody style="font-size: 25px;">
<?php
$count=1;
$sel_query2="Select id, username, pouns,userid from wallet,users where users.username= '$user' && wallet.userid=users.id ;";

$result = mysqli_query($con,$sel_query2);
$row = mysqli_fetch_assoc($result) 

// $sel="Select id from wallet,users where users.username= '$user'  ;";

// $resul = mysqli_query($con,$sel);
// $row2 = mysqli_fetch_assoc($resul) 
// echo $resul;
?>
<tr><td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["username"]; ?></td>
<td align="center"><?php echo $row["pouns"]; ?>$</td>
<td align="center">
<!-- <a href="editp.php?id=<?php echo $row["wallet-id "]; ?>"> </a> -->
<a href="editp.php?id=<?php echo $row["userid"]; ?>"><img src="depost.png" alt="Remove Item" style="width: 50px;"/></a>
</td>
<td align="center">
<a href="pull.php?id=<?php echo $row["userid"]; ?>"><img src="swicon.webp" alt="Remove Item" style="width: 50px;"/></a>
</td>
</tr>

</tbody>
</table>
</div>
</body>
</html>