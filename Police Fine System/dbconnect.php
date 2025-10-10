<?php 

$server="localhost";
$user="root";
$password="";
$dbase="police_fine_system";

$conn=mysqli_connect($server, $user, $password, $dbase );

if(!$conn){

	die("Connection failed: ".mysqli_error());

}
//echo "Connected successfully";
 ?>
