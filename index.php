<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i" rel="stylesheet">

    <link rel="stylesheet" href="customer/css/bootstrap.min.css">
    <link rel="stylesheet" href="customer/css/all.min.css">
    <link rel="stylesheet" href="customer/css/style.css">
</head>

<body>
	<div id="header">
		Welcome to system console!
	</div>
	<?php
	if(isset($_SESSION['valid'])) {			
		include("connection.php");					
		$result = mysqli_query($mysqli, "SELECT * FROM login");
	?>
				
		Welcome <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br/>
		<br/>
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link active" href="view.php">View and Add Products</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="customers.php">Customers</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="order-manager.php">Order management</a>
			</li>
		</ul>
		<br/><br/>
	<?php	
	} else {
		echo "You must be logged in to view this page.<br/><br/>";
		echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
	}
	?>
	<!-- <div id="footer">
		Created by <a href="http://blog.chapagain.com.np" title="Mukesh Chapagain">Mukesh Chapagain</a>
	</div> -->
</body>
</html>
