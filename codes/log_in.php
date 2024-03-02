<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <h1>Log In</h1>
            <select name="user_category" required>
                <option value="" disabled selected>Select User Category</option>
                <option value="Admin">Admin</option>
                <option value="Customer">Customer</option>
                <option value="Delivery_Man">Delivery Man</option>
            </select><br>
            <input type="phone" name="phone" class="input-box" placeholder="Enter Phone Number" required><br><br>
            <input type="password" name="pass" class="input-box" placeholder="Enter Password" required><br><br>

            <input type="submit" id="btn" name="btn" value="Log In">
            <p style="font-size: 10px;">Don't Have an Account?<a href="sign_up.php">Register</a></p>
        </div>
    </form>
<?php
        include("connection.php");

        if (isset($_POST['btn'])){
            $user_c = $_POST['user_category'];
            $phone = $_POST['phone'];
            $password = $_POST['pass'];
            ?>
            <?php
            session_start();
            $_SESSION['var1'] = $phone;
            ?>
            <?php

            $sql_user = "SELECT * FROM sign_up WHERE phone = '$phone' AND category = '$user_c'";
            $result = mysqli_query($conn, $sql_user);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $pass = $row['password'];

                if ($pass == $password) {
                    if ($user_c == 'Admin') {
                        header('Location: admin_panel.php');
                    } elseif ($user_c == 'Customer') {
                        header('location: landing_page.php');
                    } elseif ($user_c == 'Delivery_Man') {
                        header('Location: deliveryman.php');
                    }
                }

                } else {
                    echo '<script>
                        alert("Invalid email, user category, or password");
                    </script>';
                }
            }

    ?>
</body>
</html>

