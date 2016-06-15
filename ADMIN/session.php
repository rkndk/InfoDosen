<?php
// Membangun Koneksi dengan Server dengan nama server, user_id dan password sebagai parameter
$connection = mysql_connect("localhost", "root", "");

// Seleksi Database
$db = mysql_select_db("projectpbw", $connection);
session_start();// Memulai Session

if(isset($_SESSION['user'])&&$_SESSION['level']!="admin"){
header("location: ../login.php");
}

// Menyimpan Session
$user_check=$_SESSION['user'];


?>