<?php

session_start();

include 'dbcon.php';

//$db = mysqli_select_db($con, 'bladmins');      // database selection. 'bladmins' is the database name.

if (isset($_POST['submit'])) {
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$sql = "select * from admintable where user = '$username' and pass = '$password'";   // here user and pass is the attributes of admintable.

	$query1 = mysqli_query($conn, $sql);

	$row = mysqli_num_rows($query1);    // Here we are checkking if one user's info is in only one row or not.
	// Because two exact user and pass cannot be in two rows. 
	if ($row == 1) {
		echo "Login successfull";
		$_SESSION['user'] = $username;
		header('location:index.php');
	} else {
		echo "login failed! ";
		header('location:login.php');
	}
}
