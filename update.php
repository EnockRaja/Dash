<?php
include('db.php');

if (!empty($_POST['fname']) && !empty($_POST['collegename'])) {

extract($_POST);
$img_name = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$img_size = $_FILES['photo']['size'];

$ext = explode(".", $img_name);
$last_name = strtolower(end($ext));
$destination = 'uploads/'.time().$last_name;

$check = array("jpg", "jpeg", "png");

// $insert = "INSERT INTO `student`(`name`,`college`,`path`)VALUES('$fname','$collegename','$destination')";

if (in_array($last_name, $check)) {



    if (move_uploaded_file($tmp_name, $destination)) {

        if ($connect->query($insert)) {
            echo "Data Stored..";
        } else {
            echo "Error Acquired in Connection. Try Again Sometime..";
        }
    } else {
        echo "The File Couldn't Accessible..";
    }
    if ($img_size < 10000000) {
    } else {
        echo "The File size should be under 10MB..";
    }
} else {
    echo "The File format not Supported..";
}
}
?>