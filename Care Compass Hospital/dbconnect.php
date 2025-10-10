<?php 

$server="localhost";
$user="root";
$password="";
$dbase="new_hospital";

$conn=mysqli_connect($server, $user, $password, $dbase );

if(!$conn){

	die("Connection failed: ".mysqli_error());

}
//echo "Connected successfully";
 ?>
