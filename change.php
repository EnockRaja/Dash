<?php 
// print_r($_FILES);
if (!empty($_FILES['file']['tmp_name'])) {

   



    $img_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $img_size = $_FILES['file']['size'];

    $ext = explode(".", $img_name);
    $last_name = strtolower(end($ext));
    $destination = 'uploads/'.time().".".$last_name;

    $check = array("jpg", "jpeg", "png");

    // $insert = "INSERT INTO `student`(`name`,`college`,`image`)VALUES('$fname','$collegename','$destination')";

    if (in_array($last_name, $check)) {

            // if ($connect->query($insert)) {
            //     echo "Data Stored..";
            // } else {
            //     echo "Error Acquired in Connection. Try Again Sometime..";
            // }
       
        if ($img_size < 10000000) {

            if(move_uploaded_file($tmp_name, $destination)){

                echo $destination;
            }
        } else {
            echo "The File size should be under 10MB..";
        }
    } else {
        echo "The File format not Supported..";
    }
}else{
    echo "empty";
}
?>