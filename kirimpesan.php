<?php
	include "session.php";
	include "koneksi.php";
	$user = $userOnSession;
	$pengirim="";
	if($_SESSION['level']=="mahasiswa"){
		$pengirim=$user['nim'];
		$selesai="location: mahasiswa/mailbox.php";
	}
	else if($_SESSION['level']=="dosen"){
		$pengirim=$user['nip'];
		$selesai="location: dosen/mailbox.php";
	}
	$penerima=$_POST['penerima'];
	$subject=$_POST['subject'];
	$isipesan=$_POST['isipesan'];
	$tanggal= date("Y-m-d");
	mysql_query("INSERT INTO pesan (pengirim,penerima,subject,isipesan,tanggal,status,favorit) VALUES ('".$pengirim."','".$penerima."','".$subject."','".$isipesan."','".$tanggal."','UNREAD','UNFAVORITE')", $connection) or die(mysql_error());
	header($selesai);
?>