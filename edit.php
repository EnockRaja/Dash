<?php 
include'db.php';

$select = "SELECT * FROM `student` WHERE `id`='$_POST[id]'";
$result = $connect->query($select);
$row = $result->fetch_assoc();
// print_r($row); 
echo json_encode($row);

?>