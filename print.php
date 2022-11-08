<?php 
include('db.php');

extract($_POST);

$select = "SELECT * FROM `student` WHERE `id`='$id'";

$result = $connect->query($select);

$row = $result->fetch_assoc();

echo json_encode($row);

?>