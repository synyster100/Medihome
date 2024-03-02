<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <h1>Sign Up Form</h1>
            <select name="user_category" required>
                <option value="" disabled selected>Select User Category</option>
                <option value="Admin">Admin</option>
                <option value="Customer">Customer</option>
                <option value="Delivery_Man">Delivery Man</option>
            </select><br>
            <input type="text" name="username" class="input-box" placeholder="Enter Username" required><br><br>
            <input type="tel" name="phn" class="input-box" placeholder="Enter phone number" required><br><br>
            <input type="password" name="pass" class="input-box" placeholder="Enter Password" required><br><br>
            <input type="password" name="c_pass" class="input-box" placeholder="Confirm Password" required><br><br>

            <input type="submit" id="btn" name="btn" value="Submit"><br>
            <a href="log_in.php">Already have an Account.</a>
        </div>
    </form>
</body>
</html>

<?php
    include("connection.php");
    if (isset($_POST['btn'])){
        $user_c = $_POST['user_category'];
        $username = $_POST['username'];
        $phone = $_POST['phn'];
        $password = $_POST['pass'];
        $c_pass = $_POST['c_pass'];

        $sql_user = "SELECT * FROM sign_up WHERE username = '$username'";
        $sql_phone = "SELECT * FROM sign_up WHERE phone = '$phone'";

        $result_user = mysqli_query($conn, $sql_user);
        $result_phone = mysqli_query($conn, $sql_phone);

        $count_user = mysqli_num_rows($result_user);
        $count_phone = mysqli_num_rows($result_phone);

        if ($count_user == 0 && $count_phone == 0){
            if ($password == $c_pass){
                // $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
                $sql_insert = "INSERT INTO sign_up (category, username, phone, password) VALUES ('$user_c', '$username', '$phone', '$password')";
                $result_insert = mysqli_query($conn, $sql_insert);
                if ($result_insert){
                    header('Location: log_in.php');
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo '<script>
                    alert("Passwords do not match");
                </script>';
            }
        } else {
            if ($count_user > 0){
                echo '<script>
                    alert("Username already exists");
                </script>';
            }
            if ($count_phone > 0){
                echo '<script>
                    alert("Number already exists");
                </script>';
            }
        }
    }
?>



