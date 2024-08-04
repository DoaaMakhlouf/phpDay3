<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check input fields are not empty
    if (!(empty($_POST['uname']) && empty($_POST['pass']))) {
        // Open stream 
        try {
            // Read data from file 
            $resource = fopen('usersdata', 'r');
            if (is_resource($resource)) {
                while (!feof($resource)) {
                    $is_registered = true;
                    $data = fgets($resource);
                    $data = preg_split('/\,/', $data);
                    // Check if user is valid
                    if (isset($data[6], $data[7]) && $_POST['uname'] == $data[6] && $_POST['pass'] == $data[7]) {
                        $_SESSION['username'] = $_POST['uname'];
                        $_SESSION['password'] = $_POST['pass'];
                        fclose($resource);
                        // Redirect to home page
                        header('Location: home.php');
                        exit;
                    }
                }
                $is_registered = false;
                if (!$is_registered) {
                    // Inform user that entered info is not correct
                    echo 'Invalid username or password';
                    fclose($resource);
                }
            } else {
                // Resource name is not valid
                echo 'Invalid filename';
            }
        } catch (Exception $e) {
            // Failed to open stream 
            echo 'Error';
        }
    } else {
        echo 'Enter Username and Password';
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form method="post" action="">
        <label for="uname">Username</label>
        <input type="text" name="uname">
        <br><br>
        <label for="pass">Password</label>
        <input type="password" name="pass">
        <br><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>