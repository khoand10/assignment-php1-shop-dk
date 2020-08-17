<?php session_start(); ?>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//including the database connection file
include_once("connection.php");
define ("BASE_URL", '/shop-dk/');
if (isset($_GET['id'])) {
    $bill_id = $_GET['id'];
    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($mysqli, "select product_bill.product_id, product_bill.quantity, product_bill.amount from product_bill 
    JOIN bill ON product_bill.bill_id = bill.id WHERE bill.id = $bill_id");
    if (!$result) {
        echo "error";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SHOP DK</title>

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
        <h2>Order detail</h2>
        <!-- <a href="index.php" class="card-link">Home</a> -->
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <h5 class="card-title">List customer</h5>
        <div class="col-10">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">qroduct</th>
                    <th scope="col">quantity</th>
                    <th scope="col">price</th>
                    <th scope="col">amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($res = mysqli_fetch_array($result)) {
                        $product_id = $res['product_id'];
                        $result2 = mysqli_query($mysqli, "SELECT * FROM products WHERE products.id = '$product_id'");
                        $row = mysqli_fetch_assoc($result2);
                        if(is_array($row) && !empty($row)) {
                            $price = $row['price'];
                            $name = $row['name'];
                            $quantity = $res['quantity'];
                            $amount = $res['amount'];
                            $cart_item = <<<CART_ITEM
                                <tr>
                                    <td>$name</td>
                                    <td>$quantity</td>
                                    <td>$price</td>
                                    <td>$amount</td>
                                </tr>
                                CART_ITEM;
                            echo $cart_item;
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
</html>