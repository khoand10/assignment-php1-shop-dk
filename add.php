<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("connection.php");

define ("APP_PATH", __DIR__);
define ("BASE_URL", '/shop-dk/');

if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$anh = $_FILES['f_anh'];
	$loginId = $_SESSION['id'];
		
	$arr_allow_type = ['image/bmp', 'image/gif','image/jpeg','image/png','image/svg+xml', 'image/jpg'];

	// checking empty fields
	if(empty($name) || empty($qty) || empty($price) || !in_array ($anh['type'],$arr_allow_type)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($qty)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		
		if(empty($price)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}

		if (!in_array ($anh['type'],$arr_allow_type)) {
			echo "<font color='red'>Type error. = {$anh['type']}</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
		$file_path = APP_PATH.'/upload/'.$anh['name'];
		$chuoi_luu_db = '/upload/'.$anh['name'];
		if( move_uploaded_file($anh['tmp_name'] ,  $file_path  ) ){
			echo "<img src='".BASE_URL.$chuoi_luu_db."' width='200'>";

		}else{
			echo "<font color='red'>Lỗi chuyển file vào thư mục lưu trữ.</font><br/>";
		}
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO products(name, qty, price, login_id, image) VALUES('$name','$qty','$price', '$loginId', '$chuoi_luu_db')");
		echo "<br> INSERT INTO products(name, qty, price, login_id, image) VALUES('$name','$qty','$price', '$loginId', '$chuoi_luu_db')";
		if(mysqli_errno($mysqli)){
			echo 'loi'. mysqli_error($mysqli);
		}else{
			echo "<font color='green'>Data added successfully.";
			echo "<br/><a href='view.php'>View Result</a>";
		}


		// if ($result) {
		// 	//display success message
		// 	echo "<font color='green'>Data added successfully.";
		// 	echo "<br/><a href='view.php'>View Result</a>";
		// } else {
		// 	echo "<font color='red'>.";
		// }
	}
}
?>

</body>
</html>
