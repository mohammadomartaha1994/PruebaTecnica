<?php
include 'conn.php';
$fcm_token = $_POST['fcm_token'];
$sql = "INSERT INTO `fcm`(`Code`) VALUES ('".$fcm_token."')";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>