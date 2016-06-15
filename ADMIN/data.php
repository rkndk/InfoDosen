<?php
	include "../koneksi.php";
	$tipe = $_POST['tipe'];
	$nim = $_POST['nim'];
	
	if($tipe=="terima"){
		mysql_query("UPDATE mahasiswa SET statusmhs='APPROVED' WHERE nim='$nim'") or die(mysql_error());
	}
	else if($tipe=="hapus"){
		mysql_query("DELETE from mahasiswa WHERE nim='$nim'") or die(mysql_error());
	}
    mysql_close();
?>