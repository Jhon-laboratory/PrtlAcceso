<?php 
	date_default_timezone_set('America/Lima');
$username="flotapps";
$password="BDFlotapps.21";
$host="localhost";
$database="paragronlegal";
$db_link=mysqli_connect($host,$username,$password,$database)or die("ERROR".mysqli_error($db_link));

if (mysqli_connect_error()){
	echo "Could not connect to MySql. Please try again";
	exit();
}

if (!mysqli_set_charset($db_link, "utf8")) {
    exit();
} else {
 
}




?>
