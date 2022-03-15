<?php
require('dbcontroller.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM catogries WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location: viewc.php"); 
?>