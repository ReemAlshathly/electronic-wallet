<?php
session_start();
require_once("dbcontroller.php");
include("auth.php");
// require('login.php');
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
           
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;
    case "buycard":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
    <HEAD>
    <TITLE>Simple PHP Shopping Cart</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
    </HEAD>
    <BODY>
        <div class="parent">
        <a href="logout.php">Logout</a>
    
    <div id="product-grid">
        <div class="txt-heading"><h1 style="color:rgb(152, 127, 175);text-align: center">Products</h1></div>
        <?php
        $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
        if (!empty($product_array)) { 
            foreach($product_array as $key=>$value){
        ?>
            <div class="product-item" >
                <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <div class="product-image"><img style="width=20%;hight=20%" src="<?php echo $product_array[$key]["image"]; ?>"></div>
                <div class="product-tile-footer">
                <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                <div class="cart-action"><input type="number" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Buy" class="btnAddAction" /></div>
                </div>
                </form>
            </div>
        <?php
            }
        }
        ?>
    </div>
    <div id="shopping-cart">
        <div class="txt-heading" ><h1 style="color:rgb(152, 127, 175); text-align: center;justify-content: center">Shopping Cart</h1></div>
        
        <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
        <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
        ?>	
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody >
        <tr style="background:rgb(152, 127, 175);color:white">
        <th style="text-align:left;">Name</th>
        <th style="text-align:left;">Code</th>
        <th style="text-align:right;" width="5%">Quantity</th>
        <th style="text-align:right;" width="10%">Unit Price</th>
        <th style="text-align:right;" width="10%">Price</th>
        <th style="text-align:center;" width="5%">Remove</th>
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
                        <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">
                        <img src="icon-delete.png" alt="Remove Item" /></a></td>
                        </tr>
                        <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"]*$item["quantity"]);
                }
                ?>
        
        <tr>
        <td colspan="2" align="right">Total:</td>
        <td align="right"><?php echo $total_quantity; ?></td>
        <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
        <td style="text-align:center;">  <a id="btnEmpty" href="index.php?action=buycard">buy</a></td>
        </tr>
        </tbody>
        </table>
        
       <?php
       ///////////////////////for cheack
       $user_id = "SELECT id FROM `users` WHERE username='$username'
and password='".md5($password)."'";
       $user=$user_id;
        $walletpouns=$db_handle->runQuery("SELECT pouns FROM wallet WHERE userid='" . $user. "'");
        if($total_price<$walletpouns)	{
            $newwalletpouns=$walletpouns-$total_price;
           
            $result="update wallet set
            pouns ='$newwalletpouns'
             where userid= ' $user ' ";?>
             <div class="no-records">Your buy done</div>
            <?php
            }
             else{

             
            ?>
             <div class="no-records">Yourwallet less than the total price </div>
            <?php
        }///////////////////////////////////
        ?>
       
      
          <?php
        } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
        }
        ?>

        </div>
    </div>
    </BODY>
    </HTML>