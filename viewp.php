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
    <div style=";
   
   margin-left: 45%;">
   
        
<p><a href="index.php" style="color:rgb(152, 127, 175)">Home</a> 
|  
| <a href="logout.php" style="color:rgb(152, 127, 175)">Logout</a></p>
</div>
<div class="form" style=";
   
    margin-left: 10%;">
    <div class="form" style=";
   
   margin-left: 30%;">

<div style="border:1px solid rgb(152, 127, 175);width:30% ;padding:5%">
<h4>Welcome <?php echo $_SESSION['username']; ?>! your total price is 
<?php echo $_SESSION['totalprice'];?>$ </h4>
<?php 
            
            $user=$_SESSION['username'];
            $totalprice=$_SESSION['totalprice'];
            
            $sel="Select  pouns from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
            $resu = mysqli_query($con,$sel);
            $row = mysqli_fetch_assoc($resu) ;
            $sell="Select userid from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
            $resuid = mysqli_query($con,$sell);
            $rowid = mysqli_fetch_assoc($resuid) ;
            $id= $rowid["userid"];
            $balane = $row["pouns"];
$update="update wallet set
pouns ='$balane'-'$totalprice'
 where userid= '$id' ";?>
<h4><?php echo "and your balance is " . $row["pouns"]."$";?></h4>
<h4><?php echo "<br> Are you sure want to buy?" ?></h4>

<a style="width:50px;color:rgb(152, 127, 175)"  href='index.php'>back to product</a>
 <br>
<a id="btnEmpty" href="viewp.php?action=Withdraw">Withdraw</a>
<a id="btnEmpty"style=" margin:4%;" href="viewp.php?action=remove">cancle</a>


<?php



$count=1;
$sel_query="Select pouns,userid from wallet,users where wallet.userid=users.id  ;";
$result = mysqli_query($con,$sel_query);?>


</div>
</div>
<?php
$user=$_SESSION['username'];
$totalprice=$_SESSION['totalprice'];
$sel="Select  pouns from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
$resu = mysqli_query($con,$sel);
$row = mysqli_fetch_assoc($resu) ;
$sell="Select userid from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
$resuid = mysqli_query($con,$sell);
$rowid = mysqli_fetch_assoc($resuid) ;
$id= $rowid["userid"];
// echo "<br> and yourid " . $id."$<br>";
// echo $totalprice."$";
?>
<
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
<?php 
switch($_GET["action"]) {
	case "Withdraw":
        
$user=$_SESSION['username'];
$totalprice=$_SESSION['totalprice'];

$sel="Select  pouns from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
$resu = mysqli_query($con,$sel);
$row = mysqli_fetch_assoc($resu) ;
$sell="Select userid from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
$resuid = mysqli_query($con,$sell);
$rowid = mysqli_fetch_assoc($resuid) ;
$id= $rowid["userid"];
$balane = $row["pouns"];

$update="update wallet set
pouns ='$balane'-'$totalprice'
 where userid= '$id' ";
		if ($balane>=$totalprice){
            mysqli_query($con, $update) or die(mysqli_error());
            $status = "<br><br><br><br><br><br><br>you buy the select product and we pull  </br></br>
             ";
            
               echo '<p style="color:rgb(150, 127, 175); margin-left: 30%;">'.$status.$totalprice.
               '$  from your wallet and now the product you buy it are  </p>
              ';
              ?>
               <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody >
        <tr style="background:rgb(152, 127, 175);color:white">
        <th style="text-align:left;">Name</th>
        <th style="text-align:left;">Code</th>
        <th style="text-align:right;" width="5%">Quantity</th>
        <th style="text-align:right;" width="10%">Unit Price</th>
        <th style="text-align:right;" width="10%">Price</th>
      
        </tr>
              <?php
              foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                        <tr >
                        <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image"  /><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["code"]; ?></td>
                        <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                        <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                        <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                       <br>
                        </tr>
                        <?php
                       
                      
                }
                echo "total price =  ". $_SESSION['totalprice']."$";
            }
           else{
               $status = "<br><br><br><br><br><br><br> Sorry you cant pull from wallet becouse your account less than . </br></br>
               <a  href='index.php'>back to product</a>";
               echo '<p style="color:rgb(152, 127, 175); margin-left: 30%;">'.$status.'</p>';
               unset($_SESSION["cart_item"]);
  
           }
	break;
	case "remove":
             
$user=$_SESSION['username'];
$totalprice=$_SESSION['totalprice'];

$sel="Select  pouns from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
$resu = mysqli_query($con,$sel);
$row = mysqli_fetch_assoc($resu) ;
$sell="Select userid from wallet,users where users.username= '$user' && wallet.userid=users.id ;";
$resuid = mysqli_query($con,$sell);
$rowid = mysqli_fetch_assoc($resuid) ;
$id= $rowid["userid"];
$balane = $row["pouns"];
unset($_SESSION["cart_item"]);
header("Location: index.php");
		// unset($_SESSION["totalprice"]);
	break;

}

?>
</body>
</html>