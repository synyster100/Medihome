<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="order_style.css">
    <title>Medicine Invoice</title>
</head>
<body>
    <header>
        <h1>Medicine Invoice</h1>
    </header>
    <main>
        <section class="invoice">
            <h2>Invoice Details</h2>
            <div id="invoice-details">
                <?php
                $dbHost = "localhost";
                $dbUser = "root";
                $dbPassword = "";
                $dbName = "medihome";

                $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the order_info table
                ?>
                <?php
                  session_start();
                  if (isset($_SESSION['var1'])) {
                      $userPhone = $_SESSION['var1'];
                      echo  $userPhone ;
                 }  
                ?>
                <?php
                $sql = "SELECT * FROM order_info WHERE phone = '$userPhone'";
                $result = mysqli_query($conn, $sql);
                
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Items</th><th>Total Cost</th></tr>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_cost=$row["total_price"] +50;
                        echo "<tr>";
                        echo "<td>" . $row["total_product"] . "</td>";
                        echo "<td>$" . $row["total_price"] . "</td>";
                        echo "</tr>";
                    }
                    
                    echo "<tr>";
                    echo "<td>".'Delivery Charge'.  "</td>";
                    echo "<td align='center'>$" . "50" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td align='center'>". "------------------------------------------------------" . "</td>";
                    echo "<td align='center'>" . "---------" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td align='center'>". "Total" . "</td>";
                    echo "<td align='center'>$" . $total_cost . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='2' align='center'>" . "Thank you for Shopping Form MediHome" . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td colspan='2' align='center'>" . "Your Order will Be At Your DoorStep Soon" . "</td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "No invoice data found.";
                }

                $conn->close();
                ?>
            </div>
            <button id="print-btn" onclick="window.print()">Print Invoice</button>
        </section>
    </main>
    <main>
       <a href="landing_page.php">
           <button>Go to home</button>
       </a> 
    </main>
</body>
</html>
