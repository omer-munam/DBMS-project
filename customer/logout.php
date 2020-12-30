<?php
session_start();


if($_SESSION['loggedin'] == 1) {
   	session_destroy();
	header('location:index.php');
} else {
	session_destroy();
	header('location:../index.php');
}


?>