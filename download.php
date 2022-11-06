<?php 
include'db.php';
// print_r($_POST);

extract($_POST);

$select = "SELECT * FROM `student` WHERE `id`='$id'";

$result = $connect->query($select);

$row = $result->fetch_assoc();

echo json_encode($row);

?>