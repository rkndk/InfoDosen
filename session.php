<?php
// Memulai Session
session_start();
if(!isset($_SESSION['user'])||!isset($_SESSION['level'])){
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
	if($_SESSION['level']=="mahasiswa"){
		$ses_sql=mysql_query("select * from mahasiswa where nim='$userCheck'", $connection);
	}
	else if ($_SESSION['level']=="dosen") {
		$ses_sql=mysql_query("select * from dosen where nip='$userCheck'", $connection);
	}
	$userOnSession = mysql_fetch_assoc($ses_sql);
}
?>