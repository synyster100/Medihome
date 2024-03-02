<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart_style.css">
</head>
<body>
    <header>
        <h1>Shopping Cart</h1>
    </header>
    <main>
        <div class="cart">
            <h2>Your Cart</h2>
            <form action="" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                        $sm = null;
                        ?>
                        <?php
                        session_start();
                        if (isset($_SESSION['var1'])) {
                            $userPhone = $_SESSION['var1'];
                            echo  $userPhone ;
                       }  
                      ?>
                      <?php
                        if (isset($_POST['delete'])) {
                            $val = $_POST['delete'];
                            $del = "DELETE FROM cart WHERE cart_id = ?";
                            $stmt = $conn->prepare($del);
                            $stmt->bind_param("i", $val);
                            if ($stmt->execute()) {
                                // Row deleted successfully
                                // You can provide a confirmation message here if needed
                            } else {
                                echo "Error: " . $conn->error;
                            }
                        }

                        $sm = "SELECT cart.product_id, cart.cart_id, medicine.Name as name, cart.amount, medicine.price FROM cart, medicine WHERE cart.product_id = medicine.med_id and cart.Phone='$userPhone'";

                        $result = mysqli_query($conn, $sm);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["product_id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["amount"] . "</td>";
                                echo "<td>$" . $row["price"] . "</td>";
                                echo "<td><button type='submit' class='button' name='delete' value='" . $row["cart_id"] . "'>Remove</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </form>
            <form action="place_order.php" method="post">
                <input type="submit" value="Place Order">
            </form>
        </div>
    </main>
</body>
</html>
