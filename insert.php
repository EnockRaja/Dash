<?php
require('db.php');
if (!empty($_POST['fname']) && !empty($_POST['collegename'])) {

    extract($_POST);
// print_r($_POST);


    $insert = "INSERT INTO `student`(`name`,`college`,`image`)VALUES('$fname','$collegename','$img_src')";


     if ($connect->query($insert)) {
         echo "Data Stored..";
     } else {
         echo "Error Acquired in Connection. Try Again Sometime..";
     }

    }
?>