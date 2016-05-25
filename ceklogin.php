<?php
session_start(); // Memulai Session
$error=''; // Variabel untuk menyimpan pesan error
if (isset($_POST['submit'])) {
if (empty($_POST['nimornip']) || empty($_POST['password'])) {
$error = "nimornip or Password is invalid";
}
else
{
// Variabel nimornip dan password
$nimornip=$_POST['nimornip'];
$password=$_POST['password'];
// Membangun koneksi ke database
$connection = mysql_connect("localhost", "root", "");
// Mencegah MySQL injection 
$nimornip = stripslashes($nimornip);
$password = stripslashes($password);
$nimornip = mysql_real_escape_string($nimornip);
$password = mysql_real_escape_string($password);
// Seleksi Database
$db = mysql_select_db("projectpbw", $connection);
// SQL query untuk memeriksa apakah mahasiswa terdapat di database?
$query = mysql_query("select * from mahasiswa where nim='$nimornip' AND password='$password'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['user']=$nimornip; // Membuat Sesi/session
header("location: index.php"); // Mengarahkan ke halaman profil
} else {
$error = "nimornip atau Password belum terdaftar";
}
mysql_close($connection); // Menutup koneksi
}
}
?>