<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="admin_view_pharmacy.css">


  </head>
  <body>
    <br><br><h1>Order Details</h1><br><br>
    <p style="font-size: 20px;"><a href="log_in.php">Log Out</a></p>


    <?php
        include("connection.php");
        if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            mysqli_query($conn, "UPDATE order_info SET payment_status='Paid' WHERE id = '$remove_id'");
            header('location:deliveryman.php');
         };

        $sql="select * from order_info where payment_status='Not Paid'";
        $result=mysqli_query($conn,$sql);

        if($result){
            echo "<table border='2' width='1000' >";
                echo "<tr>";
                    echo "<th>Customer Phone</th>";
                    echo "<th>Total Products</th>";
                    echo "<th>Total Price</th>";
                    echo "<th>Delivery Status</th>";
                    echo "<th>Action</th>";

                echo "</tr>";

            while($fetch_order=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                <tr>
                <td><?php echo '0'.$fetch_order['phone']; ?></td>
                <td><?php echo $fetch_order['total_product']; ?></td>
                <td><?php echo $fetch_order['total_price']; ?></td>
                <td><?php echo $fetch_order['payment_status']; ?></td>
   
                <td><a href="deliveryman.php?remove=<?php echo $fetch_order['id']; ?>" onclick="return confirm('Payment Received?')" class="option-btn"><i class="fa-solid fa-check"></i> Received</a></td>
            </tr>
            <?php
            }
            echo "</table>";
        }

    ?>
  </body>
</html>