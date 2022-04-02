<?php


$server = "localhost";         // connection with localhost. root is default username.name.
$user = "root";
$password = "";
$db = "acc-team";     //database selection. 'acc-team' is the database name.


$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
	die(mysqli_error($conn));
}
