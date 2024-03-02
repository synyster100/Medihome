<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_view_pharmacy.css">


  </head>
  <body>
    <br><br><h1>Table of Pharmacy</h1><br><br>
    <p style="font-size: 30px;"><a href="admin_panel.php">Back to Admin Panel</a></p>


    <?php
        include("connection.php");
        if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            mysqli_query($conn, "DELETE FROM medicine WHERE id = '$remove_id'");
            header('location:admin_view_pharmacy.php');
         };
        $sql="select * from medicine";
        $result=mysqli_query($conn,$sql);

        if($result){
            echo "<table border='2' width='1000' >";
                echo "<tr>";
                    echo "<th>Pharmacy</th>";
                    echo "<th>Med_ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Power</th>";
                    echo "<th>Price</th>";
                    echo "<th>Stock</th>";
                    echo "<th>Action</th>";
                echo "</tr>";

            while($fetch_order=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                ?>
                <tr>
                <td><?php echo $fetch_order['Pharmacy']; ?></td>
                <td><?php echo $fetch_order['Med_id']; ?></td>
                <td><?php echo $fetch_order['Name']; ?></td>
                <td><?php echo $fetch_order['Power']; ?></td>
                <td><?php echo $fetch_order['Price']; ?></td>
                <td><?php echo $fetch_order['Stock']; ?></td>
                <td><a href="admin_view_pharmacy.php?remove=<?php echo $fetch_order['id']; ?>" onclick="return confirm('Remove Pharmacy?')" class="option-btn"> Remove</a></td>
                </tr>";
                <?php
            }
            echo "</table>";
        }

    ?>
  </body>
</html>