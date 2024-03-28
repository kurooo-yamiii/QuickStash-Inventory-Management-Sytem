<?php
// Getting Connection to the published Database
$sname= "fdb1034.awardspace.net";
$unmae= "4437625_inv";
$password = "rtuinventory2024";

$db_name = "4437625_inv";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}