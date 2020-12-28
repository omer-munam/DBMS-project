<?php
session_start();


if($_SESSION['loggedin'] == 1 && isset($_SESSION['is_admin'])) {
   	session_destroy();
	header('location:index.php');
} else {
	session_destroy();
	header('location:login.php');
}


?>