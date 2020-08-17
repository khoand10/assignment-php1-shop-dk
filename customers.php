<?php session_start(); ?>
<?php
//including the database connection file
include_once("connection.php");
define ("BASE_URL", '/shop-dk/');

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM `customer` WHERE 1");

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
        <h2>Customer manager</h2>
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
                    <th scope="col">#</th>
                    <th scope="col">fullname</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($res = mysqli_fetch_array($result)) {
                            $id = $res['id'];
                            $fullname = $res['fullname'];
                            $email = $res['email'];
                            $phone = $res['phone'];
                            $address = $res['address'];
                            $customer = <<<CUSTOMER
                                <tr>
                                    <th scope="row">$id</th>
                                    <td>$fullname</td>
                                    <td>$email</td>
                                    <td>$phone</td>
                                    <td>$address</td>
                                </tr>
                            CUSTOMER;
                            echo $customer;
                        }
                    ?>
                    <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!-- <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-10">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->
</body>
</html>