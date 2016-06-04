<?php
// Memulai Session
session_start();
if(!isset($_SESSION['user'])){
	header('Location: login.php');
}
else{
	// Membangun Koneksi dengan Server dengan nama server, username dan password sebagai parameter
	$connection = mysql_connect("localhost", "root", "");

	// Seleksi Database
	$db = mysql_select_db("projectpbw", $connection);
	// user cek
	$userCheck = $_SESSION['user'];
	// Ambil username dengan mysql_fetch_assoc
	$ses_sql=mysql_query("select * from mahasiswa where nim='$userCheck'", $connection);
	$userOnSession = mysql_fetch_assoc($ses_sql);
}
?>