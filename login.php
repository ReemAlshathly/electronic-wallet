<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
///get id for cheack

///////////
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: viewp.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
<div class="form"  style="margin-top: 6%; margin-left: 35%;">
<h1 style="width:50%;color:rgb(80, 70, 115);height: 10%;border:none ;margin-left:20%">Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required style="width:47%;background:rgb(f, f, f)"/><br>
<input type="password" name="password" placeholder="Password" required style="width:47%" /><br>
<input name="submit" type="submit" value="Login"  style="width:50%;background:rgb(100, 87, 135);color:white;height: 10%;border:none"/>
</form>
<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
</div>
<?php } ?>
</body>
</html>