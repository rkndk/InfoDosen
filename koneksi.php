<?php
//File koneksi ke database
$host="localhost";
$username="root";
$password="";
$database="projectpbw";

//Koneksi ke host
mysql_connect($host,$username,$password) or die("Maaf, Server Mati");

//Select database
mysql_select_db($database) or die("Database tidak ada");
?>