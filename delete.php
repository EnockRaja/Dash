<?php 
include('db.php');

extract($_POST);

$delete ="DELETE FROM `student` WHERE `id`='$id'";
if($connect->query($delete)){
    echo "Data Deleted..";
}else{
    echo "Data Couldn't Deleted..";
}

?>