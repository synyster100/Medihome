<?php
// Database connection
// $hostname = "localhost";
// $username = "root";
// $password = "";
// $database = "Medpanda";

// $conn = new mysqli($hostname, $username, $password, $database);
// if ($conn->connect_error) {
//     die("Connection Failed: " . $conn->connect_error);
// }

// // Initialize variables
// $zip = $city = $street = $area = "";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $zip = $_POST['zipcode'];
//     $city = $_POST['city'];
//     $street = $_POST['street'];
//     $area = $_POST["Area"];
//     $house= $_POST["house_number"];
//     $phone= $_POST["phone"];

//     $stmt = $conn->prepare("INSERT INTO location (zip, city, street, area, house, phone_number) VALUES (?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("ssssss", $zip, $city, $street, $area, $house, $phone);

//     if ($stmt->execute()) {
//         $message = "Location registered.";

//     }
//     else {
//         $message = "Error: " . $stmt->error;
//     }

//     $stmt->close();
// }
// ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Address Form</title>
    <link rel="stylesheet" href="takeloc.css">
</head>
<body>
    <h1>Enter Your Address</h1>
    <form action="register_location.php" method="post">
        <label for="house_number">House Number:</label>
        <input type="text" id="house_number" name="house_number" required>
        <label for="street">Street:</label>
        <input type="text" id="street" name="street" required>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        <label for="zipcode">Zip:</label>
        <input type="text" id="zipcode" name="zipcode" required>
        <label for="Area">Area:</label>
        <input type="text" id="Area" name="Area" required>
        <label for="phone">Phone number:</label>
        <input type="tel" id="phone" name="phone" required>
        <div>
        <a href="nearby_pharmacy.php"><input type="submit" class="btn btn-primary"></a>
        </div>
    </form> -->

    

</body>
</html>

<?php
// Close the database connection
// $conn->close();
// ?> 



<?php
// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "medihome";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Initialize variables
$zip = $city = $street = $area = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zip = $_POST['zipcode'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $area = $_POST["Area"];
    $house = $_POST["house_number"];
    $phone = $_POST["phone"];

    // Check if location with the same phone number exists
    $check_stmt = $conn->prepare("SELECT * FROM location WHERE Phone = ?");
    $check_stmt->bind_param("i", $phone);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $message = "Location already registered.";
        ?>
          <meta http-equiv="refresh" content="2; URL=nearby_pharmacy.php" />
        <?php
    } else {
        $stmt = $conn->prepare("INSERT INTO location (zip, city, street, area, house, phone) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $zip, $city, $street, $area, $house, $phone);

        if ($stmt->execute()) {
          //  $message = "Location registered.";
          //header('Location: nearby_pharmacy.php');
          ?>
          <meta http-equiv="refresh" content="2; URL=nearby_pharmacy.php" />
          <?php
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $check_stmt->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Address Form</title>
    <link rel="stylesheet" href="takeloc.css">
</head>
<body>
    <h1>Enter Your Address</h1>
    
    <form action="register_location.php" method="post">
        <label for="house_number">House Number:</label>
        <input type="text" id="house_number" name="house_number" required>
        <label for="street">Street:</label>
        <input type="text" id="street" name="street" required>
        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>
        <label for="zipcode">Zip:</label>
        <input type="text" id="zipcode" name="zipcode" required>
        <label for="Area">Area:</label>
        <input type="text" id="Area" name="Area" required>
        <label for="phone">Phone number:</label>
        <input type="tel" id="phone" name="phone" required>
        <div>
        <input type="submit" class="btn btn-primary">
        </div>
    </form>

   

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>