<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");
define ("BASE_URL", '/shop-dk/');

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=".$_SESSION['id']." ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
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
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link active" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="add.html">Add New Data</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<td scope="col">Name</td>
					<td scope="col">Quantity</td>
					<td scope="col">Price</td>
					<td scope="col">Image</td>
					<td scope="col">Update</td>
				</thead>
				<?php
				while($res = mysqli_fetch_array($result)) {		
					echo "<tr>";
					echo "<td>".$res['name']."</td>";
					echo "<td>".$res['qty']."</td>";
					echo "<td>".$res['price']."</td>";	
					echo "<td><img src='".BASE_URL.$res['image']."' width='200'></td>";
					echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
				}
				?>
			</table>
		</div>
	</div>	
</body>
</html>
