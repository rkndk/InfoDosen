<?php
include "session.php";
include "koneksi.php";

if($_SESSION['level']=="mahasiswa"){
	$nim=$_POST['nim'];
	$nama=$_POST['nama'];
	$email=$_POST['email'];
	$jeniskelamin=$_POST['jeniskelamin'];
	$tanggallahir=$_POST['tanggallahir'];
	$deskripsi=$_POST['deskripsi'];
	$jurusan=$_POST['jurusan'];

	$info = pathinfo($_FILES['foto']['name']);
	$ext = $info['extension']; // get the extension of the file
	$namafoto = $nim.".".$ext; 

	$target = 'assets/images/'.$namafoto;
	move_uploaded_file( $_FILES['foto']['tmp_name'], $target);

	mysql_query("UPDATE mahasiswa SET nama='".$nama."', email='".$email."', jeniskelamin='".$jeniskelamin."', tanggallahir='".$tanggallahir."', deskripsi='".$deskripsi."', jurusan='".$jurusan."', foto='".$namafoto."' WHERE nim='".$nim."'", $connection) or die(mysql_error());
	header("location: mahasiswa/profil.php");
}
else if($_SESSION['level']=="dosen"){
}

?>