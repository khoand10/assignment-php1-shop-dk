<?php session_start(); ?>
<?php
//including the database connection file
include_once("connection.php");
define ("BASE_URL", '/shop-dk/');

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "select customer.fullname, bill.total, bill.created_at, bill.status 
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
        Order manager
        <a href="index.php" class="card-link">Home</a>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($res = mysqli_fetch_array($result)) {
                            $fullname = $res['fullname'];
                            $total = $res['total'];
                            $created_at = $res['created_at'];
                            $status = $res['status'];
                            $customer = <<<CUSTOMER
                                <tr>
                                    <td>$fullname</td>
                                    <td>$created_at</td>
                                    <td>$total</td>
                                    <td>$status</td>
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