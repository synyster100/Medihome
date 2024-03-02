<?php
    // Database connection
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "medihome";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    ?>
    <?php
      session_start();
      if (isset($_SESSION['var1'])) {
          $userPhone = $_SESSION['var1'];
          echo  $userPhone ;
     }  
    ?>
    <?php
   
    $sql = "SELECT * FROM cart WHERE Phone = '$userPhone'";
    $result = mysqli_query($conn, $sql);
    $total_cost = 0;
    $product = array(); // Initialize an array to store product names
        
    if ($result->num_rows > 0) {
        while ($item = $result->fetch_assoc()) {
            $id = $item["product_id"];
            $n = "SELECT name FROM medicine WHERE med_id='$id'";
            $nameResult = mysqli_query($conn, $n);
            $nameRow = mysqli_fetch_assoc($nameResult);
            $productName = $nameRow['name'];
            $product[] = $productName .' ('. $item['amount'] .') ';
            $item_price = number_format($item['price'] * $item['amount']);
            $total_cost += $item_price;
        }    
              
        $total_item = implode(', ',$product);            
        $insertSql = "INSERT INTO order_info (phone, total_product, total_price, payment_status) VALUES ('$userPhone', '$total_item', '$total_cost', 'Not Paid')";
        $del = mysqli_query($conn, $insertSql);

                
        // Delete from cart
        $deleteSql = "DELETE FROM cart WHERE  Phone = '$userPhone'";
        $delete_data = mysqli_query($conn, $deleteSql);
            
        echo "Order placed successfully!";
        ?>
        <meta http-equiv="refresh" content="2; URL=order_page.php" />
        <?php

    }
    else {
        echo "Your cart is empty.";
    }
        
    $conn->close();
?>
