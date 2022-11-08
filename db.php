<?php 
$connect = new mysqli("localhost","root","","list");
// if($connect)
if ($connect->connect_error) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
?>