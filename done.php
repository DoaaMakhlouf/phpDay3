<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $address = htmlspecialchars(trim($_POST['address']));
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $username = htmlspecialchars(trim($_POST['uname']));
    $password = htmlspecialchars(trim($_POST['pass']));
    $department = htmlspecialchars(trim($_POST['dep']));
    $image = $_FILES['myImg'];


    // Error handling for image uploading
    if ($_FILES['myImg']['error'] > 0) {
        echo 'Problem: ';
        switch ($_FILES['myImg']['error']) {
            case 1:
                echo 'File exceeded upload_max_filesize';
                break;
            case 2:
                echo 'File exceeded max_file_size';
                break;
            case 3:
                echo 'File only partially uploaded';
                break;
            case 4:
                echo 'No file uploaded';
                break;
            case 6:
                echo 'Cannot upload file: No temp directory specified';
                break;
            case 7:
                echo 'Upload failed: Cannot write to disk';
                break;
            case 8:
                echo 'A PHP extension stopped the file upload.';
        }
    }


    // Change image path to a new secured one
    $upimg = '/uploads/' . $_FILES['myImg']['name'];

    // Validate the uploaded file as an image
    if (getimagesize($image['tmp_name']) === false) {
        echo 'Problem: file is not image';
    }
    if (is_uploaded_file($_FILES['myImg']['tmp_name'])) {
        if (!move_uploaded_file($_FILES['myImg']['tmp_name'], $upimg)) {
            echo 'Problem: Could not move file to destination directory';
        }
    } else {
        echo 'Problem: Possible file upload attack. Filename: ';
        echo $_FILES['myImg']['name'];
    }


    // Display the submitted data
    $title = $gender == 'm' ? 'Mr. ' : 'Miss. ';
    $name = $fname . ' ' . $lname;
    echo '<b>Thanks </b>' . $title . $name . '<br><br>' .
        '<b> Please Review Your Information </b><br><br>' . '<b> Name: </b>' . $username . '<br><br>' .
        '<b> Address: </b>' . $address . '<br><br>' .
        '<b> Your Skills: </b><br>';
    if (isset($_POST['skills']))
        foreach ($_POST['skills'] as $each_skill)
            echo $each_skill . '<br>';
    echo '<br><b> Department: </b>' . $department;
    echo '<br><br>Image uploaded successfully ' . $image;


    // Storing submitted data in file
    try {
        $resource = fopen('usersdata', 'a');
        $skill = implode('-', $_POST['skills']);

        if (is_resource($resource)) {
            fwrite(
                $resource,
                $fname . ',' . $lname . ',' . $address . ',' .
                $country . ',' . $gender . ',' . $skill . ',' .
                $username . ',' . $password . ',' . $department . ',' . $image . "\n"
            );
            fclose($resource);
        } else {
            echo 'invalid filename';
        }
    } catch (Exception $ex) {
        echo 'error';
    }

    // Showing data as table
    try {
        $resource = fopen('usersdata', 'r');
        if (is_resource($resource)) {
            ?>
            <br><br>
            <table width="100%" ; border="1px solid" ;>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>Gender</th>
                    <th>Skills</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Department</th>
                    <th>Image</th>
                    <th>Control User</th>
                </tr>
                <?php
                while (!feof($resource)) {
                    $data = fgets($resource);
                    $data = preg_split('/\,/', $data);
                    ?>
                    <tr>
                        <td>
                            <?php echo $data[0]; ?>
                        </td>
                        <td>
                            <?php echo $data[1]; ?>
                        </td>
                        <td>
                            <?php echo $data[2]; ?>
                        </td>
                        <td>
                            <?php echo $data[3]; ?>
                        </td>
                        <td>
                            <?php echo $data[4]; ?>
                        </td>
                        <td>
                            <?php echo $data[5]; ?>
                        </td>
                        <td>
                            <?php echo $data[6]; ?>
                        </td>
                        <td>
                            <?php echo $data[7]; ?>
                        </td>
                        <td>
                            <?php echo $data[8]; ?>
                        </td>
                        <td>
                            <?php echo $data[9]; ?>
                        </td>
                        <td>
                            <a href="#">Show</a>
                            <a href="#">Edit</a>
                            <a href="#">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
        } else {
            echo 'invalid filename';
        }
    } catch (Exception $e) {
        echo 'error';
    }
    ?>
    </table>
    <?php
} else {
    echo "<h2>No data submitted</h2>";
}

?>