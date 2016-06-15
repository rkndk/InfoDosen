<?php
session_start(); // Memulai Session
$error=''; // Variabel untuk menyimpan pesan error
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "username or Password is empty";
echo $error;
}
else
{
// Variabel username dan password
$username=$_POST['username'];
$password=$_POST['password'];
// Membangun koneksi ke database
$connection = mysql_connect("localhost", "root", "");
// Mencegah MySQL injection 
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Seleksi Database
$db = mysql_select_db("projectpbw", $connection);
// SQL query untuk memeriksa
$query = mysql_query("select * from admin where username='$username' AND password='$password'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['user']=$username; // Membuat Sesi/session
header("location: index.php"); // Mengarahkan ke halaman index
} else {
$error = "username atau Password belum terdaftar";
echo 'salah password atau username';
}
mysql_close($connection); // Menutup koneksi
}
}
?>