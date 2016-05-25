<?php
// Membangun Koneksi dengan Server dengan nama server, user_id dan password sebagai parameter
$connection = mysql_connect("localhost", "root", "");

// Seleksi Database
$db = mysql_select_db("projectpbw", $connection);
session_start();// Memulai Session

// Menyimpan Session
$user_check=$_SESSION['user'];

// Ambil nama karyawan berdasarkan username karyawan dengan mysql_fetch_assoc
$ses_sql=mysql_query("select nim from mahasiswa where nim='$user_check'", $connection);
$userOnSession = mysql_fetch_assoc($ses_sql);
$login_session =$userOnSession['nim'];
if(!isset($login_session)){
mysql_close($connection); // Menutup koneksi
header('Location: login.php'); // Mengarahkan ke Home Page
}
?>