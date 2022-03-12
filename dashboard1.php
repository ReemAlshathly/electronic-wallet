<?php
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Secured Page</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Welcome to Dashboard.</p>
<p><a href="index.php">Home</a><p>
<p><a href="insertp.php">Insert Newprod</a></p>
<p><a href="viewp.php">View Records</a><p>
<p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>