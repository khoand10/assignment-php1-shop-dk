<?php session_start(); ?>
<html>
<head>
	<title>Login</title>
	<link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i" rel="stylesheet">

    <link rel="stylesheet" href="customer/css/bootstrap.min.css">
    <link rel="stylesheet" href="customer/css/all.min.css">
    <link rel="stylesheet" href="customer/css/style.css">
</head>

<body>
<div class="card">
	<div class="card-header">
		<h2>Login</h2>
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link active" href="index.php">Home</a>
			</li>
		</ul>
	</div>
	<div class="card-body">
<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$user = mysqli_real_escape_string($mysqli, $_POST['username']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if($user == "" || $pass == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
					or die("Could not execute the select query.");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['username'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {
			echo "Invalid username or password.";
			echo "<br/>";
			echo "<a href='login.php'>Go back</a>";
		}

		if(isset($_SESSION['valid'])) {
			header('Location: index.php');			
		}
	}
} else {
?>
	<form name="form1" method="post" action="">
		<div class="form-group">
			<label for="static" class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-4">
			<input type="text" placeholder="Username" class="form-control" id="staticEmail" name="username">
			</div>
		</div>
		<div class="form-group">
			<label for="static" class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-4">
			<input type="password" placeholder="Password" class="form-control" id="staticEmail" name="password">
			</div>
		</div>
		<input type="submit" class="btn btn-primary" name="submit" value="submit"/>
		<!-- <table width="75%" border="0">
			<tr> 
				<td width="10%">Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit"></td>
			</tr>
		</table> -->
	</form>
<?php
}
?>
</div>
</div>
</body>
</html>
