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
    <p style="font-size: 30px;"><a href="admin_panel.php">Back to Admin Panel</a></p>


    <?php
        include("connection.php");
        $sql="select * from order_info";
        $result=mysqli_query($conn,$sql);

        if($result){
            echo "<table border='2' width='1000' >";
                echo "<tr>";
                    echo "<th>Customer Phone</th>";
                    echo "<th>Total Products</th>";
                    echo "<th>Total Price</th>";
                    echo "<th>Delivery Status</th>";
                echo "</tr>";

            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                echo "<tr>
                        <td>0".$row['phone']."</td>
                        <td>".$row['total_product']."</td>
                        <td>".$row['total_price']."</td>
                        <td>".$row['payment_status']."</td>
                    </tr>";
            }
            echo "</table>";
        }

    ?>
  </body>
</html>