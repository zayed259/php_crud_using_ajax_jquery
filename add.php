<?php
include 'connection.php';

// Add Record in Database with Ajax jQuery
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    if (!empty($name) && !empty($email) && !empty($phone)) {
        // duplicate email check
        $sql = "SELECT * FROM `students` WHERE `email` = '$email'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            echo json_encode('Email Already Exists');
        } else {
            $sql = "INSERT INTO `students`(`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone')";
            $result = $connection->query($sql);
            if ($result) {
                // json value
                echo json_encode('Record Added Successfully');
            } else {
                echo json_encode('Record Not Added');
            }
        }
    } else {
        echo json_encode('All Fields are Required');
    }
}
