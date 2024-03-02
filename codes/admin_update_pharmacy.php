<?php
    include("connection.php")
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_update_pharmacy.css">

  </head>
<body>
    <br><br><h1>Update Pharmacy</h1><br><br>
    <div class="container">
        <form name="form" action="" method="POST">
            <label for="Pharmacy">Pharmacy</label>
            <input type="text" id="Pharmacy" name="p_name" placeholder="Pharmacy Name" required><br>

            <label for="Med_id">Med_ID</label>
            <input type="text" id="Med_id" name="Med_id" placeholder="Enter Med_id" required><br>

            <label for="Name">Name</label>
            <input type="text" id="Name" name="Name" placeholder="Enter Name" required><br>

            <label for="Power">Power</label>
            <input type="text" id="Power" name="power" placeholder="Enter Power" required><br>

            <label for="Price">Price For One</label>
            <input type="number" id="Price" name="p_price" min="1" placeholder="Price For One" required><br>

            <label for="Stock">Stock</label>
            <input type="number" id="Stock" name="stock" min="1" placeholder="enter stock" required><br><br><br>

            <div class="bt">
                <input type="submit" id="btn" value="Update" name="submit" />
            </div>
            <p style="font-size: 30px; text-align:center;"><a href="admin_panel.php">Back to Admin Panel</a></p>
        </form>
    </div>
  </body>
</html>
<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $pharmacy = $_POST['p_name'];
        $med_id = $_POST['Med_id'];
        $name = $_POST['Name'];
        $power = $_POST['power'];
        $price = $_POST['p_price'];
        $stock = $_POST['stock'];

        $sql = "SELECT * FROM medicine WHERE Name = '$name'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $update_stock_sql = "UPDATE medicine SET stock = stock + '$stock' WHERE Name = '$name' AND Pharmacy = '$pharmacy'";
            $update_stock_result = mysqli_query($conn, $update_stock_sql);

            if ($update_stock_result) {
                $update_price_sql = "UPDATE medicine SET Price = '$price' WHERE Name = '$name' AND Pharmacy = '$pharmacy'";
                $update_price_result = mysqli_query($conn, $update_price_sql);

                if ($update_price_result) {
                    header("Location: admin_panel.php");
                }
            }
        } else {
            $insert_sql = "INSERT INTO medicine(`Pharmacy`, `Med_id`, `Name`, `Power`, `Price`, `Stock`) VALUES('$pharmacy','$med_id','$name','$power','$price','$stock')";
            $insert_result = mysqli_query($conn, $insert_sql);
            
            if ($insert_result) {
                header("Location: admin_panel.php");
            }
        }
    }
?>
