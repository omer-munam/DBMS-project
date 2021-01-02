<?php
$conn = new mysqli("localhost","root","test","ecommerce");

if($conn->connect_error){
	die("connection failed: ".$conn->connect_error);
}
?>
