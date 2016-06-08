<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$tipe = $_POST['tipe'];
	$pengirim = $_POST['pengirim'];
	$idpelajaran = $_POST['idpelajaran'];
	
	if($tipe=="update"&&$pengirim=="komting"){
		$pesan = $_POST['pesan'];
		$tanggal= date("Y-m-d");
		mysql_query("UPDATE matakuliah SET pesankomting='".$pesan."', tanggalkomting='".$tanggal."' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
	else if($tipe=="update"&&$pengirim=="dosen"){
		$pesan = $_POST['pesan'];
		$tanggal= date("Y-m-d");
		mysql_query("UPDATE matakuliah SET pesandosen='".$pesan."', tanggaldosen='".$tanggal."' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
	else if($tipe=="hapus"&&$pengirim=="komting"){
		mysql_query("UPDATE matakuliah SET pesankomting='',tanggalkomting='' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
	else if($tipe=="hapus"&&$pengirim=="dosen"){
		mysql_query("UPDATE matakuliah SET pesandosen='',tanggaldosen='' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
	else if($tipe=="hapuskomting"&&$pengirim=="dosen"){
		mysql_query("UPDATE matakuliah SET komting='',pesankomting='',tanggalkomting='' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
	}
	else if($tipe=="tambahkomting"&&$pengirim=="dosen"){
		$nimkomting = $_POST['nimkomting'];
		mysql_query("UPDATE matakuliah SET komting='".$nimkomting."' WHERE idpelajaran=".$idpelajaran, $connection) or die(mysql_error());
		header("location: dosen/index.php");
	}
    mysql_close($connection);
?>