<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pharmacy_styles.css">
    <title>Pharmacy Data</title>
</head>
<body>
    <h1>Nearby Pharmacies</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medihome";

    $conn = new mysqli($servername, $username, $password, $dbname);

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
   
    $userAreaQuery = "SELECT * FROM location WHERE Phone = '$userPhone'";
    $userAreaResult = mysqli_query($conn,$userAreaQuery);

    if ($userAreaResult->num_rows > 0) {
        $userAreaRow = $userAreaResult->fetch_assoc();
        $userArea = $userAreaRow["Area"];

        $sql = "SELECT * FROM pharmacy WHERE Area = '$userArea'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row["Name"] . " - " . $row["Area"] . "<a href='menu.php' class='cta-button'>See Medicines</a>" . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No pharmacies found in the user's area.";
        }
    } else {
        echo "User not found or user's area is not specified.";
    }

    $conn->close();
    ?>
</body>
</html>
