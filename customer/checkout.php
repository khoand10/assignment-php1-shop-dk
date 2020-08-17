<?php session_start(); ?>
<?php
    include("../connection.php");
    define ("BASE_URL", '/shop-dk/');
    $userId = $_SESSION["id"];
    //insert data to database	

    $sql = "INSERT INTO bill(status, customer_id) VALUES ('0', '$userId')";
    if (mysqli_query($mysqli, $sql)) {
        $bill_id = mysqli_insert_id($mysqli);

        $is_error = false;
        $total = 0;

        foreach ($_SESSION['carts'] as $key => $value) {
            $result = mysqli_query($mysqli, "SELECT * FROM products WHERE products.id = '$key'");
            $row = mysqli_fetch_assoc($result);
            if(is_array($row) && !empty($row)) {
                $quantity = $value['quantity'];
                $amount = $row['price'] * $quantity;
                $total += $amount;
                $sql_insert_pro_bill = "INSERT INTO product_bill(product_id, bill_id, quantity, amount) VALUES ('$key','$bill_id','$quantity','$amount')";
                if (mysqli_query($mysqli, $sql_insert_pro_bill)) {
                    echo "New insert bill_pro created successfully. Last inserted ID is: ";
                } else {
                    $is_error = true;
                    echo "Error insert bill_pro: " . $sql_insert_pro_bill . "<br>" . mysqli_error($mysqli);
                }
            }
        }
        if (!$is_error) {
            $_SESSION['carts'] = array();
            mysqli_query($mysqli, "UPDATE `bill` SET `total` = '$total' WHERE `bill`.`id` = $bill_id");
            header("Location:index.php");
        }

      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
      }

    // $result = mysqli_query($mysqli, "INSERT INTO bill(status, customer_id) VALUES ('0', '$userId')");
    // echo "<br> INSERT INTO bill(status, customer_id) VALUES ('0', '$userId')";
    // $bill_id = mysqli_insert_id($mysqli);
    // if(mysqli_errno($mysqli)){
    //     echo 'loi'. mysqli_error($mysqli);
    // }else{
    //     echo "<font color='green'>Data added successfully.";
    //     echo "New record created successfully. Last inserted ID is: " . $bill_id;
    // }
?>