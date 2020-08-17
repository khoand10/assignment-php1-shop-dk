<?php session_start(); ?>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
//including the database connection file
include_once("connection.php");
define ("BASE_URL", '/shop-dk/');
if (isset($_GET['status']) && isset($_GET['bill_id'])) {
    $status = $_GET['status'];
    $bill_id = $_GET['bill_id'];
    $sql_update_status = "UPDATE `bill` SET `status` = '$status' WHERE `bill`.`id` = $bill_id";
    mysqli_query($mysqli, $sql_update_status);
}

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "select customer.fullname, bill.total, bill.created_at, bill.status, bill.id 
from bill JOIN customer ON bill.customer_id =customer.id");

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
        <h2>Order manager</h2>
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
                    <th scope="col">Customer Name</th>
                    <th scope="col">Date time</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <td scope="col">Detail</td>
                    <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($res = mysqli_fetch_array($result)) {
                            $id = $res['id'];
                            $fullname = $res['fullname'];
                            $total = $res['total'];
                            $created_at = $res['created_at'];
                            $status = $res['status'];

                            $status_dis = '';
                            $action_dis = '';
                            if ($status == '0') {
                                $status_dis = "<span class='badge badge-warning'>not delivery</span>";
                                $action_dis = "<a href='order-manager.php?status=1&&bill_id=$id'>Make to delivery</a>";
                            } else {
                                $action_dis = "<a href='order-manager.php?status=0&&bill_id=$id'>Make to not delivery</a>";
                                $status_dis = "<span class='badge badge-success'>delivered</span>";
                            }
                            $customer = <<<CUSTOMER
                                <tr>
                                    <td>$fullname</td>
                                    <td>$created_at</td>
                                    <td>$total</td>
                                    <td>$status_dis</td>
                                    <td><a href="order_detail.php?id=$id">detail</a></td>
                                    <td>
                                        $action_dis
                                    </td>
                                </tr>
                            CUSTOMER;
                            echo $customer;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
</html>