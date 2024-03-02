<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Store</title>
    <link rel="stylesheet" href="menustyles.css">
</head>
<body>
    <header>
        <h1>Medicine Store</h1>
        <nav>
            <h1><a href="cart_index.php">View Cart</a></h1>
        </nav>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medihome"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    <?php
    session_start();
    if (isset($_SESSION['var1'])) {
        $userPhone = $_SESSION['var1'];
      
   }  
  ?>
  <?php

    $sql = "SELECT * FROM medicine";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<form action='' method='POST'>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Power</th><th>Price</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $medicineId = $row["Med_id"];
            $price = $row["Price"];

            echo "<tr>";
            echo "<td>" . $row["Med_id"] . "</td>";
            echo "<td>" . $row["Name"] . "</td>";
            echo "<td>" . $row["Power"] . "</td>";
            echo "<td>$" . $price . "</td>";
            echo "<td><button type='submit' class='button' name='add_to_cart' value='" . $medicineId . "'>Add to Cart</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
    } else {
        echo "No medicine data found.";
    }

    // Handle adding items to the cart
    if (isset($_POST['add_to_cart'])) {
        $medicineId = $_POST["add_to_cart"];
        $price = "SELECT * FROM medicine WHERE med_id = '$medicineId'";
        $result=mysqli_query($conn,$price);
        $row=mysqli_fetch_array($result);
        $price1=$row["Price"];

        
        $check ="SELECT * FROM cart WHERE product_id = '$medicineId'";
        $test=mysqli_query($conn,$check);
        if(mysqli_affected_rows($conn)){
            $sql1 = "UPDATE cart SET Amount = (Amount + 1) WHERE product_id = '$medicineId'";
            $result1=mysqli_query($conn,$sql1);
            echo "Cart Updated";
        }
        else{
            $sql2 = "INSERT INTO cart (phone, product_id, Amount, Price) VALUES ('$userPhone', '$medicineId', 1, '$price1' )";
            $result2=mysqli_query($conn,$sql2);
            echo "Item Added to Cart";
        } 
        $st_up = "UPDATE medicine SET stock = stock - (SELECT amount FROM cart WHERE product_id = '$medicineId') WHERE med_id = '$medicineId'";
        $update = mysqli_query($conn, $st_up);
    }    

    

        
        
    ?>
</body>
</html>
