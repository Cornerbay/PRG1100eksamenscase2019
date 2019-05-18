<?php

$host		=	"localhost";
$user		=	"root";
$password	=	"";
$database	=	"bjarum";	

$db=mysqli_connect($host,$user,$password,$database) or die ("Får ikke koblet til database");
$db->set_charset("utf8");



?>