<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$pengirim = $_POST['pengirim'];
	$idpelajaran = $_POST['idpelajaran'];
	$pesan = $_POST['pesan'];
	
	if($tipe=="update"&&$pengirim=="komting"){
		mysql_query("UPDATE matakuliah SET pesankomting='".$pesan."' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
	else if($tipe=="hapus"&&$pengirim=="komting"){
		mysql_query("UPDATE matakuliah SET pesankomting='' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
    mysql_close($connection);
?>