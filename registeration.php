<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $errors = [];
//     if (empty($_POST['fname'])) {
//         $error['fname'] = 'first name is required.';
//         else{
//             $fname = htmlspecialchars(trim($_POST['fname']));
//         }
//     $lname = htmlspecialchars(trim($_POST['lname']));
//     $address = htmlspecialchars(trim($_POST['address']));
//     $gender = $_POST['gender'];
//     $country = $_POST['country'];
//     $username = htmlspecialchars(trim($_POST['uname']));
//     $password = htmlspecialchars(trim($_POST['pass']));
//     $department = htmlspecialchars(trim($_POST['dep']));

//     }
// }

// '<script>validateForm(flag);</script>'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
</head>

<body>
    <form method="post" action="done.php" enctype="multipart/form-data" id="form">
        <label for="fname">First Name</label>
        <input type="text" name="fname">
        <br><br>
        <label for="lname">Last Name</label>
        <input type="text" name="lname">
        <br><br>
        <label for="address">Address</label>
        <textarea name="address"></textarea>
        <br><br>
        <label for="country">Country</label>
        <select name="country">
            <option value="Egy">Egypt</option>
            <option value="Pal">Palestine</option>
            <option value="Sud">Sudan</option>
            <option value="Syr">Syria</option>
        </select>
        <br><br>
        <label for="gender">Gender</label>
        <input type="radio" name="gender" value="m">
        <label for="gender">Male</label>
        <input type="radio" name="gender" value="f">
        <label for="gender">Female</label>
        <br><br>
        <label>Skills</label>
        <input type="checkbox" name="skills[]" value="PHP">
        <label>PHP</label>
        <input type="checkbox" name="skills[]" value="J2SE">
        <label>J2SE</label>
        <br><br>
        <input type="checkbox" name="skills[]" value="MySQL">
        <label>MySQL</label>
        <input type="checkbox" name="skills[]" value="PostgreeSQL">
        <label>PostgreeSQL</label>
        <br><br>
        <label for="uname">Username</label>
        <input type="text" name="uname">
        <br><br>
        <label for="pass">Password</label>
        <input type="password" name="pass">
        <br><br>
        <label for="img">Upload Image</label>
        <input type="file" name="myImg">
        <br><br>
        <label for="dep">Department</label>
        <input type="text" name="dep" placeholder="OpenSource">
        <br><br>
        <input type="submit" value="Submit" onclick="validateForm()">
        <input type="reset">
    </form>
    <!-- <script>
        function validateForm(valid) {
            if (valid) {
                document.getElementById("form").submit();
            }
        }
    </script> -->
</body>

</html>